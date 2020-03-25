<?php
namespace App\libs;

class Helper {


	public static function del_file($path,$img){

            if(is_file($path.$img)){
            	
                unlink($path.$img);

            } 
            
    }

	

}
