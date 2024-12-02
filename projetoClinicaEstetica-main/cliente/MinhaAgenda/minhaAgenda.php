<?php
// Configurações do banco de dados
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'harmonybeauty';

$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verifica se um parâmetro 'data' foi enviado via GET
$dataFiltro = isset($_GET['data']) ? $_GET['data'] : '';

if ($dataFiltro) {
    $sql = "SELECT id, data, horario, servico FROM servico WHERE data = '$dataFiltro'";
} else {
    $sql = "SELECT id, data, horario, servico FROM servico";
}

$result = $conn->query($sql);

$agendamentos = [];

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $agendamentos[] = $row;
    }
}

// Retorna os agendamentos como JSON
header('Content-Type: application/json');
echo json_encode($agendamentos);

$conn->close();
?>
