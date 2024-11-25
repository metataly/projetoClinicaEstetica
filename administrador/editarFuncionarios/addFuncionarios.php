<?php
$hostname = "localhost";
$bancodedados = "clinicaestetica";
$usuario = "root";
$senha = "";

// Conectar ao banco de dados
$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($mysqli->connect_errno) {
    die(json_encode(['success' => false, 'message' => 'Erro de conexão: ' . $mysqli->connect_error]));
}

// Verificar se é uma requisição POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados enviados
    $nome = $_POST['nome'] ?? '';
    $funcao = $_POST['funcao'] ?? '';
    $salario = $_POST['salario'] ?? '';

    // Validar os dados
    if (empty($nome) || empty($funcao) || empty($salario)) {
        echo json_encode(['success' => false, 'message' => 'Todos os campos são obrigatórios.']);
        exit;
    }

    // Inserir os dados no banco de dados
    $query = "INSERT INTO funcionarios (nome, servico, salario) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);

    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Erro ao preparar a consulta: ' . $mysqli->error]);
        exit;
    }

    // Vincular parâmetros e executar
    $stmt->bind_param("ssd", $nome, $funcao, $salario);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Funcionário adicionado com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao executar a consulta: ' . $stmt->error]);
    }

    // Fechar conexão
    $stmt->close();
    $mysqli->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método de requisição inválido.']);
}
?>
