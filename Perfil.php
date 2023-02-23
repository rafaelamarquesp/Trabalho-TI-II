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
    <?php 
        echo createNavBar("Perfil");
        
        $id=$_SESSION['id'];
        
        $q = $pdo->prepare("SELECT * FROM usuarios WHERE id=:id");
        $q->execute(array(':id' => $id));
        $res = $q->fetch(PDO::FETCH_ASSOC);
        
        echo '<table class="table" id="meusDados">
        <tr>
            <th>Id número:</th>
            <td>'.$res['id'].'</td> 
        </tr> 
        <tr>
            <th>Nome:</th>
            <td>'.$res['nome'].'</td>
            </tr> 
            <tr>
            <th>Data de nascimento:</th>
            <td>'.$res['data_'].'</td>
            </tr> 
            <tr>
            <th>Username:</th>
            <td>'.$res['username'].'</td>
            </tr> 
            <tr>
            <th>Email:</th>
            <td>'.$res['email'].'</td>
            
        </tr> 
        </table>';
    ?>
    <p>
        <button id="editar" onclick="window.location.href='Edit.php'" >Editar dados</button>
        <button id="eliminar"onclick="window.location.href='Delete.php'">Eliminar conta</button>
    </p>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js " integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN " crossorigin="anonymous ">
    </script>

</body>

</html>