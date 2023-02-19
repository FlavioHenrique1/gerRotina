<?php 
#Caminhos absolutos
$pastaInterna="Qualidade/";
define('DIRPAGE',"http://{$_SERVER['HTTP_HOST']}/{$pastaInterna}");

(substr($_SERVER['DOCUMENT_ROOT'],-1)=='/')?$barra="":$barra="/";
define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}{$barra}{$pastaInterna}");

#Atalhos
define('DIRIMG',DIRPAGE.'img/');
define('DIRCSS',DIRPAGE.'lib/css/');
define('DIRJS',DIRPAGE.'lib/js/');
define('DIRCONT',DIRPAGE.'controllers/');

#Acesso ao BD
define('HOST',"localhost");
define('BD',"sistemaQuali");
define('USER',"root");
define('PASS',"");

#Informações do servidor de email
define("HOSTMAIL","smtp.office365.com");
define("USERMAIL","");
define("PASSMAIL","");


#Outras Informações
define("DOMAIN",$_SERVER["HTTP_HOST"]."/".$pastaInterna);
