<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "biequeen";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = "UPDATE orders SET status = 'Dibatalkan' WHERE status IN ('Menunggu', 'Diproses') AND TIMESTAMPDIFF(MINUTE,updated_at, NOW()) > 10;
";
$conn->query($query);
// if ($conn->query($query) === TRUE) {
//     echo "Orders updated successfully.";
// } else {
//     echo "Error updating orders: " . $conn->error;
// }
