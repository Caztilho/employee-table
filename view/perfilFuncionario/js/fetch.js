document.addEventListener("DOMContentLoaded", function () {
    const name = document.querySelector(".name")
    const age = document.getElementById("age")
    const address = document.getElementById("address")
    const phone = document.getElementById("phone")
    
    
    let params = new URLSearchParams(window.location.search)
    let nome = params.get('nome')
    let id = params.get('id')

    console.log(id)
    const endpoint = `https://localhost/perfilFuncionario/${id}`
    fetch(endpoint)
        .then(response => {
            return response.json()
        })
        .then(data => {
            console.log(data.dados)
            name.innerHTML = `${nome}`
            age.innerHTML = `Idade: ${data.dados[0].idade}`
            address.innerHTML = `Endereco: ${data.dados[0].endereco}`
            phone.innerHTML = `Telefone: ${data.dados[0].telefone}`
            
        })
        .catch(error => {
            console.error('Erro ao buscar os dados:', error)
        })
})
