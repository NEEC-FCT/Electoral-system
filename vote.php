<?php

//Check time
if (mktime(14, 30, 0, 6, 17, 2020) < strtotime('now'))
{
    $voto = htmlspecialchars($_POST["voto"]);
    $token = htmlspecialchars($_GET["token"]);

    require 'db.php';

    $con = mysqli_connect("localhost", DB_USER, DB_PASS, DB_NAME);
    $con->set_charset("utf8mb4");

    $stmtt = $con->prepare("SELECT * FROM `voters` WHERE token = ? and used = 0 ");
    $stmtt->bind_param("s", $token);
    $stmtt->execute();

    /* store result */
    $stmtt->store_result();
    /* Bind the result to variables */

    $stmtt->fetch();
    if ($stmtt->num_rows == 0)
    {
        echo "<script>
        alert('O voto não é válido.');
        window.location.href='https://neec-fct.com/Electoral-system/index.php?token=" . $_GET["token"] . "' ; 
        </script>";
        exit;
    }
    else
    {
	$stmtt = $con->prepare("UPDATE `voters` SET `used` = '1' WHERE `voters`.`token` = ?;");
    $stmtt->bind_param("s", $token);
    $stmtt->execute();
	
	
	if (strpos($voto, 'ListaA') !== false) {
	$stmtt = $con->prepare("INSERT INTO `results`(`ListaA`) VALUES ( 1 )");
    }
    else if(strpos($voto, 'ListaB') !== false) {
	$stmtt = $con->prepare("INSERT INTO `results`(`ListaB`) VALUES ( 1 )");
    }
    else if(strpos($voto, 'Branco') !== false) {
	$stmtt = $con->prepare("INSERT INTO `results`(`Branco`) VALUES ( 1 )");
    }
    else if(strpos($voto, 'Nulo') !== false) {
	$stmtt = $con->prepare("INSERT INTO `results`(`Nulo`) VALUES ( 1 )");
    }
    else{
        echo "<script>
        alert('Voto não reconhecido');
        window.location.href='https://neec-fct.com/' ; 
        </script>";
        exit;
    }

    $stmtt->execute();
	
	echo "<script>
    alert('Voto registado com sucesso');
    window.location.href='https://neec-fct.com/' ; 
    </script>";

    }
}
else
{
    echo "<script>
    alert('Não pode votar antes da reunião.');
    window.location.href='https://neec-fct.com/Electoral-system/index.php?token=" . $_GET["token"] . "' ; 
    </script>";
}

?>
