<head>
    
    <!-- Icone da Pagina & Titulo -->
    <link rel="icon" href="../static/imagens/icon_preto.png">
    <title>GoPet</title>
   
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.css">
    
    <!--icones legais para colocar no site https://fontawesome.com/icons?d=gallery -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    
    <!-- GOPET CSS -->
        <link rel="stylesheet" href="../static/estilo.css">
    
    
</head>
       

       
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand logo" href="#" ><img src="../static/imagens/gopet.png" alt="gopet"></a>
        <!-- quando a tela ficar menor irá aparecer um botão -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                
                 <?php   if($_SESSION['grup_id'] == 4){ ?>
                   <li class="nav-item">
                    <a class="nav-link" href="..\empreendimentos\cadastro_empreendimentos.php">Dados</a>
                    </li>
                    <li class="nav-item">                    
                    <a class="nav-link" href="..\empreendimentos\funcionarios\cadastro_funcionarios.php">Cadastrar funcionários</a>
                    </li>
                    <li class="nav-item">     
                    <a class="nav-link" href="..\empreendimentos\funcionarios\consultar_funcionarios.php">Consultar funcionários</a>
                    </li>
        <?php   } ?>

    <?php   if($_SESSION['logi_status'] == 1){ 

                if(!empty($row2)){
            
            ?>       
                    <li class="nav-item">  
                    <a class="nav-link" href="..\empreendimentos\produtos\cadastro_produtos.php">Cadastrar Produtos</a>
                    </li>
                    <li class="nav-item">  
                    <!-- Só exibir se tiver um cadastro ativo (Farei depois) -->
                    <a class="nav-link" href="..\empreendimentos\produtos\consultar_produtos.php">Consultar Produtos</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="..\empreendimentos\servicos\cadastro_servicos.php">Cadastrar Serviços</a>
                    <!-- Só exibir se tiver um cadastro ativo (Farei depois) -->
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="..\empreendimentos\servicos\consultar_servicos.php">Consultar Serviços</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="..\empreendimentos\eventos\cadastro_eventos.php">Cadastrar Eventos</a>
                    </li>
                    <li class="nav-item">
                    <!-- Só exibir se tiver um cadastro ativo (Farei depois) -->
                    <a class="nav-link" href="..\empreendimentos\eventos\consultar_eventos.php">Consultar Eventos</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="..\animais\cadastro_animais.php">Cadastrar Animais</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="..\animais\consultar_animais.php">Consultar Animais</a>
                    </li>
                    

                    <?php 
                }
            } ?>
                    
                    <li class="nav-item active">
                    <a class="nav-link" href="..\logaut.php">Logaut</a>
                    </li>
            </ul>
            </div>
            </nav>