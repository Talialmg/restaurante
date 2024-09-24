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

if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['fecha']) || empty($_POST['hora']) || empty($_POST['personas'])) {
    die('Por favor, completa todos los campos.');
}

$nombre = trim($_POST['nombre']);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$fecha = trim($_POST['fecha']);
$hora = trim($_POST['hora']);
$personas = (int)$_POST['personas']; 

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Por favor, ingresa un correo electrónico válido.');
}

if ($fecha < date('Y-m-d')) {
    die('La fecha debe ser a partir de hoy.');
}

$stmt = $conn->prepare("INSERT INTO reservas (nombre, email, fecha, hora, cantidad_personas, fecha_reserva) VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("ssssi", $nombre, $email, $fecha, $hora, $personas);

if ($stmt->execute()) {
    header("Location: RESPUESTA.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>