<?php
if(!defined('BASEPATH')) exit('NO direct script acces allowed');

if(!function_exists('get_alphabet')){
    function get_alphapet(){
        return "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ 0123456789";
    }
}

if(!function_exists('isAplhabet')){
    function isAplhabet($c){
        $alphabet = get_alphapet();
        for($i=0; $i<strlen($alphabet); $i++){
            if($alphabet[$i]==$c)
            return true;
        }
        return false;
    }
}

if(!function_exists('tochiffre')){
    function tochiffre($c){
        $alphabet = get_alphapet();
        for($i=0; $i<strlen($alphabet); $i++){
            if($alphabet[$i]==$c)
            return $i;
        }
        return -1;
    }
}

if(!function_exists('tolettre')){
    function tolettre($i){
        $alphabet = get_alphapet();
        while($i<0){
            $i+=strlen($alphabet);
        }
        $code = $i%strlen($alphabet);
        return $alphabet[$code];
    }    
}

if(!function_exists('generate_cle')){
    function generate_cle($id){
        $alphabet = get_alphapet();
        $tableau5 = "sRbJpZcGuLwDtNoQeVhKaXfYiMSrBjPzCgUlWdTnOqEvHkAxFyIm";
        $tableau2 = "qZxDrVgYnJkLmAwSeCfTbHuIoPQzXdRvGyNjKlMaWsEcFtBhUiOp";
        $tableau3 = "zErTyUkPqSdFgHjOmWxCvBnIlaZeRtYuKpQsDfGhJoMwXcVbNiLA";
    
        $id = intval($id);
        $reste = intval($id)%strlen($tableau2);
    
        $cle = "";
        $k0 = 1;
        while(strlen($cle)<109){
            $k1 = tochiffre($tableau2[$reste])+tochiffre($tableau3[$reste])+tochiffre($tableau5[$reste]);
            $k2 = $id*$id+$k1*$k1+$k0;
            $k3 = $id*$k1*$k2*$k0;
            $k4 = $id+$k1+$k2+$k3+$k0;
            $char = $k4%strlen($alphabet);
            $cle .= tolettre($char);
            $k0 += $id;
            $reste = $k4%strlen($tableau2);
        }
        return $cle;
    }

}

if(!function_exists('cryptage_de_cesar_n')){
    function cryptage_de_cesar_n($mot){
        $decalage = strlen($mot);
        $resultat = "";
        for($i=0; $i<$decalage;$i++){
            $char = $mot[$i];
            if(isAplhabet($char)){
                $char_chiffre = tochiffre($char);
                $chiffre_final = $char_chiffre+$decalage;
                $char_final = tolettre($chiffre_final);
                $resultat .= $char_final;
            }
            else{
                $resultat .= $char;
            }
        }
        return $resultat;
    }
}

if(!function_exists('decryptage_de_cesar_n')){
    function decryptage_de_cesar_n($mot){
        $resultat = "";
        $decalage = strlen($mot);
        for($i=0; $i<$decalage; $i++){
            $char = $mot[$i];
            if(isAplhabet($char)){
                $char_chiffre = tochiffre($char);
                $chiffre_final = $char_chiffre-$decalage;
                $char_final = tolettre($chiffre_final);
                $resultat .= $char_final;
            }
            else{
                $resultat .= $char;
            }
        }
        return $resultat;
    }
}

if(!function_exists('cryptage_vigenere')){
    function cryptage_vigenere($mot, $id){
        $cle = generate_cle($id);
        $rep_cle = intval(strlen($mot)/strlen($cle));
        $reste = strlen($mot)%strlen($cle);
        $cle_complet = str_repeat($cle, $rep_cle).substr($cle, 0, $reste);
        
        $resultat = "";
        for($i=0; $i<strlen($mot); $i++){
            $char = $mot[$i];
            if(isAplhabet($char)){
                $char_cle = $cle_complet[$i];
                $decalage = tochiffre($char_cle);
    
                $code_char = tochiffre($char);

                $code_final = $code_char+$decalage;
                $lettre_final = tolettre($code_final);
                $resultat .= $lettre_final;
            }
            else{
                $resultat .= $char;
            }
        }
        return $resultat;
    }
}

if(!function_exists('decryptage_vigenere')){
    function decryptage_vigenere($mot, $id){
        $cle = generate_cle($id);
        $rep_cle = intval(strlen($mot)/strlen($cle));
        $reste = strlen($mot)%strlen($cle);
        $cle_complet = str_repeat($cle, $rep_cle).substr($cle, 0, $reste);
        
        $resultat = "";
        for($i=0; $i<strlen($mot); $i++){
            $char = $mot[$i];
            if(isAplhabet($char)){
                $char_cle = $cle_complet[$i];
                $decalage = tochiffre($char_cle);
    
                $code_char = tochiffre($char);

                $code_final = $code_char-$decalage;
                $lettre_final = tolettre($code_final);
                $resultat .= $lettre_final;
            }
            else{
                $resultat .= $char;
            }
        }
        return $resultat;
    }
}

if(!function_exists('cryptage_de_beaufort')){
    function cryptage_de_beaufort($mot, $id){
        $cle = generate_cle($id);
        $rep_cle = intval(strlen($mot)/strlen($cle));
        $reste = strlen($mot)%strlen($cle);
        $cle_complet = str_repeat($cle, $rep_cle).substr($cle, 0, $reste);

        $resultat = "";
        for($i=0; $i<strlen($mot); $i++){
            $char = $mot[$i];
            if(isAplhabet($char)){
                $char_cle = $cle_complet[$i];
                $decalage = tochiffre($char_cle);
    
                $code_char = tochiffre($char);

                $code_final = $decalage-$code_char;
                $lettre_final = tolettre($code_final);
                $resultat .= $lettre_final;
            }
            else{
                $resultat .= $char;
            }
        }
        return $resultat;
    }
}

if(!function_exists('decryptage_de_beaufort')){
    function decryptage_de_beaufort($mot, $id){
        $cle = generate_cle($id);
        $rep_cle = intval(strlen($mot)/strlen($cle));
        $reste = strlen($mot)%strlen($cle);
        $cle_complet = str_repeat($cle, $rep_cle).substr($cle, 0, $reste);
        
        $resultat = "";
        for($i=0; $i<strlen($mot); $i++){
            $char = $mot[$i];
            if(isAplhabet($char)){
                $char_cle = $cle_complet[$i];
                $decalage = tochiffre($char_cle);
    
                $code_char = tochiffre($char);

                $code_final = $decalage-$code_char;
                $lettre_final = tolettre($code_final);
                $resultat .= $lettre_final;
            }
            else{
                $resultat .= $char;
            }
        }
        return $resultat;
    }
}

if(!function_exists("crypte_repete")){
    function crypte_repete($mot){
        $resultat = "";
        $length = strlen($mot);
        $mot = str_repeat($mot, intval(109/$length));
        $reste = 109%strlen($mot);
        $resultat = $mot.substr($mot, 0, $reste);
        $longueur = "";
        if($length<10000){
            $longueur = "0";
            if($length<1000){
                $longueur .= "0";
                if($length<100){
                    $longueur .= "0";
                    if($length<10){
                        $longueur .= "0";
                    }
                }
            }
        }
        $longueur .= $length;
        return $longueur.$resultat;
    }
}

if(!function_exists("decrypte_repete")){    
    function decrypte_repete($mot){
        $resultat = "";
        $longueur = intval(substr($mot, 0, 5));
        return substr($mot, 5, $longueur);
    }
}


if(!function_exists('crypte_text')){
    function crypte_text($texte, $cle){
        $resultat = crypte_repete($texte);
        $resultat = cryptage_de_beaufort($resultat, $cle);
        $resultat = cryptage_de_cesar_n($resultat);
        $resultat = cryptage_vigenere($resultat, $cle);
        return $resultat;
    }
}

if(!function_exists('decrypte_text')){
    function decrypte_text($texte, $cle){
        $resultat = decryptage_vigenere($texte, $cle);
        $resultat = decryptage_de_cesar_n($resultat);
        $resultat = decryptage_de_beaufort($resultat, $cle);
        $resultat = decrypte_repete($resultat);
        return $resultat;
    }
}
    

if(!function_exists('crypte_password')){
    function crypte_password(String $mot){  
        $tableau = "sRbJpZcGuLwDtNoQeVhKaXfYiMSrBjPzCgUlWdTnOqEvHkAxFyIm";      
        $lengthTableau = strlen($tableau);
        $resultat = "";
        $motRepeter = str_repeat($mot, 5);
        $cle = 0;
        for($i=0; $i<strlen($motRepeter); $i++){
            $cle += tochiffre($motRepeter[$i]);
            $cle = $cle%$lengthTableau;
            $resultat .= $tableau[$cle];
        }

        $resultat = substr($resultat, strlen($mot)*4);
        $resultatFinal = "";
        $cle = 0;
        for($i=0; $i<strlen($resultat); $i++){
            $cle += tochiffre($resultat[$i]);
            $cle = $cle%$lengthTableau;
            $resultatFinal .= $tableau[$cle];
        }
        $indice = 0;
        while(strlen($resultatFinal)<71){
            $cle += tochiffre($resultatFinal[$indice]);
            $indice++;
            $cle = $cle%$lengthTableau;
            $resultatFinal .= $tableau[$cle];
        }
        return $resultatFinal;
    }
}

if(!function_exists('crypte_files')){
    function crypte_files(String $file){
        $str_file = file_get_contents($file);
        $data_encode = base64_encode($str_file);
        $fi = fopen($file, "w");
        fwrite($fi, $data_encode);
        fclose($fi);
    }
}



if(!function_exists('decrypte_files')){
    function decrypte_file(String $filepath, $extension, $id){
        $tab = str_getcsv($filepath, "/");
        $nom_file = $tab[sizeof($tab)-1];
        $fichier = $filepath;//.".".$extension;
        $file_crypter = file_get_contents($fichier);
        $data_decode = base64_decode($file_crypter);
        if(file_exists("assets/uploads/".$id."/"."tmp.tmpfolder/".$nom_file.".".$extension)){
            unlink("assets/uploads/".$id."/"."tmp.tmpfolder/".$nom_file.".".$extension);
        }
        $file = fopen("assets/uploads/".$id."/"."tmp.tmpfolder/".$nom_file.".".$extension, "w");
        fwrite($file, $data_decode);
        fclose($file);
        return "assets/uploads/".$id."/"."tmp.tmpfolder/".$nom_file.".".$extension;
    }
}

?>