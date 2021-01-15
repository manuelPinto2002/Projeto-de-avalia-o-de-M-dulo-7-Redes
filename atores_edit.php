<?php


session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo



if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (isset($_GET['ator'])&& is_numeric($_GET['ator'])) {
		$idAtor=$_GET['ator'];
		$con=new mysqli("localhost","root","","filmes");

		if ($con->connect_errno!=0) {
				echo "<h1>Ocorreu um erro no acesso a base de dados.<br>".$connect_eror."</h1>";
				exit();
		}
		$sql="Select * from atores where id_Ator=?";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
				$stm->bind_param("i",$idAtor);
				$stm->execute();
				$res=$stm->get_result();
				$ator=$res->fetch_assoc();
				$stm->close();
		}
	
				  ?>
	  <!DOCTYPE html>
	  <html>
	  <head>
	  	<title>Editar Atores</title>
	  </head>
	  <body>
	  <h1>Editar Atores</h1>


<?php 
$stm=$con->prepare('select * from atores');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {
	


}
 ?>




	  <form action="atores_update.php?ator=<?php  echo $ator['id_Ator']; ?>" method="post">
	<label>Nome</label><input type="text" name="Nome" required value="<?php echo $ator['Nome'];?>"><br>
	<label>Nacionalidade</label><input type="text" name="Nacionalidade" value="<?php echo $ator['Nacionalidade'];?>"><br>
	<label>Data Nascimento</label><input type="date" name="Data_Nascimento" value="<?php echo $ator['Data_Nascimento'];?>"><br>
	<input type="submit" name="enviar">
</form>


	  </body>
	  </html>
	  <?php
	}	
else{
	echo ("<h1>houve um erro ao precessar o seu pedido.<br> Dentro de segundos sera reencaminhado!</h1>");
	header("refresh:5; url=index.php");
	}
	$stm->close();
	}


}
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}	
?>