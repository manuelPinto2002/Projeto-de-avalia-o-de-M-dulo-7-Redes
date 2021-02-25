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
    

    $idDisciplina=$_GET['disciplina'];
    if (isset($_POST['disciplina'])) {
        $disciplina=$_POST['disciplina'];

    }
    $con=new mysqli("localhost","root","","bddisciplina");
    if ($con->connect_errno!=0) {
        echo "Ocorreu um erro no acesso á base de dados.<br>".$con->connect_error;
        exit;
    }
    else{
        $sql='update disciplinas set disciplina=? where id_disciplina=?';
        $stm=$con->prepare($sql);
        if ($stm!=false) {
            $stm->bind_param('si',$disciplina,$idDisciplina);
            $stm->execute();
            $stm->close();
echo "<script>alert('disciplina adicionado com sucesso')</script>";

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