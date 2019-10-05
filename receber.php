<?php

#Back-end

#if verifica se o método GET está enviando dados
if(isset($_GET['nomeUsuario'])){

    echo "\n<h1>Envio de dados feito pelo método <em>GET</em></h1>";

    echo "\n<pre>\n";
    print_r($_GET); #Array
    echo "\n</pre>\n";

    print("<br><strong>Nome:</strong>");
    print("$_GET[nomeUsuario]");

    print("<br><strong>E-mail:</strong>");
    print("$_GET[email]");

    print("<br><strong>Senha:</strong>");
    print("$_GET[senhaUsuario]");

    print("<br><strong>Data de Nascimento:</strong>");
    print("$_GET[dataNascimento]");
}
// Verifica se o metodo POST está enviando dados

if(isset($_POST['nome'])){

    echo "\n<h1>Envio de dados feito pelo método <em>POST</em></h1>";

    echo "\n<pre>\n";
    print_r($_POST); #Array
    echo "\n</pre>\n";

    print("<br><strong>Nome:</strong>");
    print("$_POST[nome]");

    print("<br><strong>E-mail:</strong>");
    print("$_POST[email]");

    print("<br><strong>Senha:</strong>");
    print("$_POST[senha]");

    print("<br><strong>Data de Nascimento:</strong>");
    print("$_POST[dataDeNascimento]");
}