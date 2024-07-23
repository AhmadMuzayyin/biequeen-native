<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /admin/login");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_menu'])) {
    $nama = sanitize_input($_POST['nama']);
    $deskripsi = sanitize_input($_POST['deskripsi']);
    $varian = sanitize_input($_POST['varian']);
    $toping = sanitize_input($_POST['toping']);
    $jenis = sanitize_input($_POST['jenis']);
    $harga = sanitize_input($_POST['harga']);
    $created_at = date('Y-m-d H:i:s');
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
        $errors[] = "Gambar is required.";
    }
    if (empty($errors)) {
        unset($_SESSION['errors']);
        $stmt = $conn->prepare("INSERT INTO menus (nama, deskripsi, gambar, varian, toping, jenis, harga, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssdss", $nama, $deskripsi, $gambar, $varian, $toping, $jenis, $harga, $created_at, $updated_at);
        if ($stmt->execute()) {
            header("Location: /admin/menu");
            exit();
        } else {
            $errors[] = "Error: " . $stmt->error;
        }
        $stmt->close();

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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_menu'])) {
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
if (isset($_GET['menu_id']) && is_numeric($_GET['menu_id']) && isset($_GET['ac'])) {
    $menu_id = intval($_GET['menu_id']);
    $gambar = mysqli_query($conn, "SELECT * FROM menus WHERE menu_id = $menu_id");
    $gambar = mysqli_fetch_assoc($gambar);
    if (file_exists('../' . $gambar['gambar'])) {
        unlink('../' . $gambar['gambar']);
    }
    $stmt = $conn->prepare("DELETE FROM orders WHERE menu_id = ?");
    $stmt->bind_param("i", $menu_id);
    $stmt->execute();
    $stmt = $conn->prepare("DELETE FROM menus WHERE menu_id = ?");
    $stmt->bind_param("i", $menu_id);
    if ($stmt->execute()) {
        header("Location: /admin/menu");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validate_menu_data($data)
{
    $errors = [];

    if (empty($data['nama'])) {
        $errors[] = "Nama is required.";
    }

    if (empty($data['deskripsi'])) {
        $errors[] = "Deskripsi is required.";
    }

    if (empty($data['varian'])) {
        $errors[] = "Varian is required.";
    }

    if (!in_array($data['jenis'], ['makanan', 'minuman'])) {
        $errors[] = "Jenis must be either 'makanan' or 'minuman'.";
    }

    if (!is_numeric($data['harga']) || $data['harga'] <= 0) {
        $errors[] = "Harga must be a positive number.";
    }

    return $errors;
}
