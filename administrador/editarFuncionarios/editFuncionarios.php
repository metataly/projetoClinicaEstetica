<?php
$mysqli = new mysqli("localhost", "root", "", "harmonybeauty");

if ($mysqli->connect_errno) {
    die("Falha ao conectar: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifique se todos os dados foram recebidos
    if (isset($_POST['nome']) && isset($_POST['funcao']) && isset($_POST['salario']) && isset($_POST['id'])) {
        $nome = $_POST['nome'];
        $funcao = $_POST['funcao'];
        $salario = $_POST['salario'];
        $id = $_POST['id'];

        // Verifique se os valores não estão vazios
        if (empty($nome) || empty($funcao) || empty($salario) || empty($id)) {
            echo json_encode(['success' => false, 'message' => 'Dados incompletos ou inválidos.']);
            exit;
        }

        // A query para atualizar o funcionário
        $query = "UPDATE funcionarios SET nome = ?, servico = ?, salario = ? WHERE id = ?";
        $stmt = $mysqli->prepare($query);

        if ($stmt === false) {
            echo json_encode(['success' => false, 'message' => 'Erro na preparação da query: ' . $mysqli->error]);
            exit;
        }

        // Associa os parâmetros e executa
        $stmt->bind_param("ssdi", $nome, $funcao, $salario, $id);

        // Execute a query
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Funcionário atualizado com sucesso!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao atualizar funcionário.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Dados incompletos ou inválidos.']);
    }

    $mysqli->close();
}
?>
