<?php
header('Content-Type: application/json');

// Conexão com o banco de dados
$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'harmonybeauty';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Erro de conexão']);
    exit;
}

// Lê os dados enviados pelo fetch
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $id = intval($data['id']);

    // Executar exclusão
    $sql = "DELETE FROM servicosadmin WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'ID não fornecido']);
}

$conn->close();
?>
