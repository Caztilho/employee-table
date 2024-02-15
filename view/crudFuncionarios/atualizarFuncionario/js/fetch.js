document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('botao').addEventListener('click', function(event) {
        event.preventDefault() // Para prevenir o recarregamento da página
        
        const idFuncionario = document.getElementById("idFuncionario").value
        const endpoint = `http://localhost/funcionario/${idFuncionario}`
        
        console.log(endpoint)
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
    
        // Fazer uma requisição PUT para a API
        fetch(endpoint,  {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*',
            },
            body: JSON.stringify(funcionario),
        } )
        .then(response => response.json())
        .then(data => {
            console.log('Sucesso:', data)
            p.innerHTML = "Atualizado com sucesso!"
        })
        .catch((error) => {
            console.error('Erro:', error)
            p.innerHTML = "Não foi possível atualizar o funcionario"
        })
    })
    })
    
