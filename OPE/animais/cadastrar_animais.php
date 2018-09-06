<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-09-04 19:14:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-05 22:12:25
 */

include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');
session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:index.php');
    }
 
// Imagens do animal
$imagem1 = $_FILES["imagem1"];  
$imagem2 = $_FILES["imagem2"]; 
$imagem3 = $_FILES["imagem3"]; 


$logado = $_SESSION['login'];
$grup_id = $_SESSION['grup_id'];
$logi_id = $_SESSION['logi_id'];

//Tipo de cadastro de animal
$tipo_cadastro = $_SESSION['tipo_cadastro'];

// DADOS DO ANIMAL
$anim_nome = ($_POST['nome']) ? $_POST['nome'] : "";
$anim_ra = ($_POST['ra']) ? $_POST['ra'] : 0;
$anim_idade = ($_POST['idade']) ? $_POST['idade'] : "";
$anim_porte = ($_POST['porte']) ? $_POST['porte'] : "";
$anim_genero = ($_POST['genero']) ? $_POST['genero'] : "";
$anim_categoria = ($_POST['genero']) ? $_POST['genero'] : "";
$anim_restricao_doacao = ($_POST['restricao']) ? $_POST['restricao'] : "";
$anim_castracao = ($_POST['castracao']) ? $_POST['castracao'] : 2;


// DADOS DO ENDEREÇO
$anen_logradouro = ($_POST['logradouro']) ? $_POST['logradouro'] : "";
$anen_numero = ($_POST['numero']) ? $_POST['numero'] : 0;
$anen_complemento = ($_POST['complemento']) ? $_POST['complemento'] : "";
$anen_pais = ($_POST['pais']) ? $_POST['pais'] : "";
$anen_estado = ($_POST['estado']) ? $_POST['estado'] : "";
$anen_cidade = ($_POST['cidade']) ? $_POST['cidade'] : "";
$anen_bairro = ($_POST['bairro']) ? $_POST['bairro'] : "";
$anen_cep = ($_POST['cep']) ? $_POST['cep'] : 0;





//Inserção dos dados do animal
$sql = "INSERT INTO 
            animais
            (
                anim_nome,
                anim_ra,
                anim_idade,
                anim_porte,
                anim_genero,
                anim_categoria,
                anim_restricao_doacao,
                anim_castracao,
                anim_data_cadastro
            )
            VALUES
            (
                '$anim_nome',
                $anim_ra,
                '$anim_idade',
                '$anim_porte',
                '$anim_genero',
                '$anim_categoria',
                '$anim_restricao_doacao',
                '$anim_castracao',
                NOW()
            )";
$result = mysqli_query($conn, $sql);

//Busca do ultimo animal cadastrado (Correção futura)
$query= " SELECT max(anim_id) as anim_id from animais";
$result = mysqli_query($conn, $query);
$id_animal = mysqli_fetch_object($result);

//Verificação do grupo de usuario
if($grup_id == 3){

    //Recuperar id do usuario que quer cadastrar animal
    $sql2 = "SELECT
                usua_id
            FROM
                login_x_usuarios
            WHERE
                logi_id  = $logi_id   
            ";
    $result = mysqli_query($conn, $sql2);
    $id_usuario = mysqli_fetch_object($result);

    //Cadastro com ligação de usuário
    $sql3 = "   INSERT INTO 
                    usuarios_x_animais 
                        (
                            usua_id,
                            anim_id,
                            usan_flag,
                            usan_data_cadastro   
                        )
                VALUES 
                        (
                            $id_usuario->usua_id,
                            $id_animal->anim_id,
                            $tipo_cadastro,
                            NOW()
                        )";
   // echo $sql3;
    $c3 = mysqli_query($conn, $sql3);
}
//Verificação do grupo de empreendimento
elseif($grup_id == 4 ||$grup_id == 2){

    //Recuperar id do empreendimento que quer cadastrar animal
    $sql2 = "SELECT
                empr_id
            FROM
                login_x_empreendimentos
            WHERE
                logi_id  = $logi_id   
            ";
    $result = mysqli_query($conn, $sql2);
    $id_empre = mysqli_fetch_object($result);

    //Cadastro com ligação de empreendimentos
    $sql3 = "   INSERT INTO 
                    empreendimentos_x_animais 
                        (
                            empr_id,
                            anim_id,
                            eman_flag,
                            eman_data_cadastro   
                        )
                VALUES 
                        (
                            $id_empre->empr_id,
                            $id_animal->anim_id,
                            $tipo_cadastro,
                            NOW()
                        )";
   // echo $sql3;
    $c3 = mysqli_query($conn, $sql3);
}

?>