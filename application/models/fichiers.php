<?php
class Fichiers extends CI_Model{
    private $table = "fichiers";

    public function add_file($nom, $extension, $size, $id_users){
        if(empty($nom) AND empty($extension) AND empty($size) AND empty($id_users)) return false;
        if($this->file_is_exist($nom, $extension, $id_users)) return false;
        $requete = "INSERT INTO fichiers (nom_fichier, extension, size, id_users) VALUES ('".$nom."','".$extension."',".$size.", ".$id_users.");";
        return $this->db->query($requete);
    }

    public function get_all($id){
        if(empty($id))return FALSE;
        $requete = "SELECT * FROM fichiers WHERE id_users = ".$id;
        return $this->db->query($requete);
    }

    public function file_is_exist($nom, $extension, $id_users){
        $query = "SELECT * FROM fichiers WHERE (nom_fichier LIKE '".$nom."') AND (extension LIKE '".$extension."') AND (id_users=".$id_users.")";
        $resultat = $this->db->query($query);
        if($resultat->num_rows()>0) return true;
        else return false;
    }

    public function get_files_in($id, $path="", $order, $asc){
        $requete = "SELECT * FROM fichiers WHERE ";
        if($path!="") $requete .= "(nom_fichier LIKE '".$path."/%') AND ";
        $requete .= "(id_users = ".$id.") ORDER BY ".$order."  ".$asc.",  nom_fichier asc";
        $resultat = $this->db->query($requete)->result();

        $dirpath = "assets/uploads/".$id;
        if($path!="") $dirpath .= "/".$path;
        $list_file = scandir($dirpath);

        $data = array();
        //Comparer les fichier tourver dans le BD et dans le dossier
        foreach($resultat as $row){
            if($path=="")$regex = "##";
            else $regex = "#^".$path."/#";
            
            if($row->extension=="dossier") $file = $row->nom_fichier;
            else $file = $row->nom_fichier;//.".".$row->extension;
            //echo "File = ".$file."<br>";
            $nom_file = $row->nom_fichier;
            if(preg_match($regex, $nom_file)){
                foreach($list_file as $item){
                    //Si le $path n'est pas vide, on ajoute le chemin
                    if($path!="") $nom_item = $path."/".$item;
                    else $nom_item = $item;

                    if($file==$nom_item){        
                        //echo "Nom item dans le dossier = ".$nom_item."<br>";
                        //Enlever les chemins pour l'affichage
                        $nom_file = str_replace($path."/", "", $nom_file);
                        $fichier["id_fichiers"] = $row->id_fichiers;
                        $fichier["nom"] = $nom_file;
                        $fichier["extension"] = $row->extension;
                        $fichier["size"] = $row->size;
                        $fichier["date_add"] = $row->date_add;
                        $data[] = $fichier;
                        break;
                    }
                }
            }
        }

        return $data;
    }

    public function get_file($id_fichiers){
        if(empty($id_fichiers))return FALSE;
        $requete = "SELECT * FROM fichiers WHERE id_fichiers = ".$id_fichiers;
        return $this->db->query($requete)->row();
    }

    public function get_dossier_id($lien){
        //if(empty($lien))return FALSE;
        if($lien=="") {
            return "";
        }
        $requete = "SELECT * FROM fichiers WHERE extension LIKE 'dossier' AND nom_fichier LIKE \"".$lien."\"";
        $row = $this->db->query($requete)->row();
        return $row->id_fichiers;
        
        //return "SELECT * FROM fichiers WHERE extension=='dossier' AND nom_fichier = ".$lien;
    }

    public function delete_files($id_users, $liste, $path){
        if(sizeof($liste)<=0) return false;
        foreach($liste as $id){
            //Recuperer les fichiers qui ont l'id à supprimer
            $id_fichiers = intval($id);
            $file = $this->get_file($id_fichiers);
            
            //Si le fichier est un dossier, on supprime tout les fichier contenue dans le dossier
            if($file->extension=="dossier"){
                if($path=="") $lien = $file->nom_fichier;
                else $lien = $path."/".$file->nom_fichier;
                
                //$data = $this->get_files_in($id_users, $lien, "nom_fichier", "asc");
                $req = "SELECT * FROM fichiers WHERE nom_fichier LIKE '".$lien."/%' AND id_users = '".$id_users."'";
                $resultat = $this->db->query($req)->result();

                foreach($resultat as $row){
                    $req_del = "DELETE FROM fichiers WHERE id_fichiers = ".$row->id_fichiers;
                    $this->db->query($req_del);
                }
                
            }

            //Supression dans le BD
            $requete = "DELETE FROM fichiers WHERE id_fichiers = ".$id;
            $this->db->query($requete);

            //Supression dans le dossier d'upload
            $delete_file = 'assets/uploads/'.$this->session->userdata("id");
            $delete_file .= "/".$file->nom_fichier;
            if($file->extension!="dossier") {
                unlink($delete_file);
            }
            else {
                delete_dir($delete_file);
            }
        }
        return true;
    }

    public function get_list_file($id_users, $liste, $path){
        if(sizeof($liste)<=0) return false;
        $data = array();
        foreach($liste as $id){
            $id_fichiers = intval($id);
            $file = $this->get_file($id_fichiers);

            $data[] = $file;
        }
        return $data;
    }
}
?>