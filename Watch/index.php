<?php
include_once 'configs/configs.php';
function __autoload($class){
    $file= strtolower(str_replace('_',DS,$class).EXT);
    if(file_exists('application'.DS.$file)){
        include_once 'application'.DS.$file;
    }else if(file_exists($file)){
        include_once $file;    
    }else{
        echo "File ".$file." not exists!";
    }
}
new Libs_Bootstrap();
