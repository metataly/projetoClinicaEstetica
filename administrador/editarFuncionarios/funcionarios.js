const modalWrapper = document.querySelector('.modal-wrapper');
const modalForm = document.querySelector('#form-funcionario');
const modalTitle = document.querySelector('#modal-title');
const btnSalvar = document.querySelector('#btn-salvar');
const funcionariosLista = document.querySelector('#funcionarios-lista');

let itens = [];
let id;  // Variável que armazenará o ID quando editando um funcionário

// Função para abrir o modal de adicionar/editar
function openModal(edit = false, index = null) {
  modalWrapper.classList.add('active');
  if (edit) {
    modalTitle.textContent = 'Editar Funcionário';
    const item = itens[index];
    document.querySelector('#m-name').value = item.nome;
    document.querySelector('#m-function').value = item.funcao;
    document.querySelector('#m-salary').value = item.salario;
    id = item.id;  // Armazena o ID do funcionário para edição
  } else {
    modalTitle.textContent = 'Adicionar Funcionário';
    modalForm.reset();  // Limpa os campos do formulário
    id = null;  // Não temos ID quando estamos adicionando
  }
}

// Função para fechar o modal
function closeModal() {
  modalWrapper.classList.remove('active');
}

btnSalvar.onclick = (e) => {
  e.preventDefault();

  const name = document.querySelector('#m-name').value.trim();
  const funcao = document.querySelector('#m-function').value.trim();
  const salario = document.querySelector('#m-salary').value.trim();

  // Log para verificar os dados antes de enviar
  console.log("Enviando dados para o servidor:", { nome: name, funcao: funcao, salario: salario });

  if (!name || !funcao || !salario) {
      alert('Preencha todos os campos!');
      return;
  }

  // Envia os dados ao PHP
  if (id) {
    // Se houver ID, significa que estamos editando
    sendData('editFuncionarios.php', { nome: name, funcao: funcao, salario: salario, id: id });
  } else {
    // Caso contrário, estamos adicionando
    sendData('addFuncionarios.php', { nome: name, funcao: funcao, salario: salario });
  }
};

// Função para enviar os dados para o servidor
async function sendData(url, data) {
  console.log("Enviando dados para o servidor:", data);

  const response = await fetch(url, {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: new URLSearchParams(data),
  });

  const result = await response.json();
  console.log("Resposta do servidor:", result);

  if (result.success) {
      alert(result.message);
      loadItens();  // Recarrega a lista de funcionários
      closeModal();  // Fecha o modal
  } else {
      alert(result.message);  // Exibe a mensagem de erro
  }
}

// Função para carregar a lista de funcionários
async function loadItens() {
  try {
    const response = await fetch('http://localhost/projetoClinicaestetica-main/administrador/editarFuncionarios/getFuncionarios.php');
    const result = await response.json();

    if (!result.success) {
      console.error("Erro do servidor:", result.message);
      alert('Erro ao carregar funcionários: ' + result.message);
      return;
    }

    // Atualiza a lista de itens com os dados recebidos
    itens = result.funcionarios || [];
    updateUI();
  } catch (error) {
    console.error("Erro ao carregar funcionários:", error);
    alert('Erro ao carregar lista de funcionários. Veja o console.');
  }
}

// Função para atualizar a interface com os dados dos funcionários
function updateUI() {
  const lista = document.querySelector('#funcionarios-lista');
  lista.innerHTML = ''; // Limpa a lista antes de atualizar
  itens.forEach((item, index) => {
    const funcionarioDiv = document.createElement('div');
    funcionarioDiv.classList.add('funcionario');
    funcionarioDiv.innerHTML = `
      <img src="../../imagens/funcionario.png" alt="Funcionário">
      <div class="infoFuncionario">
        <p><strong>Nome:</strong> ${item.nome}</p>
        <p><strong>Salário por hora:</strong> R$ ${item.salario}</p>
        <div class="divisor"></div>
        <p><strong>Serviço:</strong> ${item.servico}</p>
      </div>
      <button class="verEscala" onclick="openModal(true, ${index})">Editar</button>
      <button class="verEscala" onclick="deleteItem(${index})">Excluir</button>
    `;
    lista.appendChild(funcionarioDiv);
  });
}

// Função para excluir um funcionário
function deleteItem(index) {
  const funcionario = itens[index]; // Obtém o funcionário da lista pelo índice
  const id = funcionario.id; // Garante que o ID seja extraído

  if (!id) {
    alert('Erro: ID inválido.');
    return;
  }

  if (confirm(`Tem certeza que deseja excluir o funcionário "${funcionario.nome}"?`)) {
    // Faz a requisição para deletar o funcionário
    fetch('http://localhost/projetoClinicaestetica-main/administrador/editarFuncionarios/deleteFuncionario.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id: id }),
    })
      .then((response) => response.json())
      .then((result) => {
        if (result.success) {
          alert(result.message);
          loadItens(); // Recarrega a lista
        } else {
          alert('Erro ao excluir funcionário: ' + result.message);
        }
      })
      .catch((error) => {
        console.error('Erro ao excluir funcionário:', error);
        alert('Erro ao excluir funcionário. Veja o console para mais detalhes.');
      });
  }
}

// Carregar a lista de funcionários quando a página for carregada
loadItens();
