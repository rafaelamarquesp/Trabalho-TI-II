<?php
    
    include('Navbar.php');
    include('BaseDados.php');
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
<p></p>
<body>
    <?php echo createNavBar("SignUp")?>
    
    <form action="" method="POST" id="meuForm">
        <label id="titulo">Nome:</label>
        <p><input type="text" name="nome" id="inputBox"></p>
        
        <label id="titulo">Data de nascimento:</label>
        <p><input type="date" name="data_" id="inputBox"></p>
        
        <label id="titulo">E-mail:</label>
        <p><input type="text" name="email" id="inputBox"></p>
        
        <label id="titulo">Username:</label>
        <p><input type="text" name="username" id="inputBox"></p>
        
        <label id="titulo">Password:</label>
        <p><input type="password" name="senha" id="inputBox"></p>
        
        <label id="titulo">Confimar Password:</label>
        <p><input type="password" name="senhaconf" id="inputBox"></p>

        <?php
    if(isset($_POST['nome']) || isset($_POST['data_']) || isset($_POST['email']) || isset($_POST['username']) || isset($_POST['senha']))
    {
        if(strlen($_POST['nome']) == 0 || strlen($_POST['data_']) == 0 || strlen($_POST['email']) == 0 || strlen($_POST['username']) == 0 || strlen($_POST['senha']) == 0 || strlen($_POST['senhaconf']) == 0) {
            echo "<p style='font-weight: 650;'>" .'<img src="alert.png"  width=50/>' . "Por favor preencha todos os campos" . "</p>";
        } 
        else 
        {
                $nome = $_POST['nome'];
                $data_ = $_POST['data_'];
                $email = $_POST['email'];
                $username = $_POST['username'];
                $senha = $_POST['senha'];
                $senhaconf = $_POST['senhaconf'];
    
                if(strcmp($senha, $senhaconf) != 0)
                {
                    echo "<p style='font-weight: 650;'>" .'<img src="alert.png"  width=50/>' .  "Inseriu passwords diferentes" . "</p>";
                } 
                else 
                {
                    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ? OR email = ?");
                    $stmt->execute([$username, $email]);
                    $quantidade = $stmt->rowCount();
    
                    if($quantidade == 1) 
                    {
                        echo "<p style='font-weight: 650;'>" .'<img src="alert.png"  width=50/>' . "Já existe uma conta com username ou email inseridos" . "</p>";
                    } 
                    else 
                    {              
                        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, data_, email, username, senha) VALUES (?, ?, ?, ?, ?)");
                        $stmt->execute([$nome, $data_, $email, $username, $senha]);
    
                        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ? AND senha = ?");
                        $stmt->execute([$username, $senha]);
    
                        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
                        if(!isset($_SESSION)) {
                            session_start();
                        }
                        $_SESSION['id'] = $usuario['id'];
                        $_SESSION['nome'] = $usuario['nome'];
    
                        header("Location: Website.php");
                    }
                }                  
        }
    }
    ?>
        
        <button id="submit" type="submit">Submeter</button>
        
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js " integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN " crossorigin="anonymous "></script>
    
</body>

</html>