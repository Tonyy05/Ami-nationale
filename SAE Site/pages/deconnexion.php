<?php
if(!session_id()){
    session_start();
}
$_SESSION["current_page"]="deconnexion";
$_SESSION["role"] = null;
unset($_SESSION["email"]);
unset($_SESSION["user_id"]);
require_once "success.php";
?>