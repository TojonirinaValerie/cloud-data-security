<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="<?php echo img_url('cdslogo2.png') ; ?>" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo css_url('bootstrap')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('footer')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('header')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('section_accueil_style')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('style')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('option_style')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('contenue_style')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('supprimer_style')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('boutton_style')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('upload_style')?>"/>
        <title>Cloud Data Security</title>
    </head>
    <body>
        <div class="contenair">
            <div class="header">
                <?php
                include('header.php');
                ?>
            </div>
            <div class="section">
                <div class="s-left">
                    <?php
                        include('section_menu.php');
                    ?>
                </div>
                <div class="s-rigth">
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

                                <td class="select"><input type="checkbox" class="case_a_cocher" value="<?php echo $item["id"];?>"/></td>
                                <td class="colonne0">
                                    <img src="<?php echo img_url($icone);?>" alt="" class="type-icone">
                                    <a class="list-fichier" href="<?php
                                    if($item["extension"]=="dossier") {
                                        $lien = base_url()."accueil/mes_donnees/".$item["id"];
                                    }
                                    else $lien = base_url()."accueil/ouvrir/".$item["id"];
                                    echo $lien;
                                    ?>">
                                    
                                    <?php echo $item["nom_fichier"];?>
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
                </div>
            </div>
            
        </div>
        <script type="text/javascript" src="<?php echo js_url("jquery-3.5.1");?>"></script>
        <script type="text/javascript" src="<?php echo js_url("supprimer");?>"></script>
        <script type="text/javascript" src="<?php echo js_url("upload_files");?>"></script>
    </body>
</html>