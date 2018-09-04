<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:51:19 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-04 19:14:09
 */

include_once(dirname( __FILE__ ) .'\..\..\mysql_conexao\conexao_mysql.php');
session_start();

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['grup_id']);
        header('location:index.php');
    }
 
$foto = $_FILES["imagem"]; 
$logado = $_SESSION['login'];
$logi_id = $_SESSION['logi_id'];


$even_nome = ($_POST['nome']) ? $_POST['nome'] : "";
$even_descricao = ($_POST['descricao']) ? $_POST['descricao'] : "";
$even_data_realizacao = ($_POST['data_realizacao']) ? $_POST['data_realizacao'] : "";
$even_status = ($_POST['status']) ? $_POST['status'] : 0;



//$empr_status = $_POST['status'] ? : "";


//Pega o id do empreendimento que esse usuário está atrelado
$sql2 = "SELECT
            empr_id
        FROM
            login_x_empreendimentos
        WHERE
            logi_id  = $logi_id   
    ";
$result = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_object($result);

//Insere o evento
$sql3 = "   INSERT INTO 
                eventos 
                    (
                        even_nome,
                        even_descricao,
                        even_data_realizacao,
                        even_status,
                        even_data_cadastro    
                    )
            VALUES 
                    (
                        '$even_nome',
                        '$even_descricao',
                        '$even_data_realizacao',
                         $even_status,
                         NOW()
                    )";
//echo $sql3;
$c2 = mysqli_query($conn, $sql3);

$query= " SELECT max(even_id) as even_id from eventos";
//echo $query;
$result = mysqli_query($conn, $query);
$row3 = mysqli_fetch_object($result);


$sql3 = "   INSERT INTO 
                empreendimentos_x_eventos 
                    (
                        empr_id,
                        even_id,
                        emev_data_cadastro   
                    )
            VALUES 
                    (
                        $row2->empr_id,
                        $row3->even_id,
                        NOW()
                    )";
//echo $sql3;
$c3 = mysqli_query($conn, $sql3);

/*
$query= " SELECT even_id, empr_id  from empreendimentos_x_eventos where even_id = $row3->even_id AND empr_id = $row2->empr_id";
echo $query;
$result = mysqli_query($conn, $query);
$row4 = mysqli_fetch_object($result);
*/
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
            $caminho_imagem = "eventos_imagens/" . $nome_imagem;
    
            // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($foto["tmp_name"], $caminho_imagem);
        
            $sql_verifica ="SELECT
                                evim_id
                            FROM 
                                eventos_imagens
                            WHERE
                                even_id = $row3->even_id
                            ";
                            echo $sql_verifica;
            $v = mysqli_query($conn, $sql_verifica);
            $row4 = mysqli_fetch_object($v);
    
            if(empty($row4)){
            // Insere os dados no banco
                $sql = "INSERT INTO 
                            eventos_imagens
                                (
                                    evim_endereco, 
                                    evim_data_cadastro, 
                                
                                    even_id
                                ) 
                            VALUES 
                                (
                                    '".$caminho_imagem."', 
                                    NOW(),
                                   
                                    $row3->even_id
                                )
                        ";
               
                $c3 = mysqli_query($conn, $sql);
            }else{
                $sql = "    UPDATE 
                                eventos_imagens 
                            SET 
                                evim_endereco = '".$caminho_imagem."', 
                                evim_data_atualizacao = NOW() 
                            WHERE 
                                even_id = $row4->even_id
                        ";
           
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


header('location:..\eventos\consultar_eventos.php');

?>