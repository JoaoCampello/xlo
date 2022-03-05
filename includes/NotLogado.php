<?php
if (!isset($_SESSION['Login'])) {

	echo '<script> window.onload=function(){
				  document.getElementById("loginbtnoff").click();
					}; </script>';
	die("
	<br><br>
  <div class='section-title' align='center'>
    <p>Você precisa estar logado para ver esta pagina!</p>
  </div>
	");
}
