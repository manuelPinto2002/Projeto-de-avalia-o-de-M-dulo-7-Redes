<?php 


session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo






if ($_SERVER['REQUEST_METHOD']=="POST") {
	$titulo="";
	$sinopse="";
	$idioma="";
	$data_lancamento="";
	$quantidade=0;
	$idFilme=$_GET['filme'];
	if (isset($_POST['titulo'])) {
		$titulo=$_POST['titulo'];
	}
	else{
		echo "<script>alert('É obrigatorio o preenchimento do titulo.');</script>";
	}
	if (isset($_POST['sinopse'])) {
		$sinopse=$_POST['sinopse'];
	}
	if (isset($_POST['quantidade'])&& is_numeric($_POST['quantidade'])) {
		$quantidade=$_POST['quantidade'];
	}
	if (isset($_POST['idioma'])) {
		$idioma=$_POST['idioma'];
	}
	if (isset($_POST['data_lancamento'])) {
		$data_lancamento=$_POST['data_lancamento'];
	}
	$con=new mysqli("localhost","root","","filmes");
	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados.<br>".$con->connect_erro;
		exit;
	}
	else{
		$sql='update filmes set titulo=?, sinopse=?, idioma=?, quantidade=?, data_lancamento=? where id_Filme=?';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('sssisi',$titulo,$sinopse,$idioma,$quantidade,$data_lancamento,$idFilme);
			$stm->execute();
			$stm->close();
echo "<script>alert('filme adicionado com sucesso')</script>";

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