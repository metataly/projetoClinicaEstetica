<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

$hostname = "localhost";
$bancodedados = "clinicaestetica";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($mysqli->connect_errno) {
    echo json_encode(['success' => false, 'message' => 'Falha na conexão com o banco de dados.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $funcao = $_POST['funcao'];
    $salario = $_POST['salario'];

    $query = "INSERT INTO funcionarios (nome, servico, salario) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssd", $nome, $funcao, $salario);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Funcionário adicionado com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao adicionar funcionário: ' . $stmt->error]);
    }

    $stmt->close();
    $mysqli->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método de requisição inválido.']);
}
