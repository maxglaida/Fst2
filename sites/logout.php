<?php
$username = $_SESSION['username'];
if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    setcookie("username", "", time() - 3600);
    setcookie("password", "", time() - 3600);
}
echo ("<script language='JavaScript'>
       window.alert('Thank you for your visit, $username!')
       window.location.href='login.php';
       </script>");
session_destroy();