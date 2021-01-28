<?php
if (isset($_POST['send'])){

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=person", "root","");
        //echo "<script>console.log('Ligado ao Servidor')</script>";
    
        //Recebendo as Variaveis
        $usuario_email = $_POST['in_email'];
        $usuario_senha = $_POST['in_senha'];
    
        //Teste de recepção dos dados
       // echo "Seu email é {$usuario_email} e sua senha é {$usuario_senha}";
            //$busca = "SELECT * FROM acess WHERE email = :usuario AND senha = :pass";
            $busca = "SELECT * FROM acess ac JOIN user us ON ac.cod_user = us.id_user WHERE us.nome_user = :usuario AND  us.user_pass = :pass";

            $enconta = $pdo ->prepare($busca);
            $enconta->bindValue(":usuario",$usuario_email);
            $enconta->bindValue(":pass",$usuario_senha);
            $enconta->execute();

                    if ($enconta->rowCount() == 1) {

                        while ($percorrer = $enconta->fetch(PDO::FETCH_ASSOC)) {
                            //Variavel que Armazena tipo de Usuarios e nome do Usuário
                            $adm = $percorrer['ac.adm'];
                            $nome = $percorrer['us.nome_user'];

                            session_start(); 

                                //Estrutura de Condição que valida os tipos de usuários
                                if ($adm == 1) {
                                    $_SESSION['super'] = $nome;
                                  
                                  //  echo "Este usuário é Admninistrador";
                                    echo "<script>window.location = cloud/admin/painel.php'</script>";
                                }
                                elseif ($adm == 2 ){
                                    $_SESSION['editor'] = $nome;

                                    echo "<script>window.location = 'cloud/editor/painelEditor.php'</script>";
                                   // echo "Este usuário é Editor";
                                   
                                }
                                else {
                                    $_SESSION['normal'] = $nome;
                                  
                                  //  echo "Este usuário é Normal";
                                  echo "<script>window.location = 'cloud/normal/painelNormal.php'</script>";
                                    
                                }

                              
                        }
                    }
                    else{
                        echo "<script>window.alert('User not Found - Create new Accont')</script>";
                        echo "<script>window.location = '../index.php'</script>"; 
                    }
    
    } catch (MysqlExepction $alert) {
        echo "<script>console.log('Erro na Ligação com o Servidor')</script> <br> {$alert}";
        
    }
    
}

else{
header("Location: index.php");
}




?>