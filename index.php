<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
    header("HTTP:/1.1 200 OK");
    exit;
}
use Bramus\Router\Router;

require_once "./modelo/Router.php";
require_once "./modelo/Funcionario.php";
require_once "./modelo/PerfilFuncionario.php";
require_once "./modelo/Banco.php";


$router  = new Router();

//! FUNCIONARIOS

//? POST

$router->post('/funcionario', function(){
    $jsonRecebido = file_get_contents('php://input');
    $obj = json_decode($jsonRecebido);

    $funcionario = new Funcionario();
    $funcionario->setNome($obj->nome);
    $funcionario->setCargo($obj->cargo);
    $funcionario->setSalario($obj->salario);
    
    if ($funcionario->FuncionarioExiste() == false){

        $resposta['status'] = $funcionario->createFuncionario();
        $resposta['msg'] = 'cadastrado com sucesso';
        $resposta['dados'] = $funcionario;

    } else {
        $resposta['status'] = false;
        $resposta['msg'] = 'já existe um funcionario(a) igual a este(a)!';
        $resposta['dados'] = $funcionario;
    }

    echo json_encode($resposta);
});

//? GET

$router->get('/funcionario', function(){
    $funcionario = new Funcionario();
    $resposta['status'] = true;
    $resposta['dados'] = $funcionario->readAll();

    echo json_encode($resposta);
    exit;
});

$router->get('/funcionario/(\d+)', function ($id) {
    $funcionario = new Funcionario();
    $funcionario->setId($id);

    $resposta['status'] = true;
    $resposta['dados'] = $funcionario->read();
    echo json_encode($resposta);
});

//? PUT

$router->put('/funcionario/(\d+)', function($id){
    $funcionario = new Funcionario();
    
    $jsonRecebido = file_get_contents('php://input');
    $obj = json_decode($jsonRecebido);
    
    $funcionario->setId($id);
    $funcionario->setNome($obj->nome);
    $funcionario->setCargo($obj->cargo);
    $funcionario->setSalario($obj->salario);

    $resposta['status'] = $funcionario->update();
    $resposta['msg'] = "atualizado com sucesso";
    $resposta['dados'] = $funcionario;

    echo json_encode($resposta);
});

//? DELETE

$router->delete('/funcionario/(\d+)', function($id){
    $funcionario = new Funcionario();
    $funcionario->setId($id);

    if($funcionario->FuncionarioExiste() == true){
        $resposta['status'] = $funcionario->delete();
        $resposta['msg'] = "excluído com sucesso";
    } else {
        $resposta['status'] = false;
        $resposta['msg'] = "nenhum funcionario encontrado!";
    }

    echo json_encode($resposta);
});

//! PERFIL FUNCIONARIOS

//? POST

$router->post('/perfilFuncionario', function(){
    $jsonRecebido = file_get_contents('php://input');
    $obj = json_decode($jsonRecebido);

    $perfilFuncionario = new PerfilFuncionario();
    $perfilFuncionario->setFuncionario_id($obj->funcionario_id);
    $perfilFuncionario->setIdade($obj->idade);
    $perfilFuncionario->setEndereco($obj->endereco);
    $perfilFuncionario->setTelefone($obj->telefone);
    
    if ($perfilFuncionario->perfilFuncionarioExiste() == false){

        $resposta['status'] = $perfilFuncionario->createPerfilFuncionario();
        $resposta['msg'] = ($resposta['status'] == true) ? 'cadastrado com sucesso' : 'id do(a) funcionario(a) não encontrado';
        $resposta['dados'] = $perfilFuncionario;

        
    } else {
        $resposta['status'] = false;
        $resposta['msg'] = 'ja existe um(a) funcionario(a) com esse id!';
        $resposta['dados'] = $perfilFuncionario;
    }

    echo json_encode($resposta);
});

//? GET

$router->get('/perfilFuncionario', function(){
    $perfilFuncionario = new PerfilFuncionario();
    $resposta['status'] = true;
    $resposta['dados'] = $perfilFuncionario->readAll();

    echo json_encode($resposta);
    exit;
});

$router->get('/perfilFuncionario/(\d+)', function ($funcionario_id) {
    $perfilFuncionario = new PerfilFuncionario();
    $perfilFuncionario->setFuncionario_id($funcionario_id);

    $resposta['status'] = true;
    $resposta['dados'] = $perfilFuncionario->read();
    echo json_encode($resposta);
});

//? PUT

$router->put('/perfilFuncionario/(\d+)', function($funcionario_id){
    $perfilFuncionario = new PerfilFuncionario();
    
    $jsonRecebido = file_get_contents('php://input');
    $obj = json_decode($jsonRecebido);
    
    $perfilFuncionario->setFuncionario_id($funcionario_id);
    $perfilFuncionario->setIdade($obj->idade);
    $perfilFuncionario->setEndereco($obj->endereco);
    $perfilFuncionario->setTelefone($obj->telefone);

    $resposta['status'] = $perfilFuncionario->update();
    $resposta['msg'] = "atualizado com sucesso";
    $resposta['dados'] = $perfilFuncionario;

    echo json_encode($resposta);
});



//? DELETE

$router->delete('/perfilFuncionario/(\d+)', function($funcionario_id){
    $perfilFuncionario = new PerfilFuncionario();
    $perfilFuncionario->setFuncionario_id($funcionario_id);

    if($perfilFuncionario->perfilFuncionarioExiste() == true){
        $resposta['status'] = $perfilFuncionario->delete();
        $resposta['msg'] = "excluído com sucesso";
    } else {
        $resposta['status'] = false;
        $resposta['msg'] = "nenhum funcionario encontrado!";
    }

    echo json_encode($resposta);
});
$router->run();

?>