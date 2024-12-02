<?php
// Conexão com o banco de dados
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'harmonybeauty';

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];  // ID do agendamento a ser editado
    $data = $_POST['data'];
    $horario = $_POST['horario'];

    if (!empty($id) && !empty($data) && !empty($horario)) {
        // Atualiza os dados do agendamento
        $sql = "UPDATE servico SET data = ?, horario = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $data, $horario, $id);

        if ($stmt->execute()) {
            echo "Agendamento atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar agendamento: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Todos os campos são obrigatórios.";
    }
}

$conn->close();
?>
