<?php
    include('BaseDados.php');
	if (isset($_POST["visto"])) {
		// adicionar a bd
		$titulo = $_POST["visto"];
		$stmt = $pdo->prepare("INSERT INTO vistos(titulo, id) VALUES (?, ?)");
        $stmt->execute([$titulo, $_SESSION["id"]]);
		
	} else {
		// remover da bd
		$titulo = $_POST["visto"];
		$stmt = $pdo->prepare("DELETE FROM vistos WHERE id=? AND titulo=?");
        $stmt->execute([$titulo, $_SESSION["id"]]);
		
	}
	if (isset($_POST["pver"])) {
		// adicionar a bd
		$titulo = $_POST["pver"];
		$stmt = $pdo->prepare("INSERT INTO para_ver(titulo, id) VALUES (?, ?)");
		$stmt->execute([$titulo, $_SESSION["id"]]);
		
	} else {
		// remover da bd
		$titulo = $_POST["pver"];
		$stmt = $pdo->prepare("DELETE FROM para_ver WHERE id=? AND titulo=?");
		$stmt->execute([$titulo, $_SESSION["id"]]);
		
	}
?>