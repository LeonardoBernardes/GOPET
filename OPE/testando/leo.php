<?php
$var = "vzssd";
?>

<html>
<h1>Hello</h1>
<div id="teste">
</div>

</html>

<script>

document.getElementById("teste").innerHTML = '<?php echo $var ?>' ;

</script>