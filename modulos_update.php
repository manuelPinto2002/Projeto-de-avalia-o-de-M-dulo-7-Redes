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
	$idAtor=$_GET['ator'];
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
		$sql='update atores set Nome=?, Data_Nascimento=?, Nacionalidade=? where id_Ator=?';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('sssi',$nome,$data_nascimento,$nacionalidade,$idAtor);
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