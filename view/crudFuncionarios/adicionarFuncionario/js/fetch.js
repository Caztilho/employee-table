document.addEventListener("DOMContentLoaded", function () {
document.getElementById('botao').addEventListener('click', function(event) {
    event.preventDefault() // Para prevenir o recarregamento da página

    const endpoint = 'http://localhost/funcionario'

    const p = document.getElementById("status")
    const form = document.querySelector('form')

        // Verificar a validade do formulário
        if (!form.checkValidity()) {
            // Se o formulário não for válido, exibir mensagem de erro
            p.innerHTML = "Por favor, preencha todos os campos."
            return
        }
    // Pegar os valores dos campos do formulário
    let nome = document.getElementById('nome').value
    let cargo = document.getElementById('cargo').value
    let salario = document.getElementById('salario').value

    // Criar um objeto com os dados do funcionário
    let funcionario = {
        nome: nome,
        cargo: cargo,
        salario: salario
    }

    // Fazer uma requisição POST para a API
    fetch(endpoint,  {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Access-Control-Allow-Origin': '*',
        },
        body: JSON.stringify(funcionario),
    } )
    .then(response => response.json())
    .then(data => {
        console.log('Sucesso:', data)
        p.innerHTML = "Inserido com sucesso!"
    })
    .catch((error) => {
        console.error('Erro:', error)
        p.innerHTML = "Não foi possível inserir o funcionario"
    })
})
})
