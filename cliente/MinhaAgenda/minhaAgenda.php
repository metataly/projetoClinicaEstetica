<?php
// Configurações do banco de dados
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'harmonybeauty';

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta para obter os agendamentos
$sql = "SELECT id, data, horario, servico FROM servico"; // Inclua o ID na consulta
$result = $conn->query($sql);

$agendamentos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $agendamentos[] = $row; // Adiciona cada agendamento ao array
    }
}

// Retorna os agendamentos como JSON
header('Content-Type: application/json');
echo json_encode($agendamentos);

$conn->close();
?>
