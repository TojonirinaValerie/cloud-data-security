
<div class="row">
    <div class="col-md-12 section-ouvrir">
        <div class="row">
            <div class="col-lg-8">
                <?php 
                /*
                    $src = "assets/uploads/".$this->session->userdata("id")."/";
                    $src .= $data->nom_fichier;
                    $src_file = decrypte_file($src, $data->extension);*/
                    $type = get_type($data->extension);
                    if($type=="photo"){
                        echo "<img src='".base_url().$src_file."' alt='' id='file_ouvert'>";
                    }
                    if($type=="video"){
                        echo "<video src='".base_url().$src_file."' autoplay controls id='file_ouvert'></video>";
                    }
                    if($type=="audio"){
                        echo "<audio src='".base_url().$src_file."' autoplay controls id='file_ouvert'></audio>";
                    }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <button id="telecharger"><a href="<?php echo base_url().$src_file?>" id="btn_down" download="<?php echo $data->nom_fichier.".".$data->extension;?>">Télécharger</a></button>
                
                <!--<button id="renomer">Renomer</button>
                <button id="supprimer">Supprimer</button>
                -->
                <br>
                <p class="fiche" id="fiche_nom"><?php echo $data->nom_fichier.".".$data->extension;?></p>
                <p class="fiche">Type :  <?php echo $data->extension;?></p>
                <p class="fiche">Taille :  <?php echo $data->size." octets";?></p> 
                <p class="fiche">Date d'ajout: <?php echo $data->date_add;?></p>
            </div>
        </div>
    </div>
</div>