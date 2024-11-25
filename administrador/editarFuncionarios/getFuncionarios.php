<?php
$mysqli = new mysqli("localhost", "root", "", "clinicaestetica");

if ($mysqli->connect_errno) {
    die(json_encode(['success' => false, 'message' => 'Erro de conexão: ' . $mysqli->connect_error]));
}

header('Content-Type: application/json; charset=utf-8');

$result = $mysqli->query("SELECT * FROM funcionarios");

$funcionarios = [];
while ($row = $result->fetch_assoc()) {
    $funcionarios[] = [
        'id' => (int) $row['id'],
        'nome' => htmlspecialchars($row['nome']),
        'servico' => htmlspecialchars($row['servico']),
        'salario' => (float) $row['salario']
    ];
}

echo json_encode(['success' => true, 'funcionarios' => $funcionarios]);

$mysqli->close();
?>
