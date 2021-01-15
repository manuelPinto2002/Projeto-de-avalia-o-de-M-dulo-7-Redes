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
	$data_nascimento="";


	if (isset($_POST['Nome'])) {
		$nome=$_POST['Nome'];
	}
	else{
		echo "<script>alert('É obrigatorio o preenchimento do Nome.');</script>";
	}
	if (isset($_POST['Nacionalidade'])) {
		$nacionalidade=$_POST['Nacionalidade'];
	}
	if (isset($_POST['Data_Nascimento'])) {
		$data_nascimento=$_POST['Data_Nascimento'];
	}
	$con=new mysqli("localhost","root","","filmes");
	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados.<br>".$con->connect_erro;
		exit;
	}
	else{
		$sql='insert into atores (Nome, Nacionalidade,Data_Nascimento ) values (?,?,?)';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('sss',$nome,$nacionalidade,$data_nascimento);
			$stm->execute();
			$stm->close();

			echo "<script>alert('Ator adicionado com sucesso')</script>";

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
<form action="atores_create.php" method="post">
	<label>Nome</label><input type="text" name="Nome" required><br>
	<label>Nacionalidade</label><input type="text" name="Nacionalidade"><br>
	<label>Data Nascimento</label><input type="date" name="Data_Nascimento"><br>
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