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
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // prepare and execute DELETE statement
            $sql = "DELETE FROM usuarios WHERE id=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            // destroy session and redirect to homepage
            session_destroy();
            header("Location: Website.php");
        }
?>
    <form method="POST" id="meuFormDel">

        <label id="message"> Esta acção vai eliminar definitivamente a sua conta </label>

        <p></p>
        <input type= "button" id="voltar" type="none" onclick="window.location.href='./Perfil.php'" value="Voltar"/>
        <button id="eliminarconf" type="submit">Eliminar conta</button>
    </form>
    <p></p>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js " integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN " crossorigin="anonymous ">
    </script>


    <script src="Website.js"></script>
</body>

</html>