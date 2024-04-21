<?php
session_start();
session_unset();
session_destroy();
header("Location: http://localhost/projectNO2/Admin/admin_login.php");
exit;
?>