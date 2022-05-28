<?php
include 'function/function.php';
$mbox = imap_open(list_folder()[0][0], "tananakinigor98@gmail.com", "uvogewkltnfpuwye") or die("can't connect: " . imap_last_error());	
imap_delete($mbox, $_GET["mail"]);
//var_dump($_GET["mail"]);
header("Location: https://linemail.sytes.net/testmail/index.php?inbox=0");