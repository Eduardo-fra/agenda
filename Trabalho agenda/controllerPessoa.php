<?php
include("modelPessoa.php");
include("pessoa.php");

// Captura os dados com segurança usando filter_input
$cpf    = filter_input(INPUT_GET, "cpf", FILTER_SANITIZE_STRING);
$nome   = filter_input(INPUT_GET, "nome", FILTER_SANITIZE_STRING);
$contato = filter_input(INPUT_GET, "contato", FILTER_SANITIZE_STRING);
$senha  = filter_input(INPUT_GET, "senha", FILTER_SANITIZE_STRING);
$acao   = filter_input(INPUT_GET, "acao", FILTER_SANITIZE_STRING);

// Verifica se a ação foi informada
if (!$acao) {
    echo "Erro: Nenhuma ação foi especificada.";
    exit;
}

// Instancia o objeto Pessoa e seta os valores (se existirem)
$pessoa = new Pessoa();
if ($cpf) $pessoa->setCpf($cpf);
if ($nome) $pessoa->setNome($nome);
if ($contato) $pessoa->setContato($contato);
if ($senha) $pessoa->setSenha($senha);

// Instancia o model
$modelPessoa = new ModelPessoa();

// Executa a ação correspondente
switch ($acao) {
    case "inserir":
        try {
            $modelPessoa->inserir($pessoa);
        } catch (Exception $e) {
            echo "Erro ao inserir: " . $e->getMessage();
        }
        break;

    case "apagar":
        $modelPessoa->apagar($pessoa);
        break;

    case "atualizar":
        $modelPessoa->atualizar($pessoa);
        break;

    case "consultar":
        echo $modelPessoa->consultar();
        break;

    case "consultarPessoa":
        echo $modelPessoa->consultarPorCpf($pessoa);
        break;

    case "validaPessoa":
        echo $modelPessoa->consultarSenha($pessoa);
        break;

    default:
        echo "Erro: Ação inválida.";
        break;
}
?>
