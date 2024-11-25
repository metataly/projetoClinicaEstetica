<?php
// Configuração do banco de dados
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'harmonybeauty';

// Conectar ao banco de dados
$conn = new mysqli($host, $usuario, $senha, $banco);


if ($conn->connect_error) {
    
    echo json_encode(["status" => "error", "message" => "Erro na conexão com o banco de dados: " . $conn->connect_error]);
    exit(); 
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST['data'];
    $horario = $_POST['horario'];
    $servico = $_POST['servico'];

 
    if (!empty($data) && !empty($horario) && !empty($servico)) {
        // Inserir os dados no banco de dados
        $sql = "INSERT INTO servico (data, horario, servico) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $data, $horario, $servico);

        if ($stmt->execute()) {
            // Retorna sucesso em JSON
            echo json_encode(["status" => "success", "message" => "Pré-agendamento salvo com sucesso! O agendamento será processado após o pagamento!"]);
        } else {
            // Retorna erro em JSON
            echo json_encode(["status" => "error", "message" => "Erro ao salvar agendamento: " . $conn->error]);
        }

        $stmt->close();
    } else {
      
        echo json_encode(["status" => "error", "message" => "Data, horário ou serviço não informados."]);
    }
}

$conn->close();
?>
