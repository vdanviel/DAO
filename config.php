<?php

spl_autoload_register(function($classe){

    $filename = "class"."/".$classe.".php";

    if (file_exists($filename) == true) {
        require_once($filename);
    }

});

?>