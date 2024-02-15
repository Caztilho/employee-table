document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('botao').addEventListener('click', function(event) {
        event.preventDefault() // Para prevenir o recarregamento da página
        
        const funcionario_id = document.getElementById("funcionario_id").value
        const endpoint = `http://localhost/perfilFuncionario/${funcionario_id}`
        
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
        let idade = document.getElementById('idade').value
        let endereco = document.getElementById('endereco').value
        let telefone = document.getElementById('telefone').value
    
        // Criar um objeto com os dados do funcionário
        let funcionario = {
            idade: idade,
            endereco: endereco,
            telefone: telefone
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
    
