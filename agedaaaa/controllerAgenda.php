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
?>