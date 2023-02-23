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
    <?php echo createNavBar("Series") ?>

    <div style="background-color: transparent;">
        <form class="d-flex " role="search ">
            <input class="form-control me-2" id="searchBar" type="search " placeholder="Search " aria-label="Search ">
            <button class="btn " id="search" type="submit ">Search</button>
        </form>
    </div>
    <div class="series-container">

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js " integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN " crossorigin="anonymous ">
        function ddiv(caminho, titulo, desc, tipo) {
            let cont = document.getElementByClassName("series-container");
            let header = document.createElement("h3");
            let div = document.createElement("div");
            let img = document.createElement("img");
            let para = document.createElement("para");
            let b1 = document.createElement("button");
            let b2 = document.createElement("button");
            header.textContent = titulo;
            img.src = caminho;
            para.textContent = desc;
            b1.textContent = "Visto";
            b2.textContent = "Para ver";
            // div.addClassName("classspecial");
            // b1.addClassName("botoes");
            // b2.addClassName("botoes");
            cont.appendChild(div);
            div.appendChild(header);
            div.appendChild(para);
            div.appendChild(b1);
            div.appendChild(b2);

        }
        function createDivs(){
            lista = mysqli
            lista.forEach(ddiv);
        }
    </script>
</body>

</html>