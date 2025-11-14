<?php
  include("modelAgenda.php");
  include("agenda.php");

  $cpf = filter_input(INPUT_GET, "cpf");
  $data = filter_input(INPUT_GET, "data");
  $descricao = filter_input(INPUT_GET, "descricao");
  $acao = filter_input(INPUT_GET, "acao");  

  $agenda = new Agenda();
  $agenda->setCpf($cpf);
  $agenda->setData($data);
  $agenda->setDescricao($descricao);

  $modelAgenda = new modelAgenda();
  
  if($acao=="inserir"){
      $modelAgenda->inserir($agenda);
  }else if($acao=="apagar"){
      $modelAgenda->apagar($agenda);
  }else if($acao=="atualizar"){
    $modelAgenda->atualizar($agenda);
  }else if($acao=="consultar"){
    echo $modelAgenda->consultar();
  }

<?php
header("Content-Type: application/json");

include "modelAgenda.php";
include "agenda.php";

$acao = $_GET['acao'] ?? '';

$model = new ModelAgenda();

switch ($acao) {
    case 'inserir':
        $dados = json_decode(file_get_contents("php://input"), true);
        if (!$dados || !isset($dados['cpf'], $dados['data'], $dados['descricao'])) {
            echo json_encode(["success" => false, "message" => "Dados incompletos"]);
            exit;
        }

        $agenda = new Agenda();
        $agenda->setCpf($dados['cpf']);
        $agenda->setData($dados['data']);
        $agenda->setDescricao($dados['descricao']);

        try {
            $model->inserir($agenda);
            echo json_encode(["success" => true, "message" => "Compromisso inserido com sucesso"]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
        break;

    case 'consultar':
        echo $model->consultar();
        break;

    case 'excluir':
        $dados = json_decode(file_get_contents("php://input"), true);
        if (!isset($dados['cpf'], $dados['data'])) {
            echo json_encode(["success" => false, "message" => "CPF ou Data ausente."]);
            exit;
        }

        $agenda = new Agenda();
        $agenda->setCpf($dados['cpf']);
        $agenda->setData($dados['data']);

        try {
            $model->apagar($agenda);
            echo json_encode(["success" => true, "message" => "Compromisso excluído."]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(["success" => false, "message" => "Ação inválida"]);
        break;
}

?>