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
    
    function saveService() 
    {
      const nome = document.getElementById('servico').value;
      const valor = document.getElementById('valor').value;
      const funcionarioId = document.getElementById('funcionario').value;  // Obter o funcionário selecionado

      // Verifica se os campos estão preenchidos
      if (nome && valor && funcionarioId) {
          const newService = {
              nome: nome,
              valor: valor,
              funcionarioId: funcionarioId,  // Associando ao funcionário selecionado
          };

          // Verifica se já existe um serviço para o funcionário
          let services = JSON.parse(localStorage.getItem('services')) || [];
          
          // Adiciona o novo serviço, evitando duplicação
          const existingService = services.find(service => service.funcionarioId === funcionarioId && service.nome === nome);
          if (existingService) {
              alert("Este serviço já foi criado para este funcionário.");
              return;  // Evita salvar o serviço duplicado
          }

          services.push(newService);  // Adiciona o novo serviço
          localStorage.setItem('services', JSON.stringify(services));

          // Desabilita o botão enquanto o serviço está sendo criado
          const createButton = document.querySelector('.create');
          createButton.disabled = true;

          // Alerta e redireciona para a página de administração
          alert("Serviço criado com sucesso!");
          window.location.href = '../home-admin/index-admin.html';  // Redireciona para a página de administração
      } else {
          alert("Por favor, preencha todos os campos.");
      }
    }

    // Função para carregar os funcionários no select
    async function loadFuncionarios() 
    {
      try 
      {
        // Atualizado o caminho para o arquivo correto
        const response = await fetch('../editarFuncionarios/getFuncionarios.php');
        
        // Log para verificar a resposta antes de tentar fazer o .json()
        const text = await response.text();
        console.log("Resposta do servidor: ", text);  // Log da resposta como texto

        // Tente fazer o parse do JSON
        const data = JSON.parse(text);  // Agora com o texto que você pegou

        // Verificando se houve algum erro no retorno
        if (!data.success) {
          console.error('Erro ao carregar funcionários:', data.error || 'Erro desconhecido');
          return;
        }

        // Agora acessando o array de funcionários corretamente
        const funcionarios = data.funcionarios;

        // Obtendo o select de funcionários
        const select = document.getElementById('funcionario');

        // Criando uma opção padrão
        const defaultOption = document.createElement('option');
        defaultOption.textContent = 'Selecione um funcionário';
        defaultOption.disabled = true;
        defaultOption.selected = true;
        select.appendChild(defaultOption);

        // Preenchendo o select com os funcionários
        funcionarios.forEach(funcionario => {
          const option = document.createElement('option');
          option.value = funcionario.id;  // Usando o id como valor
          option.textContent = funcionario.nome;  // Nome do funcionário
          select.appendChild(option);
        });
      } catch (error) {
        // Caso haja erro ao fazer a requisição
        console.error('Erro ao carregar funcionários:', error);
      }
  }


loadFuncionarios();

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
        <li><a href="../../administrador/home-admin/index-admin.html">Home</a></li> 
            <li><a href="../../administrador/editarFuncionarios/funcionarios.php">Funcionários</a></li>
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

    <div class="team-grid">
      <div class="team-member">
        <img style="width: 120px; height: 120px;"src="../../imagens/funcionario.png" alt="Ícone de Membro" class="icon">
      </div>
      <textarea class="description" placeholder="Adicionar descrição do funcionário..."></textarea>
    </div>
  </section>
</body>
</html>
