<?php 

session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo



if ($_SERVER['REQUEST_METHOD']=="POST") {
	$nome="";
	$nacionalidade="";
	$id="";


	if (isset($_POST['nome'])) {
		$nome=$_POST['nome'];
	}
	else{
		echo "<script>alert('É obrigatorio o preenchimento do Nome.');</script>";
	}
	if (isset($_POST['nacionalidade'])) {
		$nacionalidade=$_POST['nacionalidade'];
	}
	
	$con=new mysqli("localhost","root","","filmes");
	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados.<br>".$con->connect_erro;
		exit;
	}
	else{
		$sql='insert into realizadores (nome, nacionalidade ) values (?,?)';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('ss',$nome,$nacionalidade);
			$stm->execute();
			$stm->close();

			echo "<script>alert('realizador adicionado com sucesso')</script>";

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
	<title>Adicionar realizadores</title>
</head>
<body>
<h1>Adicionar realizadoes</h1>
<form action="realizadores_create.php" method="post">
	<label>Nome</label><input type="text" name="nome" required><br>
	<label>Nacionalidade</label><input type="text" name="nacionalidade"><br>
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