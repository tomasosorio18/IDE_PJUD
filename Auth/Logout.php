<?php
// clear all the session variables and redirect to index
session_start();
session_unset();
session_write_close();
session_destroy();
$url = "../Index.php";
header("Location: $url"."?sesion=sesionfin");
