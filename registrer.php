<?php
header('Access-Control-Allow-Origin: *'); // Permitir conexiones de cualquier origen
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json; charset=UTF-8');

$host = 'localhost';
$user = 'root';
$password = ''; // Coloca aquí la contraseña de tu base de datos
$dbname = 'login_app'; // Asegúrate que esta sea la base de datos correcta

// Conectar a MySQL
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array('success' => false, 'message' => 'Error de conexión a la base de datos.')));
}

// Obtener los datos enviados en el POST
$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];
$password = $data['password'];

// Verificar si el usuario ya existe
$query = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(array('success' => false, 'message' => 'El email ya está registrado.'));
} else {
    // Insertar nuevo usuario
    $query = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    
    if ($stmt->execute()) {
        echo json_encode(array('success' => true, 'message' => 'Usuario registrado exitosamente.'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Error al registrar el usuario.'));
    }
}

$stmt->close();
$conn->close();
?>
