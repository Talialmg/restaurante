<?php
header('Content-Type: text/html; charset=utf-8');

$servername = "localhost";
$username = "user0305";
$password = "12345=";
$dbname = "restaurante";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['mensaje'])) {
    die('Por favor, completa todos los campos.');
}

$nombre = trim($_POST['nombre']);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$mensaje = trim($_POST['mensaje']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Por favor, ingresa un correo electrónico válido.');
}

$stmt = $conn->prepare("INSERT INTO contacto (nombre, email, mensaje, fecha) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("sss", $nombre, $email, $mensaje);

if ($stmt->execute()) {
    header("Location: RESPUESTA.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>