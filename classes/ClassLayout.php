<?php
namespace Classes;

class ClassLayout{

    public static function setHeadRestrito($permition)
    {
        $session=new ClassSessions();
        $session->verifyInsideSession($permition);
    }

    #Setar as tags do head
    public static function setHeader($title,$description, $author='Flávio')
    {

        $html="<!DOCTYPE html>\n";
        $html.="<html lang='pt-br'>\n";
        $html.="<head>\n";
        $html.="    <meta charset='UTF-8'>\n";
        $html.="    <meta http-equiv='X-UA-Compatible' content='IE=edge'>\n";
        $html.="    <meta name='viewport' content='width=device-width, initial-scale=1.0'>\n";
        $html.="    <meta name='author' content='$author'>\n";
        $html.="    <meta name='format-detection' content='telephone=no'>\n";
        $html.="    <meta name='description' content='$description'>\n";
        $html.="    <title>$title</title>\n";
        #FAVICON
        $html.="<link rel='stylesheet' href='".DIRCSS."bootstrap.min.css'>\n";
        $html.="<link rel='stylesheet' href='".DIRCSS."style.css'>\n";
        $html.="</head>\n\n";
        $html.="<body>\n";
        echo $html;

    }
    
    #Setar as tags do footer
    public static function setFooter()
    {
        $html="<script src='".DIRJS."zepto.min.js'></script>\n";
        $html.="<script src='".DIRJS."vanilla-masker.min.js'></script>\n";
        $html.="<script src='".DIRJS."javascript.js'></script>\n";
        $html.="<script src='".DIRJS."bootstrap.min.js'></script>\n";
        $html.="<script src='".DIRJS."bootstrap.bundle.min.js'></script>\n";
        
        
        #JAVASCRIPT
        $html.="</body>\n";
        $html.="</html>";
        echo $html;
    }



}