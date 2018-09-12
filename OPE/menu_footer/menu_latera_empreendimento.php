<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    font-family: "Lato", sans-serif;
}
#navbar {
  overflow: hidden;
  background-color: #333;
}

#navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

#navbar a:hover {
  background-color: #ddd;
  color: black;
}

#navbar a.active {
  background-color: #4CAF50;
  color: white;
}


.sidenav {
    width: 160px;
    height:100%;
    position: fixed;
    z-index: 1;
    top: 10px;
    background: #eee;
    overflow-x: hidden;
    padding: 8px 0;
}

.sidenav a {
    padding: 10px 8px 30px 16px;
    text-decoration: none;
    color: #2196F3;
    display: block;
}

.sidenav a:hover {
    color: #064579;
}

.main {
    margin-left: 140px; /* Same width as the sidebar + left position in px */
    font-size: 28px; /* Increased text to enable scrolling */
    padding: 0px 10px;
}

.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .content {
  padding-top: 60px;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
</style>

</head>

<body>
<?php 
if ($_SESSION['grup_id'] == 4){
    
echo '
<nav class="sidenav navbar navbar-light bg-light nav_bar_empreendimento">
<ul class="navbar-nav mr-auto">
<li class="nav-item">
    <a class="nav-link" href="#">Dados</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Meus Animais</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Produtos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Serviços</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Eventos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Minhas Doações</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Favoritos</a>
    </li>
</ul>
</nav>
';}    
?>

   

</body>

</html> 
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>