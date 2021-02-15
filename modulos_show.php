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

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="fa/css/all.css">
	<script type="text/javascript" src="fa/js/all.js"></script>
	 <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
</head>
<?php 

if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (!isset($_GET['ator'])|| !is_numeric($_GET['ator'])) {
		echo "<script>alert('Erro ao abrir Autor');</script>";
		echo "Aguarde um momento.A reencaminhar pagina";
		header("refresh:5;url=index.php");
	}
	$idAtor=$_GET['ator'];
	$con=new mysqli("localhost","root","","filmes");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
		exit;
	}
	else{
		$sql='select * from atores where id_Ator=?';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('i',$idAtor);
			$stm->execute();
			$res=$stm->get_result();
			$ator=$res->fetch_assoc();
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
<h1>Detalhes do Autor</h1>
<?php 
if (isset($ator)) {
	echo "<br>";
	echo utf8_encode($ator['Nome']);
	echo "<br>";
	echo utf8_encode($ator['Nacionalidade']);
	echo "<br>";
	echo $ator['Data_Nascimento'];
	echo "<br>";
}
else{
 echo "<h2>Parece que o Autor selecionado nao existe. <br> confirme a sua seleção</h2>";
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