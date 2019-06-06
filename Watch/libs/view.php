<?php
class Libs_View {
    /**
     *Hàm xử lý sinh giao diện cho controller tương ứng 
     */
    public function render($name, $inc = true){
        if($inc){
            define('TEMPLATE','application'.DS.MODULE.DS.'views/'.$name.EXT);
            include_once 'templates'.DS.MODULE.DS.'index'.EXT;
        } else{
            include_once 'application'.DS.MODULE.DS.'views/'.$name.EXT;
        }
    }
}
?>
