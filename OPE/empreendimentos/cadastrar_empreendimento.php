
<?php 

include_once '../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 01:34:11 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-07 00:51:04
 */

 include_once ROOT_PATH .'mysql_conexao/conexao_mysql.php';
session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:'.$server_static.'index.php');
    }
 

$foto = $_FILES["logo"];    
$logado = $_SESSION['login'];
$grup_id = $_SESSION['grup_id'];
$logi_id = $_SESSION['logi_id'];
//var json_geolocalizacao

//var_dump($foto);

$empr_nome = ($_POST['nome']) ? $_POST['nome'] : "";
$empr_cnpj = ($_POST['cnpj']) ? $_POST['cnpj'] : "";
$empr_dt_abertura = ($_POST['data_abertura']) ? $_POST['data_abertura'] : "";
$empr_objetivo = ($_POST['objetivo']) ? $_POST['objetivo'] : "";
$empr_slogan = ($_POST['slogan']) ? $_POST['slogan'] : "";
$empr_responsavel = ($_POST['responsavel']) ? $_POST['responsavel'] : "";

//enderecos
$emen_pais = ($_POST['pais']) ? $_POST['pais'] : "";
$emen_estado = ($_POST['estado']) ? $_POST['estado'] : "";
$emen_cidade = ($_POST['cidade']) ? $_POST['cidade'] : "";
$emen_bairro = ($_POST['bairro']) ? $_POST['bairro'] : "";
$emen_logradouro = ($_POST['logradouro']) ? $_POST['logradouro'] : 0;
$emen_numero = ($_POST['numero']) ? $_POST['numero'] : 0;
$emen_complemento = ($_POST['complemento']) ? $_POST['complemento'] : 0;
$emen_cep = ($_POST['cep']) ? $_POST['cep'] : 0;

//substituição de espaço em branco por +
$geo_logradouro = str_replace(" ","+",$emen_logradouro);
$geo_cidade =  str_replace(" ","+",$emen_cidade);
$geo_bairro =  str_replace(" ","+",$emen_bairro);

//var json_geolocalizacao
$str = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=$geo_logradouro,+$geo_cidade,+$emen_pais&key=AIzaSyC1nkX5KVBXgDHas0sYoCXqws8MzKCWBcQ");
$json = json_decode($str, true);

$lat = ($json["results"][0]["geometry"]['location']['lat']);
$lng = ($json["results"][0]["geometry"]['location']['lng']);

$query= " SELECT empr_id from login_x_empreendimentos where logi_id= $logi_id";
//echo $query;
$result = mysqli_query($conn, $query);
$row2 = mysqli_fetch_object($result);

if(empty($row2)){

    $sql2 = "   INSERT INTO 
                    empreendimentos 
                        (
                            empr_nome,
                            empr_cnpj,
                            empr_dt_abertura,
                            empr_objetivo,
                            empr_slogan,
                            empr_responsavel,
                            empr_status,
                            empr_data_cadastro   
                        )
                VALUES 
                        (
                            '$empr_nome',
                            '$empr_cnpj',
                            '$empr_dt_abertura',
                            '$empr_objetivo',
                            '$empr_slogan',
                            '$empr_responsavel',
                            0,
                            NOW()
                        )";
    //echo $sql2;
    $c2 = mysqli_query($conn, $sql2);

    $query= " SELECT max(empr_id) as empr_id from empreendimentos";
    //echo $query;
    $result = mysqli_query($conn, $query);
    $row2 = mysqli_fetch_object($result);

    $sql3 = "   INSERT INTO 
                    login_x_empreendimentos 
                        (
                            logi_id,
                            empr_id,
                            grup_id   
                        )
                VALUES 
                        (
                            $logi_id,
                            $row2->empr_id,
                            $grup_id
                        )";
    //echo $sql3;
    $c3 = mysqli_query($conn, $sql3);
    //echo $sql2;


   

}
else{
    $sql2 = "   UPDATE 
                    empreendimentos 
                SET   
                    empr_nome = '$empr_nome',
                    empr_cnpj = '$empr_cnpj',
                    empr_dt_abertura = '$empr_dt_abertura',
                    empr_objetivo =  '$empr_objetivo',
                    empr_slogan = '$empr_slogan',
                    empr_responsavel = '$empr_responsavel',
                    empr_data_atualizacao = NOW()   
                        
                WHERE 
                    empr_id = $row2->empr_id";
    $c3 = mysqli_query($conn, $sql2);
    //echo $sql2;
}
//Salvar endereco do empreendimento
$query= " SELECT empr_id from empreendimentos_enderecos where empr_id = $row2->empr_id";
//echo $query;
$result = mysqli_query($conn, $query);
$row3 = mysqli_fetch_object($result);

if(empty($row3)){    
    $sql4 = "   INSERT INTO 
                    empreendimentos_enderecos 
                        (
                            emen_pais,
                            emen_estado,
                            emen_cidade,
                            emen_bairro,
                            emen_logradouro,
                            emen_numero,
                            emen_complemento,
                            emen_cep,
                            emen_data_cadastro,
                            empr_id,
                            emen_longitude,
                            emen_latitude 
                        )
                VALUES 
                        (
                            '$emen_pais',
                            '$emen_estado',
                            '$emen_cidade',
                            '$emen_bairro',
                            '$emen_logradouro',
                            $emen_numero,
                            '$emen_complemento',
                            $emen_cep,
                            NOW(),
                            $row2->empr_id,
                            $lat,
                            $lng
                        )";
    //echo $sql4;
    $c2 = mysqli_query($conn, $sql4);
}else{
    //continuar daqui 

    $sql2 = "   UPDATE 
                    empreendimentos_enderecos 
                SET   
                    emen_pais = '$emen_pais',
                    emen_estado = '$emen_estado',
                    emen_cidade = '$emen_cidade',
                    emen_bairro =  '$emen_bairro',
                    emen_logradouro = '$emen_logradouro',
                    emen_numero = '$emen_numero',
                    emen_complemento = '$emen_complemento',
                    emen_cep = '$emen_cep',
                    emen_data_atualizacao = NOW(),
                    emen_longitude = $lat,
                    emen_latitude = $lng   
                        
                WHERE 
                    empr_id = $row2->empr_id";
   // echo $sql2;
    $c3 = mysqli_query($conn, $sql2);

}
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
    }*/

    // Se não houver nenhum erro
    if (count($error) == 0) {
    
        // Pega extensão da imagem
        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

        // Gera um nome único para a imagem
        $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

        // Caminho de onde ficará a imagem
        $caminho_imagem = "logo_empresas/" . $nome_imagem;

        // Faz o upload da imagem para seu respectivo caminho
        move_uploaded_file($foto["tmp_name"], $caminho_imagem);
    
        $sql_verifica ="SELECT
                            emim_id
                        FROM 
                            empreendimentos_imagens
                        WHERE
                            empr_id = $row2->empr_id
                        ";
        $v = mysqli_query($conn, $sql_verifica);
        $row4 = mysqli_fetch_object($v);
        if(empty($row4)){
        // Insere os dados no banco
            $sql = "INSERT INTO 
                        empreendimentos_imagens
                            (
                                emim_endereco, 
                                emim_data_cadastro, 
                                empr_id
                            ) 
                        VALUES 
                            (
                                '".$caminho_imagem."', 
                                NOW(),
                                $row2->empr_id
                            )
                    ";
            $c3 = mysqli_query($conn, $sql);
        }else{
            $sql = "    UPDATE 
                            empreendimentos_imagens 
                        SET  
                            
                                emim_endereco = '".$caminho_imagem."', 
                                emim_data_atualizacao = NOW() 
            
                             
                        WHERE empr_id = $row2->empr_id
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
         



header('location:..\empreendimentos\home_empreendimento.php');
?>
