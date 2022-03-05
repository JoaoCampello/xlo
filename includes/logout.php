<?php
unset($_SESSION["Login"]);
session_destroy();
if(!isset($_SESSION["Login"]))
echo "<meta http-equiv=refresh content=0;URL=index.php?cmd=home>";
