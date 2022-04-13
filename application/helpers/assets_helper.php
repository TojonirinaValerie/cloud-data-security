<?php
if(!defined('BASEPATH')) exit('NO direct script acces allowed');

if(!function_exists('css_url')){
    function css_url($nom){
        return base_url().'assets/css/'.$nom.'.css';
    }
}
if(!function_exists('img_url')){
    function img_url($nom){
        return base_url().'assets/images/'.$nom;
    }
}
if(!function_exists('js_url')){
    function js_url($nom){
        return base_url().'assets/js/'.$nom.'.js';
    }
}

if(!function_exists('get_type')){
    function get_type($extension){
        $extension_image = array("jpg", "jpeg", "png", "gif");
        $extension_video = array("mp4", "avi", "mpeg", "dat", "flv", "3gp", "webm", "mkv");
        $extension_audio = array("mp3", "aac");
        
        foreach($extension_image as $valeur){
            if(strtolower($extension)==$valeur) return "photo";
        } 
        foreach($extension_audio as $valeur){
            if(strtolower($extension)==$valeur) return "audio";
        }   
        foreach($extension_video as $valeur){
            if(strtolower($extension)==$valeur) return "video";
        }
        if(strtolower($extension)=="dossier") return "folder";
        return "docs";

    }
}

if(!function_exists("delete_dir")){
    function delete_dir($dir){
        $handle = opendir($dir);
        
        while($element = readdir($handle)){
            if(is_dir($dir.'/'.$element) && substr($element, -2, 2!=='..' && substr($element, -1, 1) !== '.')){
                delete_dir($dir.'/'.$element);
            }
            else{
                if(substr($element, -2, 2) !== ".." && substr($element, -1, 1) !=="."){
                    unlink($dir."/".$element);
                }
            }
        }
    
        $handle = opendir($dir);
        while($element = readdir($handle)){
            if(is_dir($dir."/".$element) && substr($element, -2, 2!=='..' && substr($element, -1, 1) !== '.')){
                delete_dir($dir.'/'.$element);
                rmdir($dir."/".$element);
            }
        }
        rmdir($dir);
    }
}

if(!function_exists("del_tmp")){
    function del_tmp($id){
        $dir = "assets/uploads/".$id."/tmp.tmpfolder";
        $liste = scandir($dir);
        foreach($liste as $item){
            if($item!="." AND $item!=".." AND !is_dir($item)) unlink($dir."/".$item);
        }
    }
}
?>