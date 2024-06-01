<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdata";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$eventName = $_POST['nama_event'];
$eventDate = $_POST['tanggal'];
$startTime = $_POST['waktu_mulai'];
$endTime = $_POST['waktu_selesai'];
$eventLocation = $_POST['lokasi'];

$sql = "INSERT INTO events (nama_event, tanggal, waktu_mulai, waktu_selesai, lokasi) VALUES ('$eventName', '$eventDate', '$startTime', '$endTime', '$eventLocation')";

if ($conn->query($sql) === TRUE) {
  echo "New event created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>