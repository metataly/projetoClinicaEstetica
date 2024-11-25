const modalWrapper = document.querySelector('.modal-wrapper');
const modalForm = document.querySelector('#form-funcionario');
const modalTitle = document.querySelector('#modal-title');
const btnSalvar = document.querySelector('#btn-salvar');
const funcionariosLista = document.querySelector('#funcionarios-lista');

let itens = [];
let id = null;

// Abrir o modal (adicionar ou editar)
function openModal(edit = false, index = null) {
  modalWrapper.classList.add('active');
  if (edit) {
    modalTitle.textContent = 'Editar Funcionário';
    const item = itens[index];
    document.querySelector('#m-name').value = item.nome;
    document.querySelector('#m-function').value = item.funcao;
    document.querySelector('#m-salary').value = item.salario;
    id = item.id; // Pega o ID real do banco
  } else {
    modalTitle.textContent = 'Adicionar Funcionário';
    modalForm.reset();
    id = null;
  }
}

function closeModal() {
  modalWrapper.classList.remove('active');
}

// Salvar (adicionar ou editar)
btnSalvar.onclick = async (e) => {
  e.preventDefault();
  const name = document.querySelector('#m-name').value.trim();
  const funcao = document.querySelector('#m-function').value.trim();
  const salario = parseFloat(document.querySelector('#m-salary').value.trim());

  if (!name || !funcao || isNaN(salario) || salario <= 0) {
    alert('Preencha todos os campos corretamente!');
    return;
  }

  const action = id !== null ? 'editFuncionarios.php' : 'addFuncionarios.php';
  const data = { nome: name, funcao: funcao, salario: salario };
  if (id !== null) data.id = id; // Inclui o ID no caso de edição

  const result = await sendData(action, data);

  if (result.success) {
    alert(result.message);
    loadItens(); // Recarrega a lista após a operação
    closeModal();
  } else {
    alert('Erro: ' + result.message);
  }
};

// Função para enviar dados ao servidor
async function sendData(url, data) {
  try {
    const response = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: new URLSearchParams(data), // URL-encoded
    });
    return await response.json();
  } catch (error) {
    console.error('Erro na conexão com o servidor:', error);
    return { success: false, message: 'Erro de conexão com o servidor.' };
  }
}

// Carregar lista de funcionários do servidor
async function loadItens() {
  try {
    const response = await fetch('getFuncionario.php');
    const data = await response.json();
    if (data.success) {
      itens = data.funcionarios;
      renderList();
    } else {
      alert('Erro ao carregar funcionários: ' + data.message);
    }
  } catch (error) {
    console.error('Erro ao carregar funcionários:', error);
  }
}

// Renderizar lista no DOM
function renderList() {
  funcionariosLista.innerHTML = ''; // Limpa a lista antes de atualizar
  itens.forEach((item, index) => {
    const funcionarioDiv = document.createElement('div');
    funcionarioDiv.classList.add('funcionario');
    funcionarioDiv.innerHTML = `
      <img src="../imagens/funcionario.png" alt="Funcionário">
      <div class="infoFuncionario">
        <p><strong>Nome:</strong> ${item.nome}</p>
        <p><strong>Salário por hora:</strong> R$ ${item.salario}</p>
        <div class="divisor"></div>
        <p><strong>Serviço:</strong> ${item.servico}</p>
      </div>
      <button class="verEscala" onclick="openModal(true, ${index})">Editar</button>
      <button class="verEscala" onclick="deleteItem(${item.id})">Excluir</button>
    `;
    funcionariosLista.appendChild(funcionarioDiv);
  });
}

// Função para deletar um funcionário
async function deleteItem(id) {
  if (confirm('Tem certeza que deseja excluir este funcionário?')) {
    const result = await sendData('deleteFuncionario.php', { id: id });
    if (result.success) {
      alert(result.message);
      loadItens();
    } else {
      alert('Erro: ' + result.message);
    }
  }
}

// Carregar os funcionários ao iniciar
loadItens();
