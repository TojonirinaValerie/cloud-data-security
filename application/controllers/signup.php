<?php
class Signup extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper('assets');
        $this->load->helper('crypteur');
        $this->load->model('users');
        $this->load->library('form_validation');
        //if(!($this->session->userdata("pseudo"))){redirect(base_url().'accueil');}
        echo CI_VERSION;
    }

    private $inscri = false;
    public function index(){
        if($this->session->userdata("pseudo")){
            redirect(base_url().'accueil');
        }
        $pseudo_existant = false;
        if($this->input->post("connexion")){
            $pseudo = htmlspecialchars($this->input->post('pseudo'));
            $mdp = crypte_password(htmlspecialchars($this->input->post('mdp')));
            if($this->users->can_connect($pseudo, $mdp)){
                $id = $this->users->get_id($pseudo);
                $sess_data = array(
                    'pseudo' => $pseudo, 
                    'id' => $id, 
                    'path' => ""
                );
                $this->session->set_userdata($sess_data);
                redirect(base_url().'accueil');
            }
            else{
                $this->load->view('vue_signup');
            }
        }
        else{
            if($this->input->post("inscription")){
                $this->form_validation->set_rules("pseudo","Pseudo",
                "trim|required|max_length[50]|alpha_dash");
                $this->form_validation->set_rules("mdp","Mot de Passe",
                "trim|required|min_length[8]|max_length[25]|alpha_dash|matches[mdp1]");
                $this->form_validation->set_rules("mdp1","Confirmation mot de Passe",
                "trim|required|matches[mdp1]");
                if($this->form_validation->run()){
                    $pseudo = htmlspecialchars($this->input->post('pseudo'));
                    $mdp = crypte_password(htmlspecialchars($this->input->post('mdp')));
                    $mail = htmlspecialchars($this->input->post('mail'));
                    if($this->users->add_user($pseudo, $mdp, $mail)){
                        $path_dir = 'assets/uploads/'.$this->users->get_id($pseudo);
                        mkdir($path_dir, 0777);
                        mkdir($path_dir.'/tmp.tmpfolder', 0777);
                        $inscri = true;
                        $data = array(
                            'succes' => true,
                            'pseudo' => $pseudo,
                            'id' => $this->users->get_id($pseudo)
                        );
                        $this->load->view('vue_signup', $data);
                    }
                    else{
                        $data = array(
                            "pseudo_existant" => true
                        );
                        $this->load->view('vue_signup', $data);
                    }
                }
                else{
                    
                    $this->load->view('vue_signup'); 
                }
            }
            else{
                $this->load->view('vue_signup'); 
            }
        }
    }

    public function pseudoisexist($pseudo){
       if($this->users->pseudo_is_exist($pseudo)) echo '{"exist" : true}';
       else echo '{"exist" : false}';
    }

}
?>