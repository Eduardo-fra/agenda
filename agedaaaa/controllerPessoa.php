<?php
  include("modelPessoa.php");
  include("pessoa.php");

  $cpf = filter_input(INPUT_GET, "cpf");
  $nome = filter_input(INPUT_GET, "nome");
  $contato = filter_input(INPUT_GET, "contato");
  $senha = filter_input(INPUT_GET, "senha");
  $acao = filter_input(INPUT_GET, "acao");  

  $pessoa = new Pessoa();
  $pessoa->setCpf($cpf);
  $pessoa->setNome($nome);
  $pessoa->setContato($contato);
  $pessoa->setSenha($senha);

  $modelPessoa = new modelPessoa();
  
  if($acao=="inserir"){
      $modelPessoa->inserir($pessoa);
  }else if($acao=="apagar"){
      $modelPessoa->apagar($pessoa);
  }else if($acao=="atualizar"){
    $modelPessoa->atualizar($pessoa);
  }else if($acao=="consultar"){
    echo $modelPessoa->consultar();
  }else if($acao == "consultarPessoa") {
    echo $modelPessoa->consultarPorCpf($pessoa); 
  }else if($acao == "validaPessoa") {
    echo $modelPessoa->consultarSenha($pessoa); 
  }
?>