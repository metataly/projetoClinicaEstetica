<?php
$hostname = "localhost";
$bancodedados = "clinicaestetica";
$usuario = "root";
$senha = "";

// Conexão com o banco de dados
$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($mysqli->connect_errno) {
    die(json_encode(['success' => false, 'message' => 'Erro de conexão: ' . $mysqli->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter dados enviados
    $id = intval($_POST['id']);
    $nome = trim($_POST['nome']);
    $funcao = trim($_POST['funcao']);
    $salario = floatval($_POST['salario']);

    // Validar os dados
    if ($id <= 0 || empty($nome) || empty($funcao) || $salario <= 0) {
        echo json_encode(['success' => false, 'message' => 'Dados inválidos!']);
        exit;
    }

    // Atualizar dados no banco de dados
    $query = "UPDATE funcionarios SET nome = ?, servico = ?, salario = ? WHERE id = ?";
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssdi", $nome, $funcao, $salario, $id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Funcionário atualizado com sucesso!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao atualizar funcionário: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro na preparação da consulta.']);
    }
    
    $mysqli->close();
}
?>
