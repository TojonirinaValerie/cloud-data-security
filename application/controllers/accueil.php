<?php
class Accueil extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('assets');
        $this->load->helper('crypteur');
        $this->load->database();
        $this->load->model('fichiers');

        if($this->input->post('succes')){
            $sess_data = array(
                'pseudo' => $this->input->post("pseudo"),
                'id' => $this->input->post("id"),
                'path' => ""
            );
            $this->session->set_userdata($sess_data);
        }
        
        if(!($this->session->userdata("pseudo"))){
            redirect(base_url().'signup');
        }
        ini_set("memory_limit", "-1");
    }

    public function index(){
        $this->mes_donnees();
    }

    public function mes_donnees($id_fichier=""){
        del_tmp($this->session->userdata("id"));
        //recuperer le chemin du dossier actuel
        if($id_fichier=="") $path = "";
        else {
            $dossier = $this->fichiers->get_file($id_fichier);
            $path = $dossier->nom_fichier;
        }
        
        //recuperer les contenues du dossier actuel
        $datas = $this->fichiers->get_files_in($this->session->userdata('id'),$path, "extension", "asc");
        $data = array();
        foreach($datas as $item){
            $fichier["id_fichiers"] = $item["id_fichiers"];
            $fichier["nom"] = decrypte_text($item["nom"], $this->session->userdata("id"));
            $fichier["extension"] = $item["extension"];
            $fichier["size"] = $item["size"];
            $fichier["date_add"] = $item["date_add"];
            $data[] = $fichier;
        }

        //recuperer le chemin de retour
        $tab = str_getcsv($path, "/");
        $retour = base_url()."/accueil/mes_donnees/";
        if(sizeof($tab)!=1){
            $res = "";
            for($i=0; $i<sizeof($tab)-1; $i++){
                $res .= $tab[$i];
                if($i+1<sizeof($tab)-1) $res .="/";
            }
            $retour = $this->fichiers->get_dossier_id($res);
        }

        $tab_path = str_getcsv($path, "/");
        $affiche_path = "";
        for($i=0; $i<sizeof($tab_path)-1; $i++){
            $affiche_path .= decrypte_text($tab_path[$i], $this->session->userdata("id"))."/";
        }
        $affiche_path .= decrypte_text($tab_path[sizeof($tab_path)-1], $this->session->userdata("id"));

        $array = array(
            "data" => $data,
            "path" => $path,
            "affiche_path" => $affiche_path,
            "retour"=> $retour
        );
        $this->session->set_userdata("retour", $retour);
        $this->session->set_userdata("path", $path);
        $this->load->view('mes_donnees', $array);
    }

    public function ouvrir($id_fichier=""){
        del_tmp($this->session->userdata("id"));
        
        if(empty($id_fichier)) redirect(base_url().'accueil/mes_donnees');
        $file = $this->fichiers->get_file($id_fichier);
        if(!$file) redirect(base_url().'accueil/mes_donnees');
        $src = "assets/uploads/".$this->session->userdata("id")."/";
        $src .= $file->nom_fichier;


        $src_file = decrypte_file($src, $file->extension, $this->session->userdata("id"));

        $tab_path = str_getcsv($this->session->userdata("path"), "/");
        $affiche_path = "";
        for($i=0; $i<sizeof($tab_path)-1; $i++){
            $affiche_path .= decrypte_text($tab_path[$i], $this->session->userdata("id"))."/";
        }
        $affiche_path .= decrypte_text($tab_path[sizeof($tab_path)-1], $this->session->userdata("id"));

        $tab_nom_file = str_getcsv($file->nom_fichier, "/");
        $file->nom_fichier = decrypte_text($tab_nom_file[sizeof($tab_nom_file)-1], $this->session->userdata("id"));

        /*
        $tmpretour = "";
        for($i=0; $i<sizeof($tab_nom_file)-1; $i++){
            $tmpretour .= $tab_nom_file[$i];
            if($i!=sizeof($tab_nom_file)-1) $tmpretour .= "/";
        }
        */
        

        $array = array(
            "data" => $file,
            "path" => $this->session->userdata("path"),
            "affiche_path" => $affiche_path,
            "retour"=> $this->session->userdata("retour"),
            "src_file" => $src_file
        );
        $this->load->view("ouvrir", $array);
    }

    public function uploads(){
        if($this->input->post('upload')){
            if(isset($_FILES['fichier']) AND $_FILES['fichier']['error']==0){
                $info = pathinfo($_FILES['fichier']['name']);
                $nom =  htmlspecialchars($info['filename']);
                $nom = crypte_text($nom, $this->session->userdata("id"));
                $nombd = str_replace("'", "''", $nom);
                $extension = htmlspecialchars($info['extension']);
                $size = intval($_FILES['fichier']['size']);
                $id_users = intval($this->session->userdata('id'));
                if($this->session->userdata("path")=="")$nom_file = $nombd;
                else $nom_file = $this->session->userdata("path")."/".$nombd;
                if($this->fichiers->add_file($nom_file, $extension, $size,$id_users)){
                    move_uploaded_file($_FILES['fichier']['tmp_name'], 'assets/uploads/'.$this->session->userdata("id").'/'.$this->session->userdata("path")."/".$nom);//.'.'.$extension);
                    crypte_files("assets/uploads/".$this->session->userdata('id')."/".$this->session->userdata("path")."/".$nom);//.".".$extension);
                    echo "Donne bien enregistrer";
                    redirect(base_url().'accueil/mes_donnees/'.$this->fichiers->get_dossier_id($this->session->userdata('path')));
                }
                else{
                    echo "Il y a une erreur";
                }
            }
            else{
                echo "Erreur2";
            }
        }
        else {
            echo "Erreur";
        }
        
    }

    public function deconnexion(){
        $this->session->unset_userdata('pseudo');
        redirect(base_url().'signup');
    }

    public function new_folder($nom_folder){
        $nom = str_replace("~", " ", $nom_folder);
        $nom = crypte_text($nom, $this->session->userdata("id"));
        if(file_exists("assets/uploads/".$this->session->userdata("id")."/".$this->session->userdata("path")."/".$nom) AND is_dir("assets/uploads/".$this->session->userdata("id")."/".$nom)){
            echo "1";
        }
        else{
            if($this->session->userdata("path")!=""){
                $nom_fichier = $this->session->userdata("path")."/".$nom;
            }
            else{
                $nom_fichier = $nom;
            }
            if($this->fichiers->add_file($nom_fichier, "dossier", 0, intval($this->session->userdata('id')))){
                mkdir("assets/uploads/".$this->session->userdata("id")."/".$this->session->userdata("path")."/".$nom, 0777);
                //redirect(base_url()."accueil/mes_donnees/".$this->session->userdata("path"));
            }
            else echo "2";
        }
    }

    public function supprimer_files($liste){
        $liste = str_getcsv($liste, "-");
        if($resultat = $this->fichiers->delete_files($this->session->userdata('id'), $liste, $this->session->userdata("path"))) {
            redirect(base_url()."accueil/mes_donnees/".$this->fichiers->get_dossier_id($this->session->userdata('path')));
        }
        else echo $resultat;
    }

    public function get_liste_file($liste){
        $liste = str_getcsv($liste, "-");
        $data = $this->fichiers->get_list_file($this->session->userdata('id'), $liste, $this->session->userdata("path"));
        
        $result = '{';
        $cpt = 0;
    
        for($i=0; $i<sizeof($data); $i++){

            if($cpt!=0) $result .= ', ';
            if($data[$i]->extension=="dossier"){
                $result .= '"file'.$cpt.'" : "'.decrypte_text($data[$i]->nom_fichier, $this->session->userdata("id")).'"';
            }
            else{
                $tab_nom_file = str_getcsv($data[$i]->nom_fichier,"/");
                $nom_file = decrypte_text($tab_nom_file[sizeof($tab_nom_file)-1], $this->session->userdata("id"));
                $result .= '"file'.$cpt.'" : "'.$nom_file.'.'.$data[$i]->extension.'"';
            }
            
            $cpt++;
        }
        $result .= "}";

        echo $result;
    }

    public function categories($type){
        $all = $this->fichiers->get_all($this->session->userdata("id"))->result();
        
        $data = array();
        foreach($all as $item){
            if(get_type($item->extension)==$type){
                $tab_nom = str_getcsv($item->nom_fichier, "/");
                $fichier["id"] = $item->id_fichiers;
                $fichier["nom_fichier"] = decrypte_text($tab_nom[sizeof($tab_nom)-1], $this->session->userdata('id'));
                $fichier["nom_crypter"] = $item->nom_fichier;
                $fichier["extension"] = $item->extension;
                $fichier["date_add"] = $item->date_add;
                $fichier["size"] = $item->size;
                $data[] = $fichier;
            }
        }

        $array = array(
            "data" => $data,
            "len" => sizeof($data)
        );

        $this->session->set_userdata("path", "");
        $this->session->set_userdata("retour", base_url().'accueil/categories/'.$type);
        $this->load->view("categories", $array);
    }

}
?>