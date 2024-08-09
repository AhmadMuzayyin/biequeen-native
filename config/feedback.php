<?php
include 'db.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = sanitize_input($_POST['nama']);
    $email = sanitize_input($_POST['email']);
    $whatsapp = sanitize_input($_POST['whatsapp']);
    $pesan = sanitize_input($_POST['pesan']);

    $email = validate_email($email);
    $whatsapp = validate_whatsapp($whatsapp);
    if ($nama && $email && $whatsapp && $pesan) {
        $stmt = $conn->prepare("INSERT INTO feedbacks (nama, email, whatsapp, pesan, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())");
        $stmt->bind_param("ssss", $nama, $email, $whatsapp, $pesan);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Feedback submitted successfully.";
        } else {
            $_SESSION['error'] = "Failed to submit feedback.";
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Invalid input. Please check your details.";
    }

    header("Location: /feedback");
    exit();
}
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validate_email($email)
{
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return $email;
    } else {
        return false;
    }
}

function validate_whatsapp($whatsapp)
{
    // Example validation: check if the whatsapp number is numeric and has 10-15 digits
    if (preg_match('/^[0-9]{10,15}$/', $whatsapp)) {
        return $whatsapp;
    } else {
        return false;
    }
}
