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
    
        $id=$_SESSION['id'];
            
        $q=$mysqli->query("SELECT * FROM usuarios WHERE id='$id'");
        $res=mysqli_fetch_assoc($q);
     
    ?>
    <form action="" method="POST" id="meuForm">

        <label id="titulo">Password:</label>
        <p><input type="password" name="senha" id="inputBox"></p>
        
        <label id="titulo">Confimar Password:</label>
        <p><input type="password" name="senhaconf" id="inputBox"></p>
        
        <?php 
            if(isset($_POST['senha']))
            {
                if(strlen($_POST['senha']) == 0) 
            {
                echo "<p style='font-weight: 650;'>" .'<img src="alert.png"  width=50/>' . "Por favor preencha todos os campos" . "</p>";
            }
            else if(strlen($_POST['senhaconf']) == 0) 
            {
                echo "<p style='font-weight: 650;'>" .'<img src="alert.png"  width=50/>' . "Por favor preencha todos os campos" . "</p>";
            }
                else 
                {
                    $senha = $mysqli->real_escape_string($_POST['senha']);
                    $senhaconf = $mysqli->real_escape_string($_POST['senhaconf']);
                    
                    strcmp( $senha,  $senhaconf);

                    if(strcmp( $senha,  $senhaconf) != 0)
                    {
                    echo "<p style='font-weight: 650;'>" .'<img src="alert.png"  width=50/>' .  "Inseriu passwords diferentes" . "</p>";
                    }else{
                        
                        $sql_code = "SELECT * FROM usuarios WHERE (senha = '$senha') ";
                        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
                        
                        $quantidade = $sql_query->num_rows;
                        $usuario = $sql_query->fetch_assoc();
                        
                        if($quantidade == 1 ) {
                            echo "<p style='font-weight: 650;'>" .'<img src="alert.png"  width=50/>' . "A nova password não pode ser igual à anterior" . "</p>";
                        } else {
                            $_SESSION["nome"] = $nome;
                            
                            $sql_code = "UPDATE usuarios SET senha ='$senha' WHERE id='$id'";
                            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
                            
                            header("Location: Perfil.php");    
                        }    
                    }
                }    
            }
        ?>
        <input type= "button" id="voltar" type="none" onclick="window.location.href='./Edit.php'" value="Voltar"/>
        <button id="submit" type="submit">Submeter</button>      
    </form> 
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js " integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN " crossorigin="anonymous ">
    </script>

</body>

</html>