
<?php 
include_once 'config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-13 18:11:37 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-04 18:46:17
 */

//include_once('C:/wamp/www/PHP/OPE/mysql_conexao/conexao_mysql.php');
include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';

// session_start inicia a sessão
session_start();
// as variáveis login e senha recebem os dados digitados na página anterior
$login = $_POST['login'];
$senha = $_POST['senha'];


$sql="  SELECT 
            logi_id,
            grup_id,
            logi_status 
        FROM 
            `login` 
        WHERE 
            `logi_nome` = '$login' 
            AND `logi_senha`= '$senha'
        ";

$result =  mysqli_query($conn, $sql);



if(mysqli_num_rows($result) > 0)
{
    while ($row = mysqli_fetch_object($result)) {
        $_SESSION['logi_id'] = $row->logi_id;
        $_SESSION['logi_status'] = $row->logi_status;
        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;
        $_SESSION['grup_id'] = $row->grup_id;
       

       //var_dump($row);
       /* if($row->grup_id == 1){
            header('location: '.$server_static.'administradores/home_administradores.php');
            $_SESSION['loginErro'] = '<p class="alert alert-success">Seja Bem vindo</p>';
        }elseif($row->grup_id == 2 || $row->grup_id == 4){
            header('location: '.$server_static.'index.php');
            $_SESSION['loginErro'] = '<p class="alert alert-success">Seja Bem vindo</p>';
        }elseif($row->grup_id == 3 ){
            header('location: '.$server_static.'index.php');
            $_SESSION['loginErro'] = '<p class="alert alert-success">Seja Bem vindo</p>';
        }
        */
        if($row->grup_id == 1){
            header('location: '.$server_static.'administradores/home_administradores.php');
        }elseif($row->grup_id == 2 || $row->grup_id == 4){
            header('location: '.$server_static.'empreendimentos/home_empreendimento.php');
        }elseif($row->grup_id == 3 ){
            header('location: '.$server_static.'usuarios/home_usuarios.php');
        }


    }

}else{
  unset ($_SESSION['login']);
  unset ($_SESSION['senha']);
  $_SESSION['loginErro'] = '<p class="alert alert-danger">Sua senha ou login está errada!</p>';
  header('location: '.$server_static.'index.php');
   
}
?>