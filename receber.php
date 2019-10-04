<?php

#Back-end

echo "\n<pre>\n";
print_r($_GET); #Array
echo "\n</pre>\n";

print("<br><strong>Nome:</strong>");
print("$_GET[nomeUsuario]");

print("<br><strong>E-mail:</strong>");
print("$_GET[e-  mail]");

print("<br><strong>Senha:</strong>");
print("$_GET[senhaUsuario]");

print("<br><strong>Data de Nascimento:</strong>");
print("$_GET[dataNascimento]");
