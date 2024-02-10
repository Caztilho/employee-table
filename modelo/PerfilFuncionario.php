<?php

require_once "Banco.php";

class PerfilFuncionario implements JsonSerializable
{

    private $id;
    private $funcionario_id;
    private $idade;
    private $endereco;
    private $telefone;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getTelefone()
    {
        return $this->telefone;
    }

    
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    
    public function getEndereco()
    {
        return $this->endereco;
    }

    
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    
    public function getIdade()
    {
        return $this->idade;
    }

    
    public function setIdade($idade)
    {
        $this->idade = $idade;

        return $this;
    }

    
    public function getFuncionario_id()
    {
        return $this->funcionario_id;
    }

   
    public function setFuncionario_id($funcionario_id)
    {
        $this->funcionario_id = $funcionario_id;

        return $this;
    }

    public function jsonSerialize()
    {
        $json = array();
        $json['funcionario_id'] = $this->getFuncionario_id();
        $json['idade'] = $this->getIdade();
        $json['endereco'] = $this->getEndereco();
        $json['telefone'] = $this->getTelefone();

        return $json;
    }

    public function createPerfilFuncionario()
    {
        
        $this->banco = new Banco();

        // Verificar se o funcionário com o ID especificado existe
        $sql = "select count(*) as qtd from funcionarios where id = ?";
        $stmt = $this->banco->getConexao()->prepare($sql);
        $stmt->bind_param("i", $this->funcionario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        
        while ($linha = $resultado->fetch_object()) {
            if ($linha->qtd == 0) {
                // Se o funcionário não existe, retorne false
                return false;
            }
        }
    
        $stmt = $this->banco->getConexao()->prepare("insert into perfil_funcionario(funcionario_id, idade, endereco, telefone) values (?,?,?,?)");
        $stmt->bind_param("iiss", $this->funcionario_id, $this->idade, $this->endereco, $this->telefone);
        
        $resposta = $stmt->execute();
    
        return $resposta;
    }

    public function perfilFuncionarioExiste()
    {
        $this->banco = new Banco();
        $sql = "select count(*) as qtd from perfil_funcionario where funcionario_id = ?";
        $stmt = $this->banco->getConexao()->prepare($sql);

        $stmt->bind_param("i", $this->funcionario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        while ($linha = $resultado->fetch_object()) {
            if ($linha->qtd == 1) {
                return true;
            }
        }

        return false;
    }

    public function read()
    {
        $this->banco = new Banco();

        $stmt = $this->banco->getConexao()->prepare("select * from perfil_funcionario where funcionario_id=?");

        $stmt->bind_param("i", $this->funcionario_id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $perfilFuncionario = array();
        while ($linha = $resultado->fetch_object()) {
            $perfilFuncionario[0] = new PerfilFuncionario();
            $perfilFuncionario[0]->setId($linha->id);
            $perfilFuncionario[0]->setFuncionario_id($linha->funcionario_id);
            $perfilFuncionario[0]->setIdade($linha->idade);
            $perfilFuncionario[0]->setEndereco($linha->endereco);
            $perfilFuncionario[0]->setTelefone($linha->telefone);
        }

        return $perfilFuncionario;
    }


    public function readAll()
    {
        $this->banco = new Banco();

        $stmt = $this->banco->getConexao()->prepare("select * from perfil_funcionario");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $i = 0;

        $perfilFuncionario = array();
        while ($linha = $resultado->fetch_object()) {
            $perfilFuncionario[$i] = new PerfilFuncionario();
            $perfilFuncionario[$i]->setFuncionario_id($linha->funcionario_id);
            $perfilFuncionario[$i]->setIdade($linha->idade);
            $perfilFuncionario[$i]->setEndereco($linha->endereco);
            $perfilFuncionario[$i]->setTelefone($linha->telefone);

            $i++;
        }

        return $perfilFuncionario;
    }

    public function update()
    {
        $this->banco = new Banco();

        $stmt = $this->banco->getConexao()->prepare("update perfil_funcionario set idade = ?, endereco = ?, telefone = ? where funcionario_id = ?");

        $stmt->bind_param("issi", $this->idade, $this->endereco, $this->telefone, $this->funcionario_id);

        return $stmt->execute();
    }

    public function delete()
    {
        $this->banco = new Banco();

        $stmt = $this->banco->getConexao()->prepare("delete from perfil_funcionario where funcionario_id = ?");

        $stmt->bind_param("i", $this->funcionario_id);

        return $stmt->execute();
    }

   
}
?>