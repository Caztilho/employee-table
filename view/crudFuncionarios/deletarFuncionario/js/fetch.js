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
    
        // Fazer uma requisição DELETE para a API
        fetch(endpoint,  {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Access-Control-Allow-Origin': '*',
            },
        } )
        .then(response => response.json())
        .then(data => {
            console.log('Sucesso:', data)
            if (data.status === false){
                p.innerHTML = "Funcionario não encontrado!"
            } else{

                p.innerHTML = "Deletado com sucesso!"
            }
        })
        .catch((error) => {
            console.error('Erro:', error)
            p.innerHTML = "Não foi possível deletar o funcionario"
        })
    })
    })
    
