<?php 

session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo

if ($_SERVER['REQUEST_METHOD']=="POST") {
	$id_disciplina="";
	$numero="";
	$modulo="";
	$idModulo=$_GET['modulo'];
	if (isset($_POST['id_disciplina'])) {
		$id_disciplina=$_POST['id_disciplina'];
	}
	else{
		echo "<script>alert('É obrigatorio o preenchimento do id_disciplina.');</script>";
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
		$sql='update atores set id_disciplina=?, numero=?, modulo=? where id_modulo=?';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('sssi',$id_disciplina,$numero,$modulo,$idModulo);
			$stm->execute();
			$stm->close();


			echo "Aguarde um momento. A reencaminhar pagina";

			header("refresh:5; url=index.php");
			}
		else{
			}
		}
	}
else{
	echo "<h1>Houve um erro ao processar o seu pedido!<br>Ira ser reencaminhado!</h1>";
	header("refresh:5; url=index.php");
	}

}
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}