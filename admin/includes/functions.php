<?php


function ClassAotuLoad($class) {

    $class = strtolower($class);

    $the_path = "includes/{$class}.php";

    if(file_exists($the_path)) {
        require_once($the_path);
    }else{
        die("the file {$class}.php was no man......");
    }



}


spl_autoload_register("ClassAotuLoad");


function redirect($location) {
    header("location: {$location}");
}



?>