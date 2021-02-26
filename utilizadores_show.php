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
	if (!isset($_GET['id_utili'])|| !is_numeric($_GET['id_utili'])) {
		echo "<script>alert('Erro ao abrir utilizador');</script>";
		echo "Aguarde um momento.A reencaminhar pagina";
		header("refresh:5;url=index.php");
	}
	$idUtilizador=$_GET['id_utili'];
	$con=new mysqli("localhost","root","","bddisciplina");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso à base de dados.<br>".$con->connect_error;
		exit;
	}
	else{
		$sql='select * from utilizadores where id=?';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('i',$idUtilizador);
			$stm->execute();
			$res=$stm->get_result();
			$id_utili=$res->fetch_assoc();
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
if (isset($id_utili)) {
	echo "<br>";
	echo "Nome".utf8_encode($id_utili['nome']);
	echo "<br>";
	echo "User Name ".utf8_encode($id_utili['user_name']);
	echo "<br>";
	echo "Email ".$id_utili['email'];
	echo "<br>";
	echo "password ".$id_utili['password'];
	echo "<br>";

}
else{
 echo "<h2>Parece que o utilizador selecionado nao existe. <br> confirme a sua seleção</h2>";
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