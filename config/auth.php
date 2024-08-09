<?php
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);

    $email = validate_email($email);
    $password = validate_password($password);
    if ($email && $password) {
        // Prepare and bind
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                header("Location: /admin");
                exit();
            } else {
                $_SESSION['error'] = "Invalid email or password.";
                header("Location: /admin/login");
            }
        } else {
            $_SESSION['error'] = "Invalid email or password.";
            header("Location: /admin/login");
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Invalid input. Please check your email and password.";
        header("Location: /admin/login");
    }
}
//logout logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: /admin/login");
    exit();
}
function sanitize_input($data)
{
    // Trim whitespace from the beginning and end
    $data = trim($data);
    // Remove backslashes (\)
    $data = stripslashes($data);
    // Convert special characters to HTML entities
    $data = htmlspecialchars($data);
    return $data;
}
function validate_email($email)
{
    // Sanitize email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return $email;
    } else {
        return false;
    }
}
function validate_password($password)
{
    // Example: ensure password is at least 8 characters long
    if (strlen($password) >= 8) {
        return $password;
    } else {
        return false;
    }
}
