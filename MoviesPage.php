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

<body>
    <?php echo createNavBar("Movies");?>

    <div style="background-color: transparent;">
        <form class="d-flex" role="search ">
            <input class="form-control me-2" id="searchBar" type=" search " placeholder="Search " aria-label="Search ">
            <button class="btn " id="search" type="submit ">Search</button>
        </form>
    </div>
    <div class="movie-container">
        <?php
            if(isset($_GET["mystring"])) {
                // Obter filme pesquisado
                $titulo = [$_GET["mystring"]]; 
                $stmt = $pdo->prepare('SELECT * FROM media WHERE tipo IN (0, 2) AND titulo LIKE ?%');
                $stmt->execute([$titulo]);
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                // Obter lista de filmes
                $stmt = $pdo->query('SELECT * FROM media WHERE tipo IN (0, 2)');
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            // Iterar sobre os filmes
            foreach ($results as $result) {
                // Estrutura div para um filme
                $html = '<div class="container">
                <h3 class="titulo">' . $result["titulo"] . '</h3>
                <img src= ' . '"' . $result['caminho'] . '">
                <p class="descricao">' . $result["descricao"] . '</p>';
                // Verificar se sessão esta ativa
                if (isset($_SESSION["id"])) {
                    // Se sim tem-se checkbox
                    $html = $html . '<form method="POST"> <input type="hidden" name="form-title" value="' . $result["titulo"] . '">'; 
                    $stmt = $pdo->prepare('SELECT * FROM vistos WHERE titulo = ? AND id = ?');
                    $stmt->execute([$result["titulo"], $_SESSION["id"]]);
                    if ($stmt->rowCount() != 0) {
                        // Se o utilizador ja viu a checkbox esta ativa
                        $html = $html . 
                        '<input type="checkbox" class="check" name="visto" checked >Visto</input>';
                    } else {
                        $html = $html .
                        '<input type="checkbox" class="check" name="visto" >Visto</input>';
                    }
                    $stmt = $pdo->prepare('SELECT * FROM para_ver WHERE titulo = ? AND id = ?');
                    $stmt->execute([$result["titulo"], $_SESSION["id"]]);
                    if ($stmt->rowCount() != 0) {
                        // Se o utilizador ja registrou na lista para ver a checkbox esta ativa
                        $html = $html .
                        '<input type="checkbox" class="check" name="pver" checked>Para ver</input>';
                    } else {
                        $html = $html .
                        '<input type="checkbox" class="check"  name="pver" >Para ver</input>';
                    }
                    $html = $html . '<input type="submit" name="submit">'; 
                    $html = $html . '</form>'; 
                }
                $html = $html . '</div>';
                echo $html;
            }
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                if(isset($_POST['search'])) {
                    // Pesquisa de titulo
                    $titulo = $_POST['search'];
                    $queryString = http_build_query([ // Construir msg para passar pelo header
                        'mystring' => $titulo
                    ]);
                    header("Location:MoviesPage.php?$queryString");
                }
                $titulo = $_POST["form-title"];
                if (isset($_POST["visto"])) {
                    // adicionar a bd
                    $stmt = $pdo->prepare("INSERT INTO vistos(titulo, id) VALUES (?, ?)");
                    $stmt->execute([$titulo, $_SESSION["id"]]);
                } else {
                    // remover da bd
                    $stmt = $pdo->prepare("DELETE FROM vistos WHERE titulo=? AND id=?");
                    $stmt->execute([$titulo, $_SESSION["id"]]);
                }
                if (isset($_POST["pver"])) {
                    // adicionar a bd
                    $stmt = $pdo->prepare("INSERT INTO para_ver(titulo, id) VALUES (?, ?)");
                    $stmt->execute([$titulo, $_SESSION["id"]]);
                } else {
                    // remover da bd
                    $stmt = $pdo->prepare("DELETE FROM para_ver WHERE titulo=? AND id=?");
                    $stmt->execute([$titulo, $_SESSION["id"]]);
                }
                header("Location:MoviesPage.php");
            }
            ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js " integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN " crossorigin="anonymous "></script>
</body>

</html>