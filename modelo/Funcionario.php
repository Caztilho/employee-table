<?php
require_once "Banco.php";

class Funcionario implements JsonSerializable
{

    private $id;
    private $nome;
    private $cargo;
    private $salario;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
        return $this;
    }

    public function getCargo()
    {
        return $this->cargo;
    }

    public function setSalario($salario)
    {
        $this->salario = $salario;
        return $this;
    }

    public function getSalario()
    {
        return $this->salario;
    }


    public function jsonSerialize()
    {
        $json = array();
        $json['id'] = $this->getId();
        $json['nome'] = $this->getNome();
        $json['cargo'] = $this->getCargo();
        $json['salario'] = $this->getSalario();

        return $json;
    }

    public function createFuncionario()
    {
        $this->banco = new Banco();

        $stmt = $this->banco->getConexao()->prepare("insert into funcionarios(nome, cargo, salario) values (?,?,?)");
        $stmt->bind_param("ssi", $this->nome, $this->cargo, $this->salario);
        $resposta = $stmt->execute();

        return $resposta;
    }

    public function FuncionarioExiste()
    {
        $this->banco = new Banco();
        $sql = "select count(*) as qtd from funcionarios where id = ?";
        $stmt = $this->banco->getConexao()->prepare($sql);

        $stmt->bind_param("i", $this->id);
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

        $stmt = $this->banco->getConexao()->prepare("select * from funcionarios where id=?");

        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $funcionario = array();
        while ($linha = $resultado->fetch_object()) {
            $funcionario[0] = new Funcionario();
            $funcionario[0]->setId($linha->id);
            $funcionario[0]->setNome($linha->nome);
            $funcionario[0]->setCargo($linha->cargo);
            $funcionario[0]->setSalario($linha->salario);
        }

        return $funcionario;
    }


    public function readAll()
    {
        $this->banco = new Banco();

        $stmt = $this->banco->getConexao()->prepare("select * from funcionarios");
        $stmt->execute();
        $resultado = $stmt->get_result();
        $i = 0;

        $funcionario = array();
        while ($linha = $resultado->fetch_object()) {
            $funcionario[$i] = new Funcionario();
            $funcionario[$i]->setId($linha->id);
            $funcionario[$i]->setNome($linha->nome);
            $funcionario[$i]->setCargo($linha->cargo);
            $funcionario[$i]->setSalario($linha->salario);

            $i++;
        }

        return $funcionario;
    }

    public function update()
    {
        $this->banco = new Banco();

        $stmt = $this->banco->getConexao()->prepare("update funcionarios set nome = ?, cargo = ?, salario = ? where id = ?");

        $stmt->bind_param("ssii", $this->nome, $this->cargo, $this->salario, $this->id);

        return $stmt->execute();
    }

    public function delete()
    {
        $this->banco = new Banco();

        $stmt = $this->banco->getConexao()->prepare("delete from funcionarios where id = ?");

        $stmt->bind_param("i", $this->id);

        return $stmt->execute();
    }
}

?>