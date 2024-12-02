<?php
// Conexão com o banco de dados
$host = '127.0.0.1';
$user = 'root';
$password = '';
$database = 'harmonybeauty';

$conn = new mysqli($host, $user, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta ao banco de dados para recuperar os serviços e os nomes dos funcionários
$sql = "SELECT s.id, s.nome AS servico_nome, s.valor, f.nome AS funcionario_nome
        FROM servicosadmin s
        LEFT JOIN funcionarios f ON f.id = s.funcionario_id
        ORDER BY s.nome"; // Organize por nome do serviço

$result = $conn->query($sql);

// Verifique se houve erro na consulta SQL
if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index-admin.css">
    <link rel="stylesheet" href="../menu/barraLateral.css">
    <script src="../menu/menuLateral.js" defer></script>
    <title>Visão Geral - Admin</title>
    <script src="../script.js" defer></script>

</head>
<body>
    <header>
        <img src="../../imagens/harmonyBeauty.png" alt="Logomarca Harmony Beauty" class="center-logo">
        <button id="menu">☰</button>
        <div id="barra">
            <h2>Perfil</h2>
            <div id="perfil">
                <img src="../../imagens/perfil.png" alt="Perfil">
                <div>
                    <p>Administrador</p>
                    <p>admin@gmail.com</p>
                </div>
            </div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="../editarFuncionarios/funcionarios.php">Funcionários</a></li>
                <li><a href="../../Login/login.html">Mudar Conta</a></li>
                <li><a href="../../Index/index.html">Sair</a></li>
            </ul>
        </div>
    </header>

    <main>
        <div class="welcome-text">
            <p><strong>Bem-vindo, Administrador</strong></p>
        </div>
        <div class="visao">
            <p>Visão geral do site</p>
        </div>

        <!-- Seção de Serviços -->
        <section class="services">
            <h2>Serviços Disponíveis</h2>
            <div id="servicesContainer">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Construção correta do caminho da imagem
                        $imagePath = "../../imagens/" . $row['servico_nome'] . ".png";
                    
                        echo "
                        <div class='service'>
                            <img src='$imagePath' alt='" . $row['servico_nome'] . "'>
                            <div>
                                <p><strong>Serviço:</strong> " . $row['servico_nome'] . "</p>
                                <p><strong>Valor:</strong> R$ " . number_format($row['valor'], 2, ',', '.') . "</p>
                                <p><strong>Funcionário:</strong> " . ($row['funcionario_nome'] ?? "Não atribuído") . "</p>
                                <a href='#' class='details'><strong>Mostrar detalhes ></strong></a>
                            </div>
                            <button class='delete' onclick='deleteService(event, " . $row['id'] . ")'>🗑️</button>
                        </div>
                        ";
                    }
                    
                } else {
                    echo "<p>Nenhum serviço encontrado.</p>";
                }
                ?>

            </div>
            <button class="addService" onclick="window.location.href='../adicionarServices/addService.php'">Adicionar Serviço</button>
            <hr class="divisor">
        <section class="equipe">
            <h2>Funcionários: 5</h2>
            <!-- Grid de Funcionários -->
            <div class="gridEquipe">
                <div class="membroEquipe">
                    <img src="../../imagens/funcionario.png" alt="Funcionário 1">
                    <p class="nomeEquipe">Douglas Daraio</p>
                    <a href="#" class="details"><strong>Ver Detalhes ></strong></a>
                </div>
                <div class="membroEquipe">
                    <img src="../../imagens/funcionario.png" alt="Funcionário 2">
                    <p class="nomeEquipe">Nathaly Pereira</p>
                    <a href="#" class="details"><strong>Ver Detalhes ></strong></a>
                </div>
                <div class="membroEquipe">
                    <img src="../../imagens/funcionario.png" alt="Funcionário 3">
                    <p class="nomeEquipe">Kauã Pessoa</p>
                    <a href="#" class="details"><strong>Ver Detalhes ></strong></a>
                </div>
                <div class="membroEquipe">
                    <img src="../../imagens/funcionario.png" alt="Funcionário 4">
                    <p class="nomeEquipe">Maria Ximenes</p>
                    <a href="#" class="details"><strong>Ver Detalhes ></strong></a>
                </div>
                <div class="membroEquipe">
                    <img src="../../imagens/funcionario.png" alt="Funcionário 5">
                    <p class="nomeEquipe">Gabriel Seidel</p>
                    <a href="#" class="details"><strong>Ver Detalhes ></strong></a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <table class="tabelaFooter">
            <tr>
                <th><h2 style="text-align: center;">Sobre nós</h2></th>
                <th><h2 style="text-align: center;">Horário de Funcionamento</h2></th>
            </tr>
            <tr>
                <td>
                    <div class="textoFooter">
                        <p>
                            Bem-vindo ao nosso espaço dedicado à sua beleza. Especializados em preenchimento facial,
                            limpeza de pele, depilação, podologia e tratamento de rugas, oferecemos uma experiência
                            excepcional. Acreditamos na beleza como uma jornada pessoal, guiando-o com expertise.
                        </p>
                    </div>
                </td>
                <td>
                    <div class="horario">
                        <ul>
                            <li><strong>Domingo:</strong> Fechado</li>
                            <li><strong>Segunda-feira:</strong> 08:00 – 16:00</li>
                            <li><strong>Terça-feira:</strong> 08:00 – 16:00</li>
                            <li><strong>Quarta-feira:</strong> 08:00 – 16:00</li>
                            <li><strong>Quinta-feira:</strong> 08:00 – 16:00</li>
                            <li><strong>Sexta-feira:</strong> 08:00 – 16:00</li>
                            <li><strong>Sábado:</strong> Fechado</li>
                        </ul>
                    </div>
                </td>
            </tr>
        </table>
    </footer>
</body>
</html>
