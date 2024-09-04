<?php
include 'db.php';
header('Content-Type: application/json');
if (isset($_POST['checkout']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pelanggan = sanitize_input($_POST['nama']);
    $data = compact('nama_pelanggan');
    $errors = validate($data);
    if (empty($errors)) {
        $updated_at = date("Y-m-d H:i:s");
        // update data
        $sql = "UPDATE orders SET nama_pelanggan='$nama_pelanggan', updated_at='$updated_at' WHERE in_cart = 1";
        $conn->query($sql);
        $conn->close();
        $response = [
            'status' => 'success',
            'message' => 'Pesanan berhasil diproses'
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status' => 'error',
            'message' => $errors
        ];
        echo json_encode($response);
    }
}
if (isset($_POST['konfimasi']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $catatan = $_POST['catatan'];
    $pembayaran = $_POST['pembayaran'];
    $_SESSION['pembayaran'] = $pembayaran;
    $updated_at = date("Y-m-d H:i:s");
    $sql = "UPDATE orders SET catatan='$catatan', status='Diproses', in_cart=0,  updated_at='$updated_at' WHERE in_cart = 1";
    $conn->query($sql);
    $conn->close();
    $response = [
        'status' => 'success',
        'message' => 'Pesanan berhasil diproses'
    ];
    echo json_encode($response);
}
function validate($param)
{
    $errors = [];
    if (empty($param['nama_pelanggan'])) {
        $errors[] = 'Nama tidak boleh kosong';
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
