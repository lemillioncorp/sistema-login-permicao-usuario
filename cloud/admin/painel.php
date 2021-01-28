<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
</head>
<body>
<?php if($_SESSION['super']) : ?>
<table width="80%" style="padding:2em;">
    <thead >
        <tr class="negrito" style="color:blue;">
            <td><strong> Email</strong></td>
            <td><strong>Senha</strong></td>
            <td><strong>Nome</strong></td>
            <td><strong>ID</strong></td>
        </tr>
    </thead>
    
    <tbody>
    <?php  

     $pdo = new PDO("mysql:host=localhost;dbname=person", "root","");
     $query = "SELECT * FROM acess ac JOIN user us ON ac.cod_user = us.id_user";
    $query = $pdo ->prepare($query);
    $query->execute();

    $users = $query->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < sizeof($users); $i++):
            $usuarioAtual = $users[$i];
        ?>
        <tr style="padding:2em;">
            <td><?php echo $usuarioAtual["email"]; ?></td>
            <td><?php  echo $usuarioAtual["senha"];?></td>
            <td><?php  echo $usuarioAtual["nome"];?></td>
            <td><?php  echo $usuarioAtual["adm"];?></td>
            <td><?php  echo $usuarioAtual["Id"];?></td>
        </tr>
        <?php endfor;?>
    </tbody>
</table>
<?php endif; ?>

<br><br><br>
<a href="sair.php">Sair X </a>
</body>
</html>