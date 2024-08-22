<?php
session_start();

$_SESSEION = array(); 
if(isset($_COOKIE[session_name()]) == true){
    setcookie(session_name(),'',time() - 42000 ,'/');
}
session_destroy();
header('location:./');