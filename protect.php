<?php
if(!isset($_SESSION)) 
{
    session_start();
}
if(!isset($_SESSION['id'])) 
{
    die("Acesso negado, por favor faça login/signup.<p><a id= voltar href=\"LogIn.php\">Voltar</a></p>");
}
?>