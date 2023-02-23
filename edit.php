<?php
    include('Navbar.php');
    include('BaseDados.php');
    include('protect.php');
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

<body style="height:auto">
    <?php echo createNavBar("Perfil");
    
    $id = $_SESSION['id'];
            
    $q = $pdo->prepare("SELECT * FROM usuarios WHERE id=:id");
    $q->execute(array(':id' => $id));
    $res = $q->fetch(PDO::FETCH_ASSOC);
     
    ?>
    <form action="" method="POST" id="meuForm">

        <label id="titulo">Nome:</label>
        <p><input type="text" name="nome" id="inputBox" value="<?php if (isset($res)) {echo $res['nome'];} ?>"></p>

        <label id="titulo">Data de nascimento:</label>
        <p><input type="date" name="data_" id="inputBox"  value="<?php if (isset($res)) {echo $res['data_'];} ?>"></p>

        <label id="titulo">E-mail:</label>
        <p><input type="text" name="email" id="inputBox"  value="<?php if (isset($res)) {echo $res['email'];} ?>"></p>

        <label id="titulo">Username:</label>
        <p><input type="text" name="username" id="inputBox"  value="<?php if (isset($res)) {echo $res['username'];} ?>"></p>
        
        <?php 
            if(isset($_POST['nome']) || isset($_POST['data_']) || isset($_POST['email']) || isset($_POST['username']))
            {
                if(strlen($_POST['nome']) == 0) {
                    echo   "<p style='font-weight: 650;'>" .'<img src="alert.png"  width=50/>' . "Por favor preencha todos os campos" . "</p>";       
                }
                else if(strlen($_POST['data_']) == 0) 
                {
                    echo "<p style='font-weight: 650;'>" .'<img src="alert.png"  width=50/>' . "Por favor preencha todos os campos". "</p>";
                } 
                else if(strlen($_POST['email']) == 0) 
                {
                    echo "<p style='font-weight: 650;'>" .'<img src="alert.png"  width=50/>' . "Por favor preencha todos os campos" . "</p>";
                }
                else if(strlen($_POST['username']) == 0) 
                {
                    echo "<p style='font-weight: 650;'>" .'<img src="alert.png"  width=50/>' . "Por favor preencha todos os campos" . "</p>";
                } 
                else 
                {
                    $nome = $_POST['nome'];
                    $data_ =$_POST['data_'];
                    $email = $_POST['email'];
                    $username = $_POST['username'];
                    
                    $sql_code = "SELECT * FROM usuarios WHERE (username = ? OR email = ?) AND NOT id = ?";
                    $stmt = $pdo->prepare($sql_code);
                    $stmt->execute([$username, $email, $id]);

                    
                    $quantidade = $stmt->rowCount();
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($quantidade == 1) {
                        echo "<p style='font-weight: 650;'><img src='alert.png' width=50/>Já existe uma conta com username ou email inseridos</p>";
                    } else {
                        $_SESSION["nome"] = $nome;
                        $sql_code = "UPDATE usuarios SET nome = ?, data_ = ?, email = ?, username = ? WHERE id = ?";
                        $stmt = $pdo->prepare($sql_code);
                        $stmt->execute([$nome, $data_, $email, $username, $id]);
                    
                        header("Location: Perfil.php");
                    }
                }
            }
        ?>
        <input type= "button" id="voltar" type="none" onclick="window.location.href='./Perfil.php'" value="Voltar"/>
        <input type= "button" id="atualizar" type="none1" onclick="window.location.href='./EditPassword.php'" value="Atualizar Password"/>
        <button id="submit" type="submit">Submeter</button>      
    </form>
    
    
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js " integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN " crossorigin="anonymous ">
    </script>

</body>

</html>