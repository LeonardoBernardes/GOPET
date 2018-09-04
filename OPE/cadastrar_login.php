
<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 01:34:11 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-30 19:35:07
 */

include_once(dirname( __FILE__ ) .'\mysql_conexao\conexao_mysql.php');

$logi_nome = mysqli_real_escape_string($_POST['login']) ? $_POST['login'] : "");
$logi_email = mysqli_real_escape_string(($_POST['email']) ? $_POST['email'] : "");
$logi_senha = mysqli_real_escape_string(($_POST['senha']) ? $_POST['senha'] : "");
$grupo_id = mysqli_real_escape_string(($_POST['tipo_usuario']) ? $_POST['tipo_usuario'] : "");

$sql2 = "   INSERT INTO 
                login 
                ( 
                    logi_nome, 
                    logi_email,
                    logi_senha,
                    logi_status, 
                    logi_data_cadastro,
                    grup_id
                ) 
                VALUES 
                ( 
                    '$logi_nome',
                    '$logi_email',
                    '$logi_senha',
                    0, 
                    '2018-08-13 18:35:00', 
                    $grupo_id)";
//echo $sql2;
$c2 = mysqli_query($conn, $sql2);

header('location:..\OPE\index.php');

?>
