<?php
session_start();
session_unset();
session_destroy();
header('Location: ../../views/Auth/login.php');
exit;
?>
