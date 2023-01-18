<?php
    
    include('Navbar.php');
    include('BaseDados.php');

    if(isset($_POST['nome']) || isset($_POST['data_']) || isset($_POST['email']) || isset($_POST['username']) || isset($_POST['senha'])) 
    {
    
        if(strlen($_POST['nome']) == 0) {
            echo "Preencha o seu nome";
            }
                else if(strlen($_POST['data_']) == 0) 
                {
                    echo "Preencha a sua data de nascimento";
                } 
            
                else if(strlen($_POST['email']) == 0) 
                {
                    echo "Preencha o seu email";
                } 
            
               else if(strlen($_POST['username']) == 0) 
               {
                    echo "Preencha o seu username";
               } 
                else if(strlen($_POST['senha']) == 0) 
                {
                    echo "Preencha a sua senha";
                }
                
                else 
                {
                    $nome = $mysqli->real_escape_string($_POST['nome']);
                    $data_ = $mysqli->real_escape_string($_POST['data_']);
                    $email = $mysqli->real_escape_string($_POST['email']);
                    $username = $mysqli->real_escape_string($_POST['username']);
                    $senha = $mysqli->real_escape_string($_POST['senha']);
                                
                    $sql_code = "INSERT INTO usuarios (nome, data_, email, username, senha) VALUES ('$nome', '$data_' , '$email', '$username', '$senha')";
                    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
            
                    $quantidade = $sql_query->num_rows;
            
                    if($quantidade == 1) {
                        
                        $usuario = $sql_query->fetch_assoc();
            
                        if(!isset($_SESSION)) {
                            session_start();
                        }
            
                        $_SESSION['id'] = $usuario['id'];
                        $_SESSION['nome'] = $usuario['nome'];
            
                        header("Location: Website.php");
            
                    } 
                    else 
                    {
                        echo "Falha ao logar! username ou senha incorretos";
                    }
                }
    }
?>
<!DOCTYPE html>

<html lang="en" style="height:100%">
<link rel="stylesheet" href="style.css">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My entertainment tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <?php echo createNavBar("SignUp") ?>
    <p></p>
    <form action="" method="POST" style="margin-left: 20px">
        <p>
            <label id="titulo">Nome</label>
            <input type="text" name="nome">
        </p>
        <p>
            <label id="titulo">Data de nascimento:</label>
            <input type="date" name="data_">
        </p>
        <p>
            <label id="titulo">E-mail:</label>
            <input type="text" name="email">
        </p>
        <p>
            <label id="titulo">Username:</label>
            <input type="text" name="username">
        </p>
        <p>
            <label id="titulo">Senha:</label>
            <input type="password" name="senha">
        </p>
        <p>
            <button id="submit" type="submit">Entrar</button>
        </p>
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js " integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN " crossorigin="anonymous "></script>
    
</body>

</html>