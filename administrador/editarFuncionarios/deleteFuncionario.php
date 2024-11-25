<?php
$mysqli = new mysqli("localhost", "root", "", "clinicaestetica");

if ($mysqli->connect_errno) {
    die(json_encode(['success' => false, 'message' => 'Erro de conexão: ' . $mysqli->connect_error]));
}

$data = json_decode(file_get_contents('php://input'), true);
$id = intval($data['id']);

if ($id <= 0) {
    echo json_encode(['success' => false, 'message' => 'ID inválido.']);
    exit;
}

$query = "DELETE FROM funcionarios WHERE id = ?";
$stmt = $mysqli->prepare($query);

if ($stmt) {
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Funcionário excluído com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao excluir o funcionário: ' . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Erro na preparação da consulta.']);
}
$mysqli->close();
?>
