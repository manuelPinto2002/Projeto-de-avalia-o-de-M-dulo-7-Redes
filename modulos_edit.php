<?php  
include('boots.php');
?>
<?php


session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo



if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (isset($_GET['modulo'])&& is_numeric($_GET['modulo'])) {
		$idModulo=$_GET['modulo'];
		$con=new mysqli("localhost","root","","bddisciplina");

		if ($con->connect_errno!=0) {
				echo "<h1>Ocorreu um erro no acesso a base de dados.<br>".$connect_error."</h1>";
				exit();
		}
		$sql="Select * from modulos where id_modulo=?";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
				$stm->bind_param("i",$idModulo);
				$stm->execute();
				$res=$stm->get_result();
				$modulo=$res->fetch_assoc();
				$stm->close();
		}
	
				  ?>
	  <!DOCTYPE html>
	  <html>
	  <head>
	  	<title>Editar Modulos</title>
	  </head>
	  <body>
	  <h1>Editar Modulos</h1>


<?php 
$stm=$con->prepare('select * from modulos');
$stm->execute();
$res=$stm->get_result();
while ($resultado=$res->fetch_assoc() ) {
	


}
 ?>




	  <form action="modulos_update.php?modulo=<?php  echo $modulo['id_modulo']; ?>" method="post">
	<label>id disciplina</label><input type="text" name="id_disciplina" required value="<?php echo $modulo['id_disciplina'];?>"><br>
	<label>numero</label><input type="text" name="numero" value="<?php echo $modulo['numero'];?>"><br>
	<label>Modulo</label><input type="text" name="modulo" value="<?php echo $modulo['modulo'];?>"><br>
	<input type="submit" name="enviar">
</form>

<a href="index.php">Menu</a>
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