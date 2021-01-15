<?php

session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo



if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (isset($_GET['realizador'])&& is_numeric($_GET['realizador'])) {
		$idRealizador=$_GET['realizador'];
		$con=new mysqli("localhost","root","","filmes");

		if ($con->connect_errno!=0) {
				echo "<h1>Ocorreu um erro no acesso a base de dados.<br>".$connect_eror."</h1>";
				exit();
		}
		$sql="Select * from realizadores where id_realizador=?";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
				$stm->bind_param("i",$idRealizador);
				$stm->execute();
				$res=$stm->get_result();
				$realizador=$res->fetch_assoc();
				$stm->close();
		}
	
				  ?>
	  <!DOCTYPE html>
	  <html>
	  <head>
	  	<title>Editar realizador</title>
	  </head>
	  <body>
	  <h1>Editar realizador</h1>

<?php 
$stm=$con->prepare('select * from realizadores');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {

}
 ?>

	<h1>Editar realizadoes</h1>
<form action="realizadores_update.php?realizador=<?php  echo $realizador['id_realizador']; ?>" method="post">
	<label>Nome</label><input type="text" name="nome" required value="<?php echo $realizador['nome'];?>"><br>
	<label>Nacionalidade</label><input type="text" name="nacionalidade" value="<?php echo $realizador['nacionalidade'];?>"><br>
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