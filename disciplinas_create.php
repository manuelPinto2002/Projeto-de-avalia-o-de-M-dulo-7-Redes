<?php 

session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo



if ($_SERVER['REQUEST_METHOD']=="POST") {
	
	$disciplina="";
	

	if (isset($_POST['disciplina'])) {
		$disciplina=$_POST['disciplina'];
	}
	else{
		echo "<script>alert('É obrigatorio o preenchimento do disciplina.');</script>";
	}
	
	$con=new mysqli("localhost","root","","bddisciplina");
	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados.<br>".$con->connect_erro;
		exit;
	}
	else{
		$sql='insert into disciplinas (disciplina) values (?)';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('s',$disciplina);
			$stm->execute();
			$stm->close();

			echo "<script>alert('disciplina adicionado com sucesso')</script>";

			echo "Aguarde um momento. A reencaminhar pagina";

			header("refresh:5; url=index.php");
		}
		else{
			echo ($con->error);
			echo "Aguarde um momento. A reencaminhar página";
			header("refresh:5; url=index.php");
		} 
	} //end if
} //if
else{
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Adicionar disciplinas</title>
</head>
<body>
<h1>Adicionar disciplinas</h1>
<form action="disciplinas_create.php" method="post">
	<label>Disciplina</label><input type="text" name="disciplina" required><br>
	
	<input type="submit" name="enviar">
</form>
</body>
</html>
<?php  
}

}
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}


?>