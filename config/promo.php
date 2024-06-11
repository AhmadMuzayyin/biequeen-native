<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /admin/login");
    exit();
}
// Create Voucher
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $kode = sanitize_input($_POST['kode']);
    $tanggal_berakhir = sanitize_input($_POST['tanggal_berakhir']);
    $nominal = sanitize_input($_POST['nominal']);
    $data = compact('kode', 'tanggal_berakhir', 'nominal');
    $errors = validate_promo_data($data);
    if (empty($errors)) {
        unset($_SESSION['errors']);
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");

        $stmt = $conn->prepare("INSERT INTO vouchers (kode, tanggal_berakhir, nominal, created_at, updated_at) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $kode, $tanggal_berakhir, $nominal, $created_at, $updated_at);

        if ($stmt->execute()) {
            $errors[] = "Voucher created successfully.";
        } else {
            $errors[] = "Error: " . $stmt->error;
        }
        $stmt->close();
        header("Location: /admin/promo");
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: /admin/promo/create");
    }
}
// Update Voucher
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = sanitize_input($_POST['voucher_id']);
    $kode = sanitize_input($_POST['kode']);
    $tanggal_berakhir = sanitize_input($_POST['tanggal_berakhir']);
    $nominal = sanitize_input($_POST['nominal']);
    $data = compact('kode', 'tanggal_berakhir', 'nominal');
    $errors = validate_promo_data($data);
    if (empty($errors)) {
        unset($_SESSION['errors']);
        $updated_at = date("Y-m-d H:i:s");
        $stmt = $conn->prepare("UPDATE vouchers SET kode = ?, tanggal_berakhir = ?, nominal = ?, updated_at = ? WHERE id = ?");
        $stmt->bind_param("ssisi", $kode, $tanggal_berakhir, $nominal, $updated_at, $id);
        if ($stmt->execute()) {
            $errors[] = "Voucher updated successfully.";
        } else {
            $errors[] = "Error: " . $stmt->error;
        }
        $stmt->close();
        header("Location: /admin/promo");
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: /admin/promo/edit?voucher_id=$id");
    }
}
// Delete Voucher
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = sanitize_input($_POST['id']);

    $stmt = $conn->prepare("DELETE FROM vouchers WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "Voucher deleted successfully.";
    } else {
        $message = "Error: " . $stmt->error;
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
function validate_date($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}
function validate_promo_data($data)
{
    $errors = [];
    if (strlen($data['kode']) < 5) {
        $errors[] = "Kode must be at least 5 characters long.";
    }
    if (empty($data['kode'])) {
        $errors[] = "Kode is required.";
    }

    if (empty($data['nominal'])) {
        $errors[] = "Nominal is required.";
    }

    if (empty($data['tanggal_berakhir'])) {
        $errors[] = "Tanggal berakhir is required.";
    }

    return $errors;
}
