<?php 
    //Autoload for autoloading all of the classes. 
    //Thanks to that, we can include only this one file which will include all classes automatically
    spl_autoload_register("autoload");

    function autoload($className) {
        $path = 'classes/';
        $ext = '.class.php';
        $filename = $path . $className . $ext;

        if(!file_exists($filename)) {
            return false;
        }   

        include_once $filename;
    }