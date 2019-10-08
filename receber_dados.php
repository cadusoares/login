<?php
//Teste se existe a ação

if(isset($_POST['action'])){

    //Teste se ação é igual a cadastro

    if($_POST['action'] == 'cadastro'){

        //Teste se ação é igual a cadastro
        echo"\n<p>cadastro</p>";
        echo"\n<pre>";
        print_r($_POST);
        echo "\n</pre";

    }else if($_POST['action'] =='login'){

        //Senão, teste se ação é login
        echo "\n<p>login</p>";
        echo "\n<pre>";
        print_r($_POST);
        echo "\n</pre";

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

