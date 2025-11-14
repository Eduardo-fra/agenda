<?php
include "conexao.php";    

class ModelPessoa {
    
    public function inserir(Pessoa $pessoa) {
        // Validação simples para evitar campo nulo
        if (empty($pessoa->getSenha())) {
            throw new Exception("Erro: A senha não pode ser nula ou vazia.");
        }

        $sql = "INSERT INTO pessoa(cpf, nome, contato, senha) VALUES(?, ?, ?, ?)";
        $con = new Conexao();
        $bd = $con->pegarConexao();

        $stm = $bd->prepare($sql);
        $stm->bindValue(1, $pessoa->getCpf());
        $stm->bindValue(2, $pessoa->getNome());
        $stm->bindValue(3, $pessoa->getContato());
        $stm->bindValue(4, $pessoa->getSenha()); // Verifique se está vindo valor aqui

        try {
            $resultado = $stm->execute();
            echo $resultado ? "Cadastrado com sucesso." : "Erro ao cadastrar.";
        } catch (PDOException $e) {
            echo "Erro ao inserir pessoa: " . $e->getMessage();
        }
    }

    public function apagar(Pessoa $pessoa) {
        $sql = "DELETE FROM pessoa WHERE cpf = ?";
        $con = new Conexao();
        $bd = $con->pegarConexao();

        $stm = $bd->prepare($sql);
        $stm->bindValue(1, $pessoa->getCpf());

        try {
            $resultado = $stm->execute();
            echo $resultado ? "Apagado com sucesso." : "Erro ao apagar.";
        } catch (PDOException $e) {
            echo "Erro ao apagar pessoa: " . $e->getMessage();
        }
    }

    public function atualizar(Pessoa $pessoa) {
        $sql = "UPDATE pessoa SET nome = ?, contato = ?, senha = ? WHERE cpf = ?";
        $con = new Conexao();
        $bd = $con->pegarConexao();

        $stm = $bd->prepare($sql);
        $stm->bindValue(1, $pessoa->getNome());
        $stm->bindValue(2, $pessoa->getContato());
        $stm->bindValue(3, $pessoa->getSenha());
        $stm->bindValue(4, $pessoa->getCpf());

        try {
            $resultado = $stm->execute();
            echo $resultado ? "Atualizado com sucesso." : "Erro ao atualizar.";
        } catch (PDOException $e) {
            echo "Erro ao atualizar pessoa: " . $e->getMessage();
        }
    }

    public function consultar() {
        $sql = "SELECT * FROM pessoa";
        $con = new Conexao();
        $bd = $con->pegarConexao();

        $stm = $bd->prepare($sql);
        $stm->execute();
        
        if ($stm->rowCount() > 0) {
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($resultado);
        }
    }

    public function consultarPorCpf(Pessoa $pessoa) {
        $sql = "SELECT * FROM pessoa WHERE cpf = ?";
        $con = new Conexao();
        $bd = $con->pegarConexao();

        $stm = $bd->prepare($sql);
        $stm->bindValue(1, $pessoa->getCpf());
        $stm->execute();

        if ($stm->rowCount() > 0) {
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($resultado);
        }
    }

    public function consultarSenha(Pessoa $pessoa) {
        // Corrigido o operador lógico de '&&' para 'AND'
        $sql = "SELECT * FROM pessoa WHERE cpf = ? AND senha = ?";
        $con = new Conexao();
        $bd = $con->pegarConexao();

        $stm = $bd->prepare($sql);
        $stm->bindValue(1, $pessoa->getCpf());
        $stm->bindValue(2, $pessoa->getSenha());
        $stm->execute();

        if ($stm->rowCount() > 0) {
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($resultado);
        }
    }

}
?>
