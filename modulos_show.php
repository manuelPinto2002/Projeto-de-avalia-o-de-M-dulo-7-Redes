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
 ?>


<head>
	<title></title>
</head>
<?php 

if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (!isset($_GET['modulo'])|| !is_numeric($_GET['modulo'])) {
		echo "<script>alert('Erro ao abrir modulo');</script>";
		echo "Aguarde um momento.A reencaminhar pagina";
		header("refresh:5;url=index.php");
	}
	$idModulo=$_GET['modulo'];
	$con=new mysqli("localhost","root","","bddisciplina");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
		exit;
	}
	else{
		$sql='select * from modulos where id_modulo=?';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('i',$idModulo);
			$stm->execute();
			$res=$stm->get_result();
			$modulo=$res->fetch_assoc();
			$stm->close();

		}
		else{
			echo "<br>";
			echo ($con->error);
			echo "<br>";
			echo "Aguarde um momento. A reencaminhar pagina";
			echo "<br>";
			header("refresh:5; url=index.php");
		}
	}//end if 
}//if($_server...)
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Detalhes</title>
</head>
<body>
<h1>Detalhes do Modulo</h1>
<?php 
if (isset($modulo)) {
	echo "<br>";
	echo "ID disciplina ".utf8_encode($modulo['id_disciplina']);
	echo "<br>";
	echo "Numero ".utf8_encode($modulo['numero']);
	echo "<br>";
	echo "Modulo ".$modulo['modulo'];
	echo "<br>";
}
else{
 echo "<h2>Parece que o modulo selecionado nao existe. <br> confirme a sua seleção</h2>";
}

?>
</body>
</html>
<?php
}
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}
  ?>