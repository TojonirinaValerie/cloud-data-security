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
        <link rel="stylesheet" href="<?php echo css_url('supprimer_style')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('info_file')?>"/>
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
                    <div class="section-head">
                        <div>
                            <a href="<?php echo $retour;?>">
                                <img src="<?php echo img_url('Back-48.png'); ?>" alt="" width="30px">
                            </a>
                        </div>
                        <div class="chemin"><img src="<?php echo img_url('folder.png'); ?>" alt=""> /
                            <?php echo $affiche_path;?>
                        </div>
                    </div>

                    <?php
                        include("info_file.php");
                    ?>
                    <!--
                    <footer>
                        <div class="col-sm-12">
                            &copy;Copyright 2021
                        </div>
                    </footer>
                    -->
                </div>
            </div>
            
        </div>

        <script type="text/javascript" src="<?php echo js_url("jquery-3.5.1");?>"></script>
        <script type="text/javascript" src="<?php echo js_url("supprimer");?>"></script>
        <script type="text/javascript" src="<?php echo js_url("mes_donnees_script");?>"></script>
        <script type="text/javascript" src="<?php echo js_url("telecharger");?>"></script>
        <script type="text/javascript" src="<?php echo js_url("ouvrir");?>"></script>
    </body>
</html>