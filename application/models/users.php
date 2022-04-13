<?php
class Users extends CI_Model{
    private $table = "users";
    
    public function add_user($pseudo, $mdp, $mail){
        if(empty($pseudo) OR empty($mdp) OR empty($mail)) return false;
        if($this->pseudo_is_exist($pseudo)) return false;
        $requete = "INSERT INTO users (pseudo, mdp, mail) VALUES ('".$pseudo."','".$mdp."','".$mail."');";
        return $this->db->query($requete);
    }
    
    public function pseudo_is_exist($pseudo){
        $query = "SELECT * FROM users WHERE pseudo LIKE '".$pseudo."'";
        $resultat = $this->db->query($query);
        if($resultat->num_rows()>0) return true;
        else return false;
    }
    public function can_connect($pseudo, $mdp){
        $query = "SELECT * FROM users WHERE pseudo LIKE '".$pseudo."' AND mdp LIKE '".$mdp."'"; 
        $resultat = $this->db->query($query);
        if($resultat->num_rows()>0) return true;
        else return false;
    }

    public function get_id($pseudo){
        $query = "SELECT * FROM users WHERE pseudo LIKE '".$pseudo."'";
        $resultat = $this->db->query($query);
        $row = $resultat->row();
        return $row->id_users;
    }

    public function update_user(){

    }
}
?>