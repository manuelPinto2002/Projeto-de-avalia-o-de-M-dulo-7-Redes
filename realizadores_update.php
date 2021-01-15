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
	$idRealizador=$_GET['realizador'];

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
		$sql='update realizadores set nome=?,nacionalidade=? where id_realizador=?';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('ssi',$nome,$nacionalidade,$idRealizador);
			$stm->execute();
			$stm->close();


			echo "Aguarde um momento. A reencaminhar pagina";

			header("refresh:5; url=index.php");
		}
		else{
			
		} 
	} //end if
} //if

else{
	echo "<h1>Houve um erro ao processar o seu pedido!<br>Ira ser reencaminhado!</h1>";
	header("refresh:5; url=index.php");
}


}
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}
?>