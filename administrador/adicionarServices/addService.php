<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Serviço</title>
  <link rel="stylesheet" href="addService.css">
  <link rel="stylesheet" href="../menu/barraLateral.css">
  <script src="../menu/menuLateral.js" defer></script>
  <script>
    // Função para salvar o serviço no localStorage
    function saveService() {
        const nome = document.getElementById('servico').value;
        const valor = document.getElementById('valor').value;

        // Verifica se os campos estão preenchidos
        if (nome && valor) {
            const newService = {
                nome: nome,
                valor: valor,
            };

            // Adiciona o serviço ao localStorage
            let services = JSON.parse(localStorage.getItem('services')) || [];
            services.push(newService);
            localStorage.setItem('services', JSON.stringify(services));

            // Alerta e redireciona para a página de administração
            alert("Serviço criado com sucesso!");
            window.location.href = 'index-admin.html';  // Redireciona para index-admin.html
        } else {
            alert("Por favor, preencha todos os campos.");
        }
    }
  </script>
</head>
<body>
  <!-- Cabeçalho -->
  <header>
    <button onclick="window.history.back()">Voltar</button>
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
            <li><a href="#">Perfil</a></li>
            <li><a href="../administrador/editarFuncionarios/funcionarios.php"></a>Funcionários</li>
            <li><a href="../../Login/login.html">Mudar Conta</a></li>
            <li><a href="../../Index/index.html">Sair</a></li>
        </ul>
      </div>
  </header>    

  <main>
    <!-- Bloco do Serviço -->
    <section class="service">
        <div class="icon-container">
            <img src="../../imagens/Servicos.png" alt="Ícone do Serviço" class="icon">
        </div>
        <div class="service-details">
            <div class="input-group">
                <label for="servico">Nome do serviço:</label>
                <input type="text" id="servico" name="servico" placeholder="Digite o servico">
            </div>
            <div class="input-group">
                <label for="valor">Valor do serviço:</label>
                <input type="text" id="valor" name="valor" placeholder="Digite o valor">
            </div>
        </div>
    </section>
    <!-- Bloco de Detalhes -->
    <aside class="details">
      <img src="../../imagens/harmonyBeauty.png" alt="Logo">
      <button class="create" onclick="saveService()">Criar</button>
    </aside>
  </main> 
  <section class="team">
    <label for="funcionario">Selecionar Funcionário:</label>
  <select id="funcionario" name="funcionario">

  </select>

  <script>
    async function loadFuncionarios() 
    {
      try 
      {
        const response = await fetch('../editarFuncionarios/getFuncionarios.php');
        const funcionarios = await response.json();

        if (funcionarios.error) 
        {
          console.error('Erro ao carregar funcionários:', funcionarios.error);
          return;
        }

        const select = document.getElementById('funcionario');

        const defaultOption = document.createElement('option');
        defaultOption.textContent = 'Selecione um funcionário';
        defaultOption.disabled = true;
        defaultOption.selected = true;
        select.appendChild(defaultOption);

        funcionarios.forEach(funcionario => 
        {
          const option = document.createElement('option');
          option.value = funcionario.id; 
          option.textContent = funcionario.nome;
          select.appendChild(option);
        });
      } 
      catch (error) 
      {
        console.error('Erro ao carregar funcionários:', error);
      }
    }
    loadFuncionarios();
  
  </script>
    <div class="team-grid">
      <div class="team-member">
        <img style="width: 120px; height: 120px;"src="../../imagens/funcionario.png" alt="Ícone de Membro" class="icon">
      </div>
      <textarea class="description" placeholder="Adicionar descrição..."></textarea>
    </div>
  </section>
</body>
</html>
