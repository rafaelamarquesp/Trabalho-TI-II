<?php
if(!isset($_SESSION)) {
    session_start();
}
function createNavBar($Page){
    $PaginasProtegidas = array(
        "Perfil" => "Perfil.php",
    );
    $Paginas = array(
        "Movies" => "MoviesPage.php",
        "Series" => "SeriesPage.php",
    );
    $navbar = '<nav class="navbar navbar-expand-lg" id="bar">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" id="menu" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
            <a class="navbar-brand" href="Website.php"><img src="logo.png" width=200></a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">';
                
                    if(isset($_SESSION['id'])){
                        foreach($PaginasProtegidas as $key => $Pagina){
                            $navbar = $navbar . '<li class="nav-item">
                            <a class="nav-link';
                            if ($Page == $key){
                                $navbar = $navbar . " active";
                            }
                            $navbar = $navbar . '" href="'.$Pagina.'">'.$key.'</a>
                            </li>'; 
                        }
                    }
                    foreach($Paginas as $key => $Pagina){
                        $navbar = $navbar . '<li class="nav-item">
                        <a class="nav-link';
                        if ($Page == $key){
                            $navbar = $navbar . " active";
                        }
                        $navbar = $navbar . '" href="'.$Pagina.'">'.$key.'</a>
                        </li>'; 
                    }
                    $navbar = $navbar .'</ul> <div id="filler"></div><ul class="navbar-nav me-auto mb-2 mb-lg-0">';

    if(isset($_SESSION['id'])) {
        $navbar = $navbar .
            '<a id=hello class="navbar-brand"> Hello, ' . $_SESSION["nome"] . '</a>
         <li class="nav-item">
             <a class="nav-link" id="logout" href="Logout.php">Log out</a>
         </li>';
    }else{
        $navbar = $navbar . '<li class="nav-item">
        <a class="nav-link';
        if ($Page == "SignUp") {
            $navbar = $navbar. ' active';
        }
        $navbar = $navbar .'" aria-current="page" id="signup" href="SignUp.php">Sign Up</a>
        </li>
        <li class="nav-item">
            <a class="nav-link';
        if ($Page == "LogIn"){
            $navbar = $navbar. ' active';
        }
            
        $navbar = $navbar . '" id="login" href=" LogIn.php ">Log In</a>
        </li>';
    }
    $navbar = $navbar . '</ul></div>
        </div>
    </nav>';
    return $navbar;
}
?>