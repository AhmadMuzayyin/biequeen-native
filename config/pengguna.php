<?php
include 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /admin/login");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_pengguna'])) {
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);
    $password_confirmation = sanitize_input($_POST['password_confirmation']);
    $role = sanitize_input($_POST['role']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $data = compact('name', 'email', 'password', 'password_confirmation', 'role');
    $errors = validate_pengguna_data($data);
    if (empty($errors)) {
        unset($_SESSION['errors']);
        $password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("
        INSERT INTO users (name, email, password, role, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $email, $password, $role, $created_at, $updated_at);
        if ($stmt->execute()) {
            header("Location: /admin/pengguna");
            exit();
        } else {
            $errors[] = "Error: " . $stmt->error;
        }
        $stmt->close();

        if ($stmt->execute()) {
            header("Location: /admin/pengguna");
            exit();
        } else {
            $errors[] = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        header("Location: /admin/pengguna/create");
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_pengguna'])) {
    $user_id = sanitize_input($_POST['user_id']);
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);
    $password_confirmation = sanitize_input($_POST['password_confirmation']);
    $role = sanitize_input($_POST['role']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');
    $data = compact('name', 'email', 'password', 'password_confirmation', 'role');
    $errors = validate_pengguna_data($data);
    if (empty($errors)) {
        unset($_SESSION['errors']);
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_BCRYPT);
        } else {
            $password = $password;
        }
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ?, role = ?, updated_at = ? WHERE user_id = ?");
        $stmt->bind_param("sssssi", $name, $email, $password, $role, $updated_at, $user_id);

        if ($stmt->execute()) {
            header("Location: /admin/pengguna");
            exit();
        } else {
            $errors[] = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $data;
        header("Location: /admin/pengguna/edit?pengguna_id=$user_id");
    }
}
if (isset($_GET['pengguna_id']) && is_numeric($_GET['pengguna_id'])) {
    if (isset($_GET['ac'])) {
        $pengguna_id = intval($_GET['pengguna_id']);
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $pengguna_id);
        if ($stmt->execute()) {
            header("Location: /admin/pengguna");
            exit();
        } else {
            $errors[] = "Error: " . $stmt->error;
        }
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

function validate_pengguna_data($data)
{
    $errors = [];
    if (empty($data['name'])) {
        $errors[] = "Nama is required.";
    }
    if (empty($data['email'])) {
        $errors[] = "Email is required.";
    }
    if (empty($data['password'])) {
        $errors[] = "Password is required.";
    } else {
        if (strlen($data['password']) < 8) {
            $errors[] = "Password must be at least 8 characters.";
        }
        //cek password is confirmed or not
        if (empty($data['password_confirmation'])) {
            $errors[] = "Password confirmation is required.";
        }
        if ($data['password'] !== $data['password_confirmation']) {
            $errors[] = "Password and password confirmation must match.";
        }
    }
    if (empty($data['role'])) {
        $errors[] = "Role is required.";
    } else {
        $roles = ['Admin', 'Kasir'];
        if (!in_array($data['role'], $roles)) {
            $errors[] = "Role is not valid.";
        }
    }

    return $errors;
}
