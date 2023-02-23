<?php
include('BaseDados.php');
include('Navbar.php');

if(isset($_SESSION['id'])) {

    header("Location: Website.php");
    exit();
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
    <?php echo createNavBar("LogIn") ?>
    
    <form action="" method="POST" id="meuForm">
        <label id="titulo">Username:</label>
        <p><input type="text" name="username" id="inputBox"></p>
        
        <label id="titulo">Senha:</label>
        <p><input type="password" name="senha" id="inputBox"></p>
        
        
        <?php
        if(isset($_POST['username']) || isset($_POST['senha'])) {
            if(strlen($_POST['username']) == 0 || strlen($_POST['senha']) == 0) {
                echo  "<p style='font-weight: 650;'>" .'<img src="alert.png"  width=50/>' . "Por favor preencha todos os campos" . "</p>";
            } 
            else {
                $username = $_POST['username'];
                $senha = $_POST['senha'];
                           
                $sql_code = "SELECT * FROM usuarios WHERE username = ? AND senha = ?";
                $stmt = $pdo->prepare($sql_code);
                $stmt->execute([$username, $senha]);
        
                $quantidade = $stmt->rowCount();
        
                if($quantidade == 1) {
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
                    if(!isset($_SESSION)) {
                        session_start();
                    }
        
                    $_SESSION['id'] = $usuario['id'];
                    $_SESSION['nome'] = $usuario['nome'];
        
                    header("Location: Website.php");
                    exit();
                } 
                else {
                    echo  "<p style='font-weight: 650;'>" .'<img src="alert.png"  width=50/>' . "Username ou password incorretos!" . "</p>";
                }
        
            }
        }
        ?>
        <button id="submit" type="submit">Entrar</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js " integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN " crossorigin="anonymous "></script>
    
</body>

</html>

