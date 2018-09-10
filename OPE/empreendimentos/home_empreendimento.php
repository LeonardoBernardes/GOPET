<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 20:59:32 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-04 19:27:03
 */
include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');
session_start();

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['grup_id']);
        unset($_SESSION['logi_id']);
        unset($_SESSION['logi_status']);
        header('location:index.php');
    }
 
$logado = $_SESSION['login'];
$logi_id = $_SESSION['logi_id'];
//$status_empr = $_SESSION['logi_status'];

$menu_eventos = '';

//Pega o id do empreendimento que esse usuário está atrelado
$sql = "SELECT
            empr_id
        FROM
            login_x_empreendimentos
        WHERE
            logi_id  = $logi_id   
    ";

$result = mysqli_query($conn, $sql);
$row2 = mysqli_fetch_object($result);

//var_dump($_SESSION);
?>
   
<body>

<?php
    
include_once "../menu_footer/menu_empreendimento.php" 
    
?>
    
            
<!-- MEIO -->
<div class="one_page home_empreendimento">
<div class="card_titulo p-4">
        <h2>Sua pagina de Empreendimento</h2>
    </div>
</div>

    
<?php
    
include_once "../menu_footer/footer.php" 
    
?>

</body>          
    

