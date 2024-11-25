const menuButton = document.getElementById('menu');
const barra = document.getElementById('barra');

// Alternar a classe 'active' para abrir/fechar a barra lateral
menuButton.addEventListener('click', () => {
  barra.classList.toggle('active');
});
