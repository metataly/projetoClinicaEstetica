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
    async function saveService() {
      const nome = document.getElementById('servico').value;
      const valor = document.getElementById('valor').value;
      const funcionarioId = document.getElementById('funcionario').value;

      // Verifica se os campos estão preenchidos
      if (nome && valor && funcionarioId) {
        if (isNaN(valor) || valor <= 0) {
          alert("Por favor, insira um valor válido para o serviço.");
          return;
        }

        const newService = {
          nome: nome,
          valor: parseFloat(valor),
          funcionarioId: funcionarioId
        };

        try {
          // Envia os dados do serviço para o servidor usando fetch
          const response = await fetch('saveService.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(newService)
          });

          const result = await response.json();
          if (result.success) {
            alert("Serviço criado com sucesso!");
            window.location.href = '../home-admin/index-admin.php';  // Redireciona para a página de administração
          } else {
            alert("Erro ao criar serviço: " + result.error);
          }
        } catch (error) {
          console.error("Erro ao salvar o serviço:", error);
          alert("Erro ao salvar o serviço.");
        }
      } else {
        alert("Por favor, preencha todos os campos.");
      }
    }

    async function loadFuncionarios() {
      try {
        const response = await fetch('../editarFuncionarios/getFuncionarios.php');
        const text = await response.text();
        console.log("Resposta do servidor: ", text);
        const data = JSON.parse(text);

        if (!data.success) {
          console.error('Erro ao carregar funcionários:', data.error || 'Erro desconhecido');
          return;
        }

        const funcionarios = data.funcionarios;
        const select = document.getElementById('funcionario');
        const defaultOption = document.createElement('option');
        defaultOption.textContent = 'Selecione um funcionário';
        defaultOption.disabled = true;
        defaultOption.selected = true;
        select.appendChild(defaultOption);

        funcionarios.forEach(funcionario => {
          const option = document.createElement('option');
          option.value = funcionario.id;
          option.textContent = funcionario.nome;
          select.appendChild(option);
        });
      } catch (error) {
        console.error('Erro ao carregar funcionários:', error);
      }
    }

    loadFuncionarios();
  </script>
</head>
<body>
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
        <li><a href="../../administrador/home-admin/index-admin.php">Home</a></li>
        <li><a href="../../administrador/editarFuncionarios/funcionarios.php">Funcionários</a></li>
        <li><a href="../../Login/login.html">Mudar Conta</a></li>
        <li><a href="../../Index/index.html">Sair</a></li>
      </ul>
    </div>
  </header>

  <main>
    <section class="service">
      <div class="icon-container">
        <img src="../../imagens/Servicos.png" alt="Ícone do Serviço" class="icon">
      </div>
      <div class="service-details">
        <div class="input-group">
          <label for="servico">Nome do serviço:</label>
          <input type="text" id="servico" name="servico" placeholder="Digite o serviço">
        </div>
        <div class="input-group">
          <label for="valor">Valor do serviço:</label>
          <input type="text" id="valor" name="valor" placeholder="Digite o valor">
        </div>
      </div>
    </section>

    <aside class="details">
      <img src="../../imagens/harmonyBeauty.png" alt="Logo">
      <p class="criarServico">Criação de Serviço Personalizado com qualquer profissional</p>
      <button class="create" onclick="saveService()">Criar</button>
    </aside>
  </main>

  <section class="team">
    <label for="funcionario">Selecionar Funcionário:</label>
    <select id="funcionario" name="funcionario"></select>

    <div class="team-grid">
      <div class="team-member">
        <img style="width: 120px; height: 120px;" src="../../imagens/funcionario.png" alt="Ícone de Membro" class="icon">
      </div>
      <textarea class="description" placeholder="Adicionar descrição do funcionário..."></textarea>
    </div>
  </section>
</body>
</html>
