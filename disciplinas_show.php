
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

	<?php  
include('boots.php');
?>
</head>
<?php 

if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (!isset($_GET['discip'])|| !is_numeric($_GET['discip'])) {
		echo "<script>alert('Erro ao abrir disciplina');</script>";
		echo "Aguarde um momento.A reencaminhar pagina";
		header("refresh:5;url=index.php");
	}
	$idDisciplina=$_GET['discip'];
	$con=new mysqli("localhost","root","","bddisciplina");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
		exit;
	}
	else{
		$sql='select * from disciplinas where id_disciplina=?';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('i',$idDisciplina);
			$stm->execute();
			$res=$stm->get_result();
			$discip=$res->fetch_assoc();
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
<h1>Detalhes do disciplina</h1>
<?php 
if (isset($discip)) {
	echo "<br>";
	echo utf8_encode($discip['disciplina']);
	echo "<br>";
	
}
else{
 echo "<h2>Parece que o disciplina selecionado nao existe. <br> confirme a sua seleção</h2>";
}

?>
<a href="index.php">Menu</a>
</body>
</html>



<?php
}
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}
  ?>