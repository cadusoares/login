<?php

//Iniciando a sessão
session_start();

//Conxão com o banco de dados

require_once 'configBD.php';

//Filtra a entrada

function verifica_entrada($entrada){

    $saida = htmlspecialchars($entrada);
    $saida = stripslashes($saida);
    $saida = trim($saida);
    return $saida; //Retorna a saída limpa

}

//Teste se existe a ação

if(isset($_POST['action'])){

    //Teste se ação é igual a cadastro

    if($_POST['action'] == 'cadastro'){

        //Teste se ação é igual a cadastro

        #echo"\n<p>cadastro</p>";
        #echo"\n<pre>";
        #print_r($_POST);
        #echo "\n</pre";
        $nomeCompleto = verifica_entrada($_POST['nomeCompleto']);
        $nomeDoUsuario = verifica_entrada($_POST['nomeDoUsuario']);
        $emailUsuario = verifica_entrada($_POST['emailUsuario']);
        $senhaDoUsuario = verifica_entrada($_POST['senhaDoUsuario']);
        $senhaUsuarioConfirmar = verifica_entrada($_POST['senhaUsuarioConfirmar']);

        //Data Atual no formato Banco de Dados
        $dataCriado = date("Y-m-d");

        //Codificando as senhas
        $senhaCodificada = sha1($senhaDoUsuario);
        $senhaConfirmarCod = sha1($senhaUsuarioConfirmar);

        // //Teste de captura de dados
        // echo "<p> Nome completo: $nomeCompleto</p>";
        // echo "<p> Nome de Usuario: $nomeDoUsuario</p>";
        // echo "<p> E-mail do Usuario: $emailUsuario</p>";
        // echo "<p> senhaCodificada: $senhaCodificada</p>";
        // echo "<p> Data de Criação: $dataCriado</p>";
        if($senhaCodificada != $senhaConfirmarCod){

            echo"<p class='text-danger'>Senhas não conferem.</p>";
            exit();

        }else{

            //As Senhas conferem, verificar se o usuario já existe
            //no banco de dados
            $sql = $connect->prepare("SELECT nomeDoUsuario, emailUsuario FROM 
            usuario WHERE nomeDoUsuario = ? OR emailUsuario = ?"); 
            $sql->bind_param("ss", $nomeDoUsuario, $emailUsuario);
            $sql->execute();
            $resultado = $sql->get_result();
            $linha = $resultado->fetch_array(MYSQLI_ASSOC);

            //Verificando a existencia do usuário no banco
            if($linha['nomeDoUsuario'] == $nomeDoUsuario){

                echo"<p class='text-danger'> Usuário indisponivel </p>";

            }elseif($linha['emailUsuario'] == $emailUsuario) {

                echo"<p class='text-danger'> E-mail indisponivel </p>";

            }else{

                //Usuário pode ser cadastrado no banco de dados
                $sql = $connect->prepare("INSERT into usuario (nomeDoUsuario,
                nomeCompleto,emailUsuario, senhaDoUsuario, dataCriado)
                values(?, ?, ?, ?, ?)");
                $sql->bind_param("sssss", $nomeDoUsuario, $nomeCompleto,
                $emailUsuario, $senhaCodificada, $dataCriado);
                if($sql->execute()){
                    echo"<p class='text-success'>Usuário cadastrado com Sucesso!!</p>";

                }else{
                    echo"<p class='text-danger'> Usuário não cadastrado </p>";
                    echo"<p class='text-danger'> Algo deu errado </p>";
                }

            }

        }

    }else if($_POST['action'] =='login'){

        $nomeUsuario = verifica_entrada($_POST['nomeUsuario']);
        $senhaUsuario = verifica_entrada($_POST['senhaUsuario']); 
        $senha = sha1($senhaUsuario);

    

        $sql = $connect->prepare("SELECT * FROM usuario WHERE 
        senhaDoUsuario = ?  AND nomeDoUsuario = ?");

        $sql->bind_param("ss", $senha, $nomeUsuario);

        $sql->execute();

        $busca = $sql->fetch();

        if($busca != null){
            $_SESSION['nomeDoUsuario'] = $nomeUsuario;

            if(!empty($_POST['lembrar'])){

                //Se lembrar não estiver vazio!
                //Ou seja, a pessoa quer ser lembrada!
                setcookie("nomeDoUsuario",$nomeUsuario,
                time()+(60*60*24*30));

                setcookie("senhaDoUsuario", $senhaUsuario,
                time()+(60*60*24*30));

            }else{

                //A pessoa não quer ser lembrada

                //Limpando o cookie

                setcookie("nomeDoUsuario", "");
                
                setcookie("senhaDoUsuario", "");

            }

            echo "ok";


        }else{
            echo"<p class='text-danger'>";
            echo"Falhou a entrada no sistema. 
            Nome de Usuário ou Senha inválidos</p>";
            exit();
        }

    }else if($_POST['action'] =='senha'){

        //Senão,teste se ação é recuperar senha
        echo "\n<p>senha</p>";
        echo "\n<pre>";
        print_r($_POST);
        echo "\n</pre";

    }else{
        
        header("location:index.php");

    }

    }else{

        //redirecionando para index.php, negando o acesso
        //a esse arquivo diretamente 
        header("location:index.php");

    }

