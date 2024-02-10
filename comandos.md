# Funcionario


- ### POST
    - http://localhost/funcionario
        - `{
            "nome": "castilho,
            "cargo": "programador",
            "salario": "40000"
          }`

        - `{
            "nome": "malu,
            "cargo": "analista",
            "salario": "30000"
          }`

        - `{
            "nome": "pedro,
            "cargo": "divulgação",
            "salario": "20000"
          }`

        - `{
            "nome": "felipe,
            "cargo": "chefe",
            "salario": "10000"
          }`


- ### GET
    - http://localhost/funcionario (retorna todos)
    - http://localhost/funcionario/1 (retorna o com ID específico)
    
- ### PUT
    - http://localhost/funcionario/1 (ID específico)
    
        - `{
            "nome": "castilho,
            "cargo": "programador",
            "salario": "40000"
          }`

- ### DELETE
    - http://localhost/funcionario/4 (ID específico)


# Perfil Funcionario


- ### POST
    - http://localhost/perfilFuncionario
        - `{
            "funcionario_id": "1,
            "idade": "17",
            "endereco": "SJC"
            "telefone": "(12) 98182-7850"
          }`

        - `{
            "funcionario_id": "2,
            "idade": "18",
            "endereco": "SJC"
            "telefone": "(12) 98182-7850"
          }`

        - `{
            "funcionario_id": "3,
            "idade": "19",
            "endereco": "SJC"
            "telefone": "(12) 98182-7850"
          }`

        - `{
            "funcionario_id": "4,
            "idade": "20",
            "endereco": "SJC"
            "telefone": "(12) 98182-7850"
          }`


- ### GET
    - http://localhost/perfilFuncionario (retorna todos)
    - http://localhost/perfilFuncionario/1 (retorna o com ID específico)
    
- ### PUT
    - http://localhost/perfilFuncionario/1 (ID específico)
    
        - `{
            "funcionario_id": "1,
            "idade": "21",
            "endereco": "SJC"
            "telefone": "(12) 98182-7850"
          }`

- ### DELETE
    - http://localhost/funcionario/4 (ID específico)