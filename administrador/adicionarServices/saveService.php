<?php
// Conexão com o banco de dados
$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'harmonybeauty';

$conn = new mysqli($host, $user, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Recebe os dados do serviço enviados via POST
$data = json_decode(file_get_contents('php://input'), true);

// Verifica se os dados estão corretos
if (isset($data['nome'], $data['valor'], $data['funcionarioId'])) {
    $nome = $data['nome'];
    $valor = $data['valor'];
    $funcionarioId = $data['funcionarioId'];

    // Inserir o novo serviço no banco de dados
    $sql = "INSERT INTO servicosadmin (nome, valor, funcionario_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $nome, $valor, $funcionarioId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Erro ao criar serviço']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Dados inválidos']);
}

$conn->close();
?>
