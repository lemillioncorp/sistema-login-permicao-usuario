<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor: Painel de Administração</title>
</head>
<body>

<?php if($_SESSION['editor']): ?>
    <h1>Editor com o nome </h1>
    <h3> <?php    echo "Bem vindo ". $_SESSION["editor"]. "  EDITOR";?> </h3>
<?php endif; ?>
<br><br><br>
<a href="sair.php">Sair X </a>
</body>
</html>