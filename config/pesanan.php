<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /admin/login");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_pesanan'])) {
    $user_id = $_SESSION['user_id'];
    $menu_id = $_POST['menu_id'];
    $nama_pelanggan = sanitize_input($_POST['nama']);
    $whatsapp = sanitize_whatsapp($_POST['whatsapp']);
    $jumlah = sanitize_input($_POST['jumlah']);
    $catatan = sanitize_input($_POST['catatan']);
    $status = "Menunggu";
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $data = compact('nama_pelanggan', 'whatsapp', 'jumlah', 'total_harga', 'catatan', 'status');
    $errors = validate_pesanan_data($data);
    // var_dump($menu_id);
    // die();
    if (empty($errors)) {
        unset($_SESSION['errors']);
        $q = mysqli_query($conn, "SELECT * FROM menus WHERE menu_id = $menu_id");
        $menu = mysqli_fetch_assoc($q);
        $total_harga = $menu['harga'] * $jumlah;
        $stmt = $conn->prepare("
        INSERT INTO orders (user_id, menu_id, nama_pelanggan, whatsapp, jumlah, total_harga, catatan, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisssdssss", $user_id, $menu_id, $nama_pelanggan, $whatsapp, $jumlah, $total_harga, $catatan, $status, $created_at, $updated_at);
        if ($stmt->execute()) {
            header("Location: /admin/pesanan/create");
            exit();
        } else {
            $errors[] = "Error: " . $stmt->error;
        }
        $stmt->close();

        if ($stmt->execute()) {
            header("Location: /admin/pesanan/create");
            exit();
        } else {
            $errors[] = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        header("Location: /admin/pesanan/create");
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_pesanan'])) {
    $menu_id = sanitize_input($_POST['menu_id']);
    $nama = sanitize_input($_POST['nama']);
    $deskripsi = sanitize_input($_POST['deskripsi']);
    $varian = sanitize_input($_POST['varian']);
    $toping = sanitize_input($_POST['toping']);
    $jenis = sanitize_input($_POST['jenis']);
    $harga = sanitize_input($_POST['harga']);
    $updated_at = date('Y-m-d H:i:s');
    $data = compact('nama', 'deskripsi', 'varian', 'toping', 'jenis', 'harga');
    $errors = validate_menu_data($data);
    if (!empty($_FILES['gambar']['name'])) {
        $file_name = $_FILES['gambar']['name'];
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $file_type = $_FILES['gambar']['type'];
        $file_size = $_FILES['gambar']['size'];
        $file_error = $_FILES['gambar']['error'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $hashed_name = md5(uniqid('', true)) . '.' . $file_ext;
        $target_dir = "uploads/";
        $target_file = $target_dir . $hashed_name;
        if (move_uploaded_file($file_tmp, $target_file)) {
            $gambar = "/config/$target_file";
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    } else {
        $gambar = $_POST['existing_gambar'];
    }
    if (empty($errors)) {
        unset($_SESSION['errors']);
        $stmt = $conn->prepare("UPDATE menus SET nama = ?, deskripsi = ?, gambar = ?, varian = ?, toping = ?, jenis = ?, harga = ?, updated_at = ? WHERE menu_id = ?");
        $stmt->bind_param("ssssssdsi", $nama, $deskripsi, $gambar, $varian, $toping, $jenis, $harga, $updated_at, $menu_id);

        if ($stmt->execute()) {
            header("Location: /admin/menu");
            exit();
        } else {
            $errors[] = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        header("Location: /admin/create_menu");
    }
}
if (isset($_GET['pesanan_id']) && is_numeric($_GET['pesanan_id'])) {
    if (isset($_GET['ac'])) {
        $pesanan_id = intval($_GET['pesanan_id']);
        $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->bind_param("i", $pesanan_id);
        if ($stmt->execute()) {
            header("Location: /admin/pesanan");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id']) && isset($_POST['new_status'])) {
    // var_dump($_POST);
    // die();
    $order_id = intval($_POST['order_id']);
    $new_status = sanitize_input($_POST['new_status']);
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $order_id);

    if ($stmt->execute()) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "error" => "Failed to update order status."));
    }
    $stmt->close();
} else {
    echo json_encode(array("success" => false, "error" => "Invalid request."));
}
function sanitize_whatsapp($number)
{
    $number = preg_replace('/[\s()-]+/', '', $number);
    if (substr($number, 0, 1) === '0') {
        $number = '62' . substr($number, 1);
    }
    if (substr($number, 0, 1) === '8') {
        $number = '62' . substr($number, 0);
    }

    return $number;
}
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function validate_pesanan_data($data)
{
    $errors = [];

    if (empty($data['nama_pelanggan'])) {
        $errors[] = "Nama is required.";
    }
    if (empty($data['whatsapp'])) {
        $errors[] = "Whatsapp is required.";
    }
    if (!is_numeric($data['jumlah']) || $data['jumlah'] <= 0) {
        $errors[] = "Harga must be a positive number.";
    }

    return $errors;
}
