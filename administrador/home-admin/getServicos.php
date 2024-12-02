<?php
header('Content-Type: application/json');

$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'harmonybeauty';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => "Erro de conexão: " . $conn->connect_error]);
    exit;
}

$query = "
    SELECT 
        servicosadmin.id, 
        servicosadmin.nome AS servico_nome, 
        servicosadmin.valor, 
        funcionarios.nome AS funcionario_nome 
    FROM 
        servicosadmin 
    LEFT JOIN 
        funcionarios 
    ON 
        servicosadmin.funcionario_id = funcionarios.id
";

$result = $conn->query($query);

if (!$result) {
    echo json_encode(["success" => false, "error" => "Erro na consulta SQL: " . $conn->error]);
    exit;
}

$services = [];
while ($row = $result->fetch_assoc()) {
    $services[] = $row;
}

echo json_encode(["success" => true, "services" => $services]);