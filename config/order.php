<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_keranjang'])) {
    $menu_id = $_POST['menu_id'];
    $harga = $_POST['harga'];
    $jumlah = 1;
    if ($harga !== null) {
        try {
            $total_harga = $harga * $jumlah;
            $created_at = date("Y-m-d H:i:s");
            $updated_at = date("Y-m-d H:i:s");
            $stmt = $conn->prepare("INSERT INTO orders (menu_id, jumlah, total_harga, created_at, updated_at)
                            VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("iiiss", $menu_id, $jumlah, $total_harga, $created_at, $updated_at);
            $stmt->execute();
            echo "Order added successfully.";
            header("Location: /");
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            die();
            header("Location: /");
        }
        $stmt->close();
    } else {
        echo "Menu ID not found.";
        header("Location: /");
    }
    $conn->close();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['min_qty'])) {
    $menu_id = $_POST['menu_id'];
    $jumlah = $_POST['min_qty'];
    $jumlah = intval($jumlah);
    $harga = $_POST['harga'];
    if ($jumlah > 1) {
        $jumlah -= 1;
        $total_harga = $harga * $jumlah;
        try {
            $updated_at = date("Y-m-d H:i:s");
            $stmt = $conn->prepare("UPDATE orders SET jumlah = ?, total_harga = ?, updated_at = ? WHERE jumlah = ? AND menu_id = ? AND in_cart = 1");
            $stmt->bind_param("iissi", $jumlah, $total_harga, $updated_at, $_POST['min_qty'], $menu_id);
            $stmt->execute();
            $_SESSION['errors'] = "Order updated successfully.";
            header("Location: /cart");
        } catch (\Throwable $th) {
            header("Location: /cart");
        }
        $stmt->close();
    } else {
        $_SESSION['errors'] = "Order quantity must be at least 1.";
        header("Location: /cart");
    }
    $conn->close();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_qty'])) {
    $menu_id = $_POST['menu_id'];
    $jumlah = intval($_POST['add_qty']);
    $jumlah += 1;
    $updated_at = date("Y-m-d H:i:s");
    $harga = $_POST['harga'];
    try {
        $total_harga = $harga * $jumlah;
        $stmt = $conn->prepare("UPDATE orders SET jumlah = ?, total_harga = ?, updated_at = ? WHERE jumlah = ? AND menu_id = ? AND in_cart = 1");
        $stmt->bind_param("iissi", $jumlah, $total_harga, $updated_at, $_POST['add_qty'], $menu_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $_SESSION['success'] = "Order updated successfully.";
        } else {
            $_SESSION['errors'] = "Failed to update order. Please try again.";
        }
        $stmt->close();
    } catch (Exception $e) {
        $_SESSION['errors'] = "Error: " . $e->getMessage();
    }
    $conn->close();
    header("Location: /cart");
    exit();
}
// Cek apakah request adalah POST
header('Content-Type: application/json');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['getDiskon'])) {
    $diskon = $_POST['diskon'];
    $get_diskon = mysqli_query($conn, "SELECT * FROM vouchers WHERE kode = '$diskon'");
    $get_diskon = mysqli_fetch_assoc($get_diskon);
    if ($get_diskon) {
        session_start();
        if ($get_diskon['tanggal_berakhir'] < date('Y-m-d')) {
            $response = [
                'status' => 'error',
                'message' => 'Kode diskon sudah tidak berlaku'
            ];
            echo json_encode($response);
            exit();
        } else {
            $order = mysqli_query($conn, "SELECT * FROM orders WHERE in_cart = 1");
            foreach ($order as $key => $value) {
                if ($value['diskon'] == null) {
                    $diskon = $get_diskon['nominal'];
                    $_SESSION['kode_diskon'] = $_POST['diskon'];
                    $_SESSION['diskon'] = $diskon;
                    mysqli_query($conn, "UPDATE orders SET diskon = '$diskon' WHERE in_cart = 1");
                    $response = [
                        'status' => 'success',
                        'message' => 'Diskon berhasil diproses',
                        'diskon' => $get_diskon
                    ];
                    echo json_encode($response);
                    exit();
                } else {
                    $_SESSION['kode_diskon'] = $_POST['diskon'];
                    $response = [
                        'status' => 'error',
                        'message' => 'Anda sudah menggunakan diskon sebelumnya'
                    ];
                    echo json_encode($response);
                    exit();
                }
            }
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Kode diskon tidak valid'
        ];
        echo json_encode($response);
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Invalid request method'
    ];
    echo json_encode($response);
    $conn->close();
}
header('Content-Type: application/json');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
    $nama_pelanggan = sanitize_input($_POST['nama']);
    $whatsapp = sanitize_input($_POST['wa']);
    $data = compact('nama_pelanggan', 'whatsapp');
    $errors = validate($data);
    if (empty($errors)) {
        $updated_at = date("Y-m-d H:i:s");
    } else {
        $response = [
            'status' => 'error',
            'message' => $errors
        ];
        echo json_encode($response);
    }
}
function validate($param)
{
    $errors = [];
    if (empty($param['nama_pelanggan'])) {
        $errors[] = 'Nama tidak boleh kosong';
    }
    if (empty($param['whatsapp'])) {
        $errors[] = 'Nomor WhatsApp tidak boleh kosong';
    }
    return $errors;
}
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
