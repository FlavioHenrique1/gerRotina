<?php
date_default_timezone_set('America/Sao_Paulo');
header("Content-Type: text/html; charset=utf-8; application/json");
// header("Content-Type: application/json; charset=utf-8");

include("config/config.php");
include(DIRREQ."lib/vendor/autoload.php");
include(DIRREQ."helpers/variables.php");
$dispatch=new Classes\ClassDispatch();
include($dispatch->getInclusao());

