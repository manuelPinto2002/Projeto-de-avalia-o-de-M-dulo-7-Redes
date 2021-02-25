<?php 
session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo

if ($_SERVER['REQUEST_METHOD']=="POST") {
	$nome="";
	$username="";
	$email="";
	$password="";

	if (isset($_POST['nome'])) {
		$nome=$_POST['nome'];
	}
	else{
		echo "<script>alert('É obrigatorio o preenchimento do nome.');</script>";
	}
	if (isset($_POST['user_name'])) {
		$username=$_POST['user_name'];
	}
	else{
		echo "<script>alert('É obrigatorio o preenchimento do user_name.');</script>";
	}
	if (isset($_POST['email'])) {
		$email=$_POST['email'];
	}
	else{
		echo "<script>alert('É obrigatorio o preenchimento do email.');</script>";
	}
	if (isset($_POST['password'])) {
		$password=$_POST['password'];
	}
	else{
		echo "<script>alert('É obrigatorio o preenchimento do password.');</script>";
	}


	$con=new mysqli("localhost","root","","bddisciplina");
	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados.<br>".$con->connect_erro;
		exit;
	}
	else{
		$sql='insert into utilizadores (nome,user_name,email,password) values (?,?,?,?)';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('isss',$nome,$username,$email,$password);
			$stm->execute();
			$stm->close();

			echo "<script>alert('utilizador adicionado com sucesso')</script>";

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
	<title>Adicionar Autores</title>
</head>
<body>
<h1>Adicionar Autores</h1>
<form action="modulos_create.php" method="post">
	<label>Nome</label><input type="text" name="nome" required><br>
	<label>User Nome</label><input type="text" name="user_name"><br>
	<label>Email</label><input type="text" name="email"><br>
	<label>Palavra Passe</label><input type="password" name="password"><br>
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