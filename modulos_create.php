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

if ($_SERVER['REQUEST_METHOD']=="POST") {
	$iddisciplina="";
	$numero="";
	$modulo="";

	if (isset($_POST['id_disciplina'])) {
		$iddisciplina=$_POST['id_disciplina'];
	}
	else{
		echo "<script>alert('É obrigatorio o preenchimento do id.');</script>";
	}
	if (isset($_POST['numero'])) {
		$numero=$_POST['numero'];
	}
	if (isset($_POST['modulo'])) {
		$modulo=$_POST['modulo'];
	}
	$con=new mysqli("localhost","root","","bddisciplina");
	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados.<br>".$con->connect_erro;
		exit;
	}
	else{
		$sql='insert into modulos (id_disciplina,numero,modulo) values (?,?,?)';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('iss',$iddisciplina,$numero,$modulo);
			$stm->execute();
			$stm->close();

			echo "<script>alert('modulo adicionado com sucesso')</script>";

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
	<title>Adicionar Modulo</title>
</head>
<body>
<h1>Adicionar Modulo</h1>
<form action="modulos_create.php" method="post">
	<label>id_disciplina</label><input type="text" name="id_disciplina" required><br>
	<label>numero</label><input type="text" name="numero"><br>
	<label>modulo</label><input type="text" name="modulo"><br>
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