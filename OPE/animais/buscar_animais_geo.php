<?php 
/*
 * @Author: Rafael Yuiti Haga
 * @Date: 2018-09-12 19:55:28 
 * @Last Modified by: Rafael.Haga
 * @Last Modified time: 2018-09-12 19:55:25
 */
    include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');
    session_start();
    
        if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
        {
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            unset($_SESSION['grup_id']);
            header('location:index.php');
        }
     
    $logado = $_SESSION['login'];
    $logi_id = $_SESSION['logi_id'];
    $grup_id = $_SESSION['grup_id'];
    $castracao = '';
    $results = "";
    
    $sql = "SELECT
                anen_logradouro,
                anen_numero,
                anen_complemento,
                anen_estado,
                anen_cidade,
                anen_bairro,
                anen_cep,
                anen_pais,
            FROM 
                animais_endereco";

    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_object($result)){

        if(!isset($ids)){
            $ids = $row->anim_id;
        }
        $ids = $ids.",".$row->anim_id;
    }
    
     include_once("../menu_footer/menu_empreendimento.php"); 
    ?>
    
<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../static/estilo.css">

</head>

<body>

    <table class="table tabelas" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">imagem</th>
                <th scope="col">Nome</th>
                <th scope="col">RA</th>
                <th scope="col">Idade</th>
                <th scope="col">Porte</th>
                <th scope="col">Genero</th>
                <th scope="col">Categoria</th>
                <th scope="col">Restrição de adoção</th>
                <th scope="col">Castração</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <?php echo $result ?>
    </table>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1nkX5KVBXgDHas0sYoCXqws8MzKCWBcQ&libraries=places"></script>

    <a class="btn btn-dark" href="..\empreendimentos\home_empreendimento.php"> Voltar</a>
</body>

<footer>

    <?php 
    include_once("../menu_footer/footer.php");     
    ?>

</footer>

</html>