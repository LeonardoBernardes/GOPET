<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-09-04 19:14:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-05 21:33:39
 */

include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');
session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:index.php');
    }
 

//$foto = $_FILES["logo"];    
$logado = $_SESSION['login'];
$grup_id = $_SESSION['grup_id'];
$logi_id = $_SESSION['logi_id'];


 
?>
<form method="post" action="cadastrar_animais.php?logi_id=<?php echo $logi_id ?>&grupo=<?php echo $grup_id ?>" id="formlogin" name="formlogin" >
    <fieldset id="fie">
        <legend>Cadastrar Animal</legend><br/>

        <input type="radio" name="tipo_cadastro" value="resgate"> Resgate
        <input type="radio" name="tipo_cadastro" value="doacao"> Doação
        <input type="radio" name="tipo_cadastro" value="proprio"> Próprio
        <br/>
        
        <label>Imagem 1: </label> 
            <img src="" style="width:400px; heigth:50px;" alt='Foto de exibição' /><br />
        <input type="file" name="imagem1" id="imagem1" > <br/>

        <label>Imagem 2: </label> 
            <img src="" style="width:400px; heigth:50px;" alt='Foto de exibição' /><br />
         <input type="file" name="imagem2" id="imagem2" > <br/>

        <label>Imagem 3: </label> 
            <img src="" style="width:400px; heigth:50px;" alt='Foto de exibição' /><br />
        <input type="file" name="imagem3" id="imagem3" > <br/>


        <label>Nome / Apelido : </label> 
        <input type="text" name="nome" id="nome"><br/>
        <label>Ra : </label> 
        <input type="text" name="ra" id="ra"><br/>
        <label>Idade : </label> 
        <input type="text" name="idade" id="idade"><br/>
        <label>Porte : </label> 
        <select name="porte">
            <option value="mini">Mini</option>
            <option value="pequeno">Pequeno</option>
            <option value="medio">Médio</option>
            <option value="grande">Grande</option>
            <option value="xgrande">Muito Grande</option>
        </select> 
        <br/>
        <label>Gênero : </label>
        <input type="radio" name="genero" value="femea"> Fêmea
        <input type="radio" name="genero" value="macho"> Macho
        <br/>
        <label>Categoria : </label> 
        <select name="categoria">
            <option value="cachorro">Cachorro</option>
            <option value="gato">Gato</option>
            <option value="coelho">Coelho</option>
            <option value="hamster">Hamster</option>
        </select> 
        <br/>
        <label>Restrição de Adoção : </label> 
        <input type="text" name="restricao" id="restricao">
        <br/>
        <label>Castrado : </label>
        <input type="radio" name="castracao" value="2"> NÃO INDENTIFICADO
        <input type="radio" name="castracao" value="1"> SIM
        <input type="radio" name="castracao" value="0"> NÃO
        <br/>     
        <fieldset id="fie">
            <legend>Endereço</legend><br/>
        
            <label>Pais : // só sigla </label> 
            <input type="text" name="pais" id="pais"><br/>
            <label>Estado : </label> // só sigla
            <input type="text" name="estado" id="estado"><br/>
            <label>Cidade : </label> 
            <input type="text" name="cidade" id="cidade"><br/>
            <label>Bairro : </label> 
            <input type="text" name="bairro" id="bairro"><br/>
            <label>Logradouro : </label> 
            <input type="text" name="logradouro" id="logradouro"><br/>
            <label>Número : </label> 
            <input type="text" name="numero" id="numero"><br/>
            <label>Complemento : </label> 
            <input type="text" name="complemento" id="complemento"><br/>
            <label>CEP : </label> 
            <input type="text" name="cep" id="cep"><br/>
        </fieldset>
        <input type="submit" value="CADASTRAR">
    </fieldset>
</form>