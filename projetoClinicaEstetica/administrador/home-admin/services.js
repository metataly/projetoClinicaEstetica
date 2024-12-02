
async function loadServicos() {
    try {
        const response = await fetch('getServicos.php');
        const data = await response.json();
        console.log(data); // Loga o JSON retornado

        if (data.success && Array.isArray(data.services)) {
            const servicesContainer = document.getElementById('servicesContainer');
            servicesContainer.innerHTML = ''; 
            data.services.forEach(service => {
                const serviceElement = document.createElement('div');
                serviceElement.classList.add('service');
                serviceElement.innerHTML = `
                    <img src="../../imagens/Servicos.png" alt="${service.servico_nome}">
                    <div>
                        <p><strong>Serviço:</strong> ${service.servico_nome}</p>
                        <p><strong>Valor:</strong> R$ ${parseFloat(service.valor).toFixed(2)}</p>
                        <p><strong>Funcionário:</strong> ${service.funcionario_nome || 'Não atribuído'}</p>
                        <a href="#" class="details"><strong>Mostrar detalhes ></strong></a>
                    </div>
                    <button class="delete" onclick="deleteService(event, ${service.id})">🗑️</button>
                `;
                servicesContainer.appendChild(serviceElement);
            });
        } else {
            console.error(data.error || 'Erro desconhecido ao carregar os serviços');
        }
    } catch (error) {
        console.error('Erro ao carregar serviços:', error);
    }
}

window.onload = loadServicos;

function deleteService(event, serviceId) {
    console.log(serviceId);
    const serviceElement = event.target.closest('.service'); // Encontra o elemento do serviço

    // Confirmação de exclusão
    if (confirm("Tem certeza que deseja excluir este serviço?")) {
        // Envia a requisição para excluir o serviço do banco de dados
        fetch('../deleteService.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: serviceId })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                alert("Serviço excluído com sucesso!");
                // Remove o serviço da página
                serviceElement.remove();
            } else {
                alert("Erro ao excluir serviço.");
            }
        })
        .catch(error => {
            console.error('Erro ao excluir serviço:', error);
        });
    }
}
