<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
        <!-- Styles CSS-->
				 <link rel="stylesheet" href="styles/style.css">
</head>
<body>
	<!-- WebSite Header Begin -->
	<header>
		<div class="styles_cabecera">
			<div class="style_logo">
				<a href="#"><img src="./resources/php_logo.png" alt="img"></a>
			</div>
			<nav>
				<!--Header's Button List-->
				<ul>
            <?php
							//IF there aren't session started, start one
              if (!session_id()) {
                      session_start();
              }
							//IF there are user logged , show this button list
              if(isset($_SESSION["user"])){
                      echo '<li><a href="index.php">Inicio</a></li>';
                      echo '<li><a href="index.php?section=salir">Salir</a></li>';
              }
							//IF there aren't user logged , show this button list
              else{
                  echo '<li><a href="index.php?section=entrar">Entrar</a></li>';
                  echo '<li><a href="index.php?section=registrar">Registrar</a></li>';

              }
            ?>
				</ul>
			</nav>
		</div>
	</header>
	<!-- WebSite Header End -->
