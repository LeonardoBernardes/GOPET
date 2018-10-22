<?php 
include_once '../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-09-04 19:14:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-04 19:17:03
 */

include_once ROOT_PATH .'mysql_conexao/conexao_mysql.php';
session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:'.$server_static.'index.php');
    }
 

$foto = $_FILES["imagem1"];    
$logado = $_SESSION['login'];
$grup_id = $_SESSION['grup_id'];
$logi_id = $_SESSION['logi_id'];

$tipo_cadastro = ($_POST['tipo_cadastro']) ? $_POST['tipo_cadastro'] : '';

$anim_id = ($_GET['anim_id']) ? $_GET['anim_id'] : '';
$anim_nome = ($_POST['nome']) ? $_POST['nome'] : '';
$anim_ra = ($_POST['ra']) ? $_POST['ra'] : '';
$anim_idade = ($_POST['idade']) ? $_POST['idade'] : '';
$anim_porte = ($_POST['porte']) ? $_POST['porte'] : '';
$anim_genero = ($_POST['genero']) ? $_POST['genero'] : '';
$anim_categoria = ($_POST['categoria']) ? $_POST['categoria'] : '';
$anim_restricao_doacao = ($_POST['restricao']) ? $_POST['restricao'] : '';
$anim_castracao = ($_POST['castracao']) ? $_POST['castracao'] : '';

$anen_logradouro = ($_POST['logradouro']) ? $_POST['logradouro'] : '';
$anen_numero = ($_POST['numero']) ? $_POST['numero'] : '';
$anen_complemento = ($_POST['complemento']) ? $_POST['complemento'] : '';
$anen_bairro = ($_POST['bairro']) ? $_POST['bairro'] : '';
$anen_cidade = ($_POST['cidade']) ? $_POST['cidade'] : '';
$anen_estado = ($_POST['estado']) ? $_POST['estado'] : '';
$anen_pais = ($_POST['pais']) ? $_POST['pais'] : '';
$anen_cep = ($_POST['cep']) ? $_POST['cep'] : '';


$sql =" UPDATE 
            animais
        SET 
            anim_nome = '$anim_nome', 
            anim_ra = '$anim_ra', 
            anim_idade = '$anim_idade',
            anim_porte = '$anim_porte',
            anim_genero = '$anim_genero',
            anim_categoria = '$anim_categoria',
            anim_restricao_doacao = '$anim_restricao_doacao',
            anim_castracao = '$anim_castracao',
            anim_data_atualizacao = NOW()
            
        WHERE 
            anim_id  = $anim_id
        ";
//echo $sql;
$result =  mysqli_query($conn, $sql);


$sql2 = "   UPDATE 
                animais_endereco
            SET 
                anen_logradouro = '$anen_logradouro', 
                anen_numero = $anen_numero, 
                anen_complemento = '$anen_complemento',
                anen_bairro = '$anen_bairro',
                anen_cidade = '$anen_cidade',
                anen_estado = '$anen_estado',
                anen_pais = '$anen_pais',
                anen_cep = $anen_cep,
                anen_data_atualizacao = NOW()

            WHERE 
                anim_id  = $anim_id";
$result =  mysqli_query($conn, $sql2);


// Se a foto estiver sido selecionada
if (!empty($foto["name"])) {
            
    //   Controle de tamanho de imagens
        // Largura máxima em pixels
        $largura = 3000;
        // Altura máxima em pixels
        $altura = 3000;
        // Tamanho máximo do arquivo em bytes
        $tamanho = 45000;
    
        $error = array();
    
        // Verifica se o arquivo é uma imagem
        if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
            $error[1] = "Isso não é uma imagem.";
            } 
    
        // Pega as dimensões da imagem
        $dimensoes = getimagesize($foto["tmp_name"]);
    /*
        // Verifica se a largura da imagem é maior que a largura permitida
        if($dimensoes[0] > $largura) {
            $error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
        }
    
        // Verifica se a altura da imagem é maior que a altura permitida
        if($dimensoes[1] > $altura) {
            $error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
        }
        
        // Verifica se o tamanho da imagem é maior que o tamanho permitido
        if($foto["size"] > $tamanho) {
                $error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
        }
    */
        // Se não houver nenhum erro
        if (count($error) == 0) {
        
            // Pega extensão da imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
    
            // Gera um nome único para a imagem
            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
    
            // Caminho de onde ficará a imagem
            $caminho_imagem = "animais_imagens/" . $nome_imagem;
    
            // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($foto["tmp_name"], $caminho_imagem);
            $sql_verifica ="SELECT
                                anim_id
                            FROM 
                                animais_fotos
                            WHERE
                                anim_id = $anim_id
                            ";
            $v = mysqli_query($conn, $sql_verifica);
            $row4 = mysqli_fetch_object($v);
            if(empty($row4)){
                // Insere os dados no banco
                $sql = "INSERT INTO 
                            animais_fotos
                            (
                                anfo_endereco, 
                                anfo_data_cadastro, 
                                anim_id
                            ) 
                        VALUES 
                            (
                                '".$caminho_imagem."', 
                                NOW(),
                                $anim_id
                            )
                        ";

                $c3 = mysqli_query($conn, $sql);
            }else{
                $sql3 = "   UPDATE 
                                animais_fotos
                            SET 
                                anfo_endereco = '".$caminho_imagem."', 
                                anfo_data_atualizacao = NOW()
                            WHERE 
                                anim_id  = $anim_id";
                //echo $sql3;
                $result =  mysqli_query($conn, $sql3);
            }
        }
}

//Verificação do grupo de usuario
if($grup_id == 3){
    // echo"teste u";
     //Recuperar id do usuario que quer cadastrar animal
     $sql2 = "SELECT
                 usua_id
             FROM
                usuarios_x_animais
             WHERE
                anim_id  = $anim_id   
             ";
     $result = mysqli_query($conn, $sql2);
     $id_usuario = mysqli_fetch_object($result);
    if(empty($id_usuario)){
     //Cadastro com ligação de usuário
        $sql3= "INSERT INTO 
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
                             $anim_id,
                             $tipo_cadastro,
                             NOW()
                         )";
     // echo $sql3;
        $c3 = mysqli_query($conn, $sql3);
    }else{
        $sql3= "UPDATE 
                    usuarios_x_animais 
                SET
                    usua_id = $id_usuario->usua_id,
                    anim_id = $anim_id,
                    usan_flag = $tipo_cadastro,
                    usan_data_atualizacao = NOW()        
                WHERE 
                    anim_id = $anim_id
                    ";
        // echo $sql3;
        $c3 = mysqli_query($conn, $sql3);
    }
}
 //Verificação do grupo de empreendimento
elseif($grup_id == 4 ||$grup_id == 2){
 //echo"teste e";
    //Recuperar id do empreendimento que quer cadastrar animal
    $sql2 = "SELECT
                empr_id
            FROM
                empreendimentos_x_animais
            WHERE
                anim_id  = $anim_id  
            ";
            
    $result = mysqli_query($conn, $sql2);
    $id_empre = mysqli_fetch_object($result);
    if(empty($id_empre)){
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
                             $anim_id,
                             $tipo_cadastro,
                             NOW()
                         )";
    //echo $sql3;
     $c3 = mysqli_query($conn, $sql3);
    }else{
        $sql3= "UPDATE 
                    empreendimentos_x_animais 
                SET
                    empr_id = $id_empre->empr_id,
                    anim_id = $anim_id,
                    eman_flag = $tipo_cadastro,
                    eman_data_atualizacao = NOW()        
                WHERE 
                    anim_id = $anim_id
                    ";
      
        $c3 = mysqli_query($conn, $sql3);
    }
 }
 
 header('location:consulta_animais.php');
 
?>