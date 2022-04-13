<div class="contenue">
    <table id="table_affichage">
        <tr class="thead">
            <td class="select"></td>
            <td class="colonne0">Nom</td>
            <td class="colonne1">Type</td>
            <td class="colonne2">Taille</td>
            <td class="colonne3">Date</td>
        </tr>
        <?php
        foreach($data as $item){
            echo "<tr class='ligne_item'>";
            
            $icone = "ico_".get_type($item["extension"]).".png";
        ?>

            <td class="select"><input type="checkbox" class="case_a_cocher" value="<?php echo $item["id_fichiers"];?>"/></td>
            <td class="colonne0">
                <img src="<?php echo img_url($icone);?>" alt="" class="type-icone">
                <a class="list-fichier" href="<?php
                if($item["extension"]=="dossier") {
                    $lien = base_url()."accueil/mes_donnees/".$item["id_fichiers"];
                }
                else $lien = base_url()."accueil/ouvrir/".$item["id_fichiers"];
                echo $lien;
                ?>">
                
                <?php echo $item["nom"];?>
                </a>
            </td>
            <td class="colonne1"><?php echo $item["extension"];?></td>
            <td class="colonne2"><?php if($item["extension"]!="dossier") echo $item["size"]." octets";?></td>
            <td class="colonne3">‎<?php echo $item["date_add"];?></td>
        <?php
            echo "</tr>";
        }
        ?>
    </table>
</div>