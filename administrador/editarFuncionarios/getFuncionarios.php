<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

$hostname = "localhost";
$bancodedados = "harmonybeauty";
$usuario = "root";
$senha = "";

// Conexão com o banco de dados
$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($mysqli->connect_errno) {
    echo json_encode(['success' => false, 'message' => 'Erro na conexão com o banco de dados: ' . $mysqli->connect_error]);
    exit;
}

// Consulta para buscar todos os funcionários
$query = "SELECT id, nome, servico, salario FROM funcionarios";
$result = $mysqli->query($query);

if (!$result) {
    echo json_encode(['success' => false, 'message' => 'Erro na execução da consulta: ' . $mysqli->error]);
    exit;
}

// Processa os dados obtidos
$funcionarios = [];
while ($row = $result->fetch_assoc()) {
    $funcionarios[] = $row;
}

// Resposta em JSON
echo json_encode(['success' => true, 'funcionarios' => $funcionarios]);

$mysqli->close();
?>