<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-09-04 19:14:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-18 18:35:10
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
$foto = $_FILES["imagem1"];  



$logado = $_SESSION['login'];
$grup_id = $_SESSION['grup_id'];
$logi_id = $_SESSION['logi_id'];

//Tipo de cadastro de animal
$tipo_cadastro = ($_POST['tipo_cadastro']) ? $_POST['tipo_cadastro'] : "";
$tipo_cadastro = intval($tipo_cadastro);


// DADOS DO ANIMAL
$anim_nome = ($_POST['nome']) ? $_POST['nome'] : "";
$anim_ra = ($_POST['ra']) ? $_POST['ra'] : 0;
$anim_idade = ($_POST['idade']) ? $_POST['idade'] : "";
$anim_porte = ($_POST['porte']) ? $_POST['porte'] : "";
$anim_genero = ($_POST['genero']) ? $_POST['genero'] : "";
$anim_categoria = ($_POST['categoria']) ? $_POST['categoria'] : "";
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
//echo $sql;
$result = mysqli_query($conn, $sql);

//Busca do ultimo animal cadastrado (Correção futura)
$query= " SELECT max(anim_id) as anim_id from animais";
$result = mysqli_query($conn, $query);
$id_animal = mysqli_fetch_object($result);

//Verificação do grupo de usuario
if($grup_id == 3){
   // echo"teste u";
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
//echo"teste e";
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
   //echo $sql3;
    $c3 = mysqli_query($conn, $sql3);
}



//Incluir imagens de animais
if(!empty($foto)){
    
    //Controle de tamanho de imagens

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
                            anfo_id
                        FROM 
                            animais_fotos
                        WHERE
                            anim_id = $id_animal->anim_id
                        ";
        //echo $sql_verifica;
        $v = mysqli_query($conn, $sql_verifica);
        $row4 = mysqli_fetch_object($v);
        if(empty($row4)){
            //echo "true";
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
                                $id_animal->anim_id
                            )
            ";
            //echo $sql;
            $c3 = mysqli_query($conn, $sql);
        }else{
            $sql = "UPDATE 
                        animais_fotos 
                    SET  
                        anfo_endereco = '".$caminho_imagem."', 
                        anfo_data_atualizacao = NOW() 
                    WHERE anim_id = $id_animal->anim_id
                ";
                //     echo $sql;
                $c3 = mysqli_query($conn, $sql);
        }

    }  
    // Se houver mensagens de erro, exibe-as
    if (count($error) != 0) {
        foreach ($error as $erro) {
            echo $erro . "<br />";
        }
    }
}


//Cadastro de endereço de animais
$sql4 = "   INSERT INTO 
                    animais_endereco 
                        (
                            anen_pais,
                            anen_estado,
                            anen_cidade,
                            anen_bairro,
                            anen_logradouro,
                            anen_numero,
                            anen_complemento,
                            anen_cep,
                            anen_data_cadastro,
                            anim_id
                        )
                VALUES 
                        (
                            '$anen_pais',
                            '$anen_estado',
                            '$anen_cidade',
                            '$anen_bairro',
                            '$anen_logradouro',
                             $anen_numero,
                            '$anen_complemento',
                             $anen_cep,
                            NOW(),
                            $id_animal->anim_id
                        )";
    //echo $sql4;
    $c2 = mysqli_query($conn, $sql4);





header('location:consulta_animais.php');

?>