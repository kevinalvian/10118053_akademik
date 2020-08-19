<?php
@session_start();

session_destroy();

header("location: /TubesBasdat2/index.php");
?>
