<?php 
/*
 * @Author: Rafael Yuiti Haga
 * @Date: 2018-09-12 19:55:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-18 19:37:06
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
    $arr_animais = array();

    $sql = "SELECT
                anen_logradouro as logradouro,
                anen_numero as numero,
                anen_complemento as complemento,
                anen_estado as estado,
                anen_cidade as cidade,
                anen_bairro as bairro,
                anen_cep as cep,
                anen_pais as pais,
                anim_id 
            FROM 
                animais_endereco";

    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_object($result)){

        $arr_animais[$row->anim_id] = $row;
    }
    json_encode($arr_animais);
    

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
    <div class="container col-md-12">

        <div>   
            TESTE<br>
            TESTE<br>
            TESTE<br>
            TESTE<br>
        </div>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1nkX5KVBXgDHas0sYoCXqws8MzKCWBcQ&libraries=places"></script>
    </div>
    <a class="btn btn-dark" href="..\empreendimentos\home_empreendimento.php"> Voltar</a>
</body>

<footer>

    <?php 
    include_once("../menu_footer/footer.php");     
    ?>

</footer>

</html>