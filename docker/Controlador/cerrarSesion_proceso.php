<?php
//Comprobar si el usuario ha iniciado sesión
session_start();
//Y se cierra la sesión
session_destroy();
header("Location: ../Vista/index.php?");
exit();
