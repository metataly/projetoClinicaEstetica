<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'harmonybeauty';

// Conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha, $banco);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verifica se o ID foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Deleta o agendamento com base no ID
    $sql = "DELETE FROM servico WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Agendamento excluído com sucesso.";
    } else {
        echo "Erro ao excluir agendamento.";
    }

    $stmt->close();
} else {
    echo "ID do agendamento não fornecido.";
}

$conn->close();
?>
