<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="funcionarios.css">
  <link rel="stylesheet" href="../menu/barraLateral.css">
  <script src="../menu/menuLateral.js" defer></script>
  <script src="funcionarios.js" defer></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Pattaya&display=swap" rel="stylesheet">
  <title>Administração - Harmony Beauty</title>
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
        <li><a href="../editarFuncionarios/funcionarios.php">Funcionários</a></li>
        <li><a href="../../Login/login.html">Mudar Conta</a></li>
        <li><a href="../../Index/index.html">Sair</a></li>
      </ul>
    </div>
  </header>    

  <main>
    <h1 class="afastar">Funcionários</h1>
    <section id="funcionarios-lista">
      
    </section>

    <div class="actions">
        <button class="editButton adicionar" onclick="openModal()">Adicionar Funcionário</button>
    </div>
  </main>

  <div class="modal-wrapper">
    <div class="modal">
      <img src="../../imagens/harmonyBeauty.png" alt="Harmony Beauty Logo" class="modal-logo">
      <button class="close-modal" onclick="closeModal()">×</button>
      <h2 id="modal-title">Adicionar Funcionário</h2>
      <form id="form-funcionario" action="addFuncionarios.php" method="POST">
        <label for="m-name">Nome</label>
        <input type="text" id="m-name" name="nome" placeholder="Digite o nome do funcionário" required>
      
        <label for="m-function">Função</label>
        <input type="text" id="m-function" name="funcao" placeholder="Digite a função" required>
      
        <label for="m-salary">Salário</label>
        <input type="text" id="m-salary" name="salario" placeholder="Digite o salário por hora" required>
      
        <button type="submit" id="btn-salvar">Salvar</button>
      </form>      
      
    </div>
  </div>
</body>
</html>
