<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /admin/login");
    exit();
}
// Create Voucher
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_profil'])) {
    try {
        $nama = sanitize_input($_POST['nama']);
        $email = sanitize_input($_POST['email']);
        $alamat = sanitize_input($_POST['alamat']);
        $logo = sanitize_input($_POST['logo']);
        $deskripsi = sanitize_input($_POST['deskripsi']);
        $whatsapp = sanitize_input($_POST['whatsapp']);
        $facebook = sanitize_input($_POST['facebook']);
        $instagram = sanitize_input($_POST['instagram']);
        $qris_pembayaran = sanitize_input($_POST['qris_pembayaran']);
        $data = compact('nama', 'email', 'alamat', 'logo', 'deskripsi', 'whatsapp', 'facebook', 'instagram', 'qris_pembayaran');
        $errors = validate_profil_data($data);
        if (!empty($_FILES['logo']['name'])) {
            $file_name = $_FILES['logo']['name'];
            $file_tmp = $_FILES['logo']['tmp_name'];
            $file_type = $_FILES['logo']['type'];
            $file_size = $_FILES['logo']['size'];
            $file_error = $_FILES['logo']['error'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $hashed_name = md5(uniqid('', true)) . '.' . $file_ext;
            $target_dir = "uploads/";
            $target_file = $target_dir . $hashed_name;
            if (move_uploaded_file($file_tmp, $target_file)) {
                $logo = "/config/$target_file";
            } else {
                $errors[] = "Sorry, there was an error uploading your file.";
            }
        } else {
            $logo = $profil['logo'];
        }

        if (!empty($_FILES['qris_pembayaran']['name'])) {
            $file_name = $_FILES['qris_pembayaran']['name'];
            $file_tmp = $_FILES['qris_pembayaran']['tmp_name'];
            $file_type = $_FILES['qris_pembayaran']['type'];
            $file_size = $_FILES['qris_pembayaran']['size'];
            $file_error = $_FILES['qris_pembayaran']['error'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $hashed_name = md5(uniqid('', true)) . '.' . $file_ext;
            $target_dir = "uploads/";
            $target_file = $target_dir . $hashed_name;
            if (move_uploaded_file($file_tmp, $target_file)) {
                $qris_pembayaran = "/config/$target_file";
            } else {
                $errors[] = "Sorry, there was an error uploading your file.";
            }
        } else {
            $qris_pembayaran = $profil['qris_pembayaran'];
        }

        if (empty($errors)) {
            unset($_SESSION['errors']);
            $stmt = $conn->prepare("INSERT INTO company_profiles (nama, email, alamat, logo, deskripsi, whatsapp, facebook, instagram, qris_pembayaran) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $nama, $email, $alamat, $logo, $deskripsi, $whatsapp, $facebook, $instagram, $qris_pembayaran);        
            if ($stmt->execute()) {
                $errors[] = "Profil created successfully.";
            } else {
                $errors[] = "Error: " . $stmt->error;
            }
            $stmt->close();
            header("Location: /admin/profil");
        } else {
            $_SESSION['errors'] = $errors;
            header("Location: /admin/profil");
        }
    } catch (\Throwable $th) {
        var_dump($th->getMessage());
        die();
    }
}
// Update company profile
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profil'])) {
    $id = sanitize_input($_POST['id']);
    $profil = mysqli_query($conn, "SELECT * FROM company_profiles WHERE id = $id LIMIT 1");
    $profil = mysqli_fetch_assoc($profil);
    $nama = sanitize_input($_POST['nama']);
    $email = sanitize_input($_POST['email']);
    $alamat = sanitize_input($_POST['alamat']);
    $logo = sanitize_input($_POST['logo']);
    $deskripsi = sanitize_input($_POST['deskripsi']);
    $whatsapp = sanitize_input($_POST['whatsapp']);
    $facebook = sanitize_input($_POST['facebook']);
    $instagram = sanitize_input($_POST['instagram']);
    $qris_pembayaran = sanitize_input($_POST['qris_pembayaran']);
    $data = compact('nama', 'email', 'alamat', 'logo', 'deskripsi', 'whatsapp', 'facebook', 'instagram', 'qris_pembayaran');
    $errors = validate_profil_data($data);
    if (!empty($_FILES['logo']['name'])) {
        $file_name = $_FILES['logo']['name'];
        $file_tmp = $_FILES['logo']['tmp_name'];
        $file_type = $_FILES['logo']['type'];
        $file_size = $_FILES['logo']['size'];
        $file_error = $_FILES['logo']['error'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $hashed_name = md5(uniqid('', true)) . '.' . $file_ext;
        $target_dir = "uploads/";
        $target_file = $target_dir . $hashed_name;
        if (move_uploaded_file($file_tmp, $target_file)) {
            $logo = "/config/$target_file";
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    } else {
        $logo = $profil['logo'];
    }
    if (!empty($_FILES['qris_pembayaran']['name'])) {
        $file_name = $_FILES['qris_pembayaran']['name'];
        $file_tmp = $_FILES['qris_pembayaran']['tmp_name'];
        $file_type = $_FILES['qris_pembayaran']['type'];
        $file_size = $_FILES['qris_pembayaran']['size'];
        $file_error = $_FILES['qris_pembayaran']['error'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $hashed_name = md5(uniqid('', true)) . '.' . $file_ext;
        $target_dir = "uploads/";
        $target_file = $target_dir . $hashed_name;
        if (move_uploaded_file($file_tmp, $target_file)) {
            $qris_pembayaran = "/config/$target_file";
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    } else {
        $qris_pembayaran = $profil['qris_pembayaran'];
    }
    if (empty($errors)) {
        unset($_SESSION['errors']);
        $updated_at = date("Y-m-d H:i:s");
        $stmt = $conn->prepare("UPDATE company_profiles SET nama = ?, email = ?, alamat = ?, logo = ?, deskripsi = ?, whatsapp = ?, facebook = ?, instagram = ?, qris_pembayaran = ?, updated_at = ? WHERE id = ?");
        $stmt->bind_param("ssssssssssi", $nama, $email, $alamat, $logo, $deskripsi, $whatsapp, $facebook, $instagram, $qris_pembayaran, $updated_at, $id);
        if ($stmt->execute()) {
            $errors[] = "Profil updated successfully.";
        } else {
            $errors[] = "Error: " . $stmt->error;
        }
        $stmt->close();
        header("Location: /admin/profil");
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: /admin/profil");
    }
}
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function validate_profil_data($data)
{
    $errors = [];
    if (empty($data['nama'])) {
        $errors[] = "Nama is required.";
    }

    if (empty($data['email'])) {
        $errors[] = "Email is required.";
    }

    if (empty($data['alamat'])) {
        $errors[] = "Alamat is required.";
    }
    if (empty($data['deskripsi'])) {
        $errors[] = "Deskripsi is required.";
    }
    if (empty($data['whatsapp'])) {
        $errors[] = "Whatsapp is required.";
    }

    return $errors;
}
