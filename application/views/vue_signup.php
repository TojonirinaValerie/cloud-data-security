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
        <link rel="stylesheet" href="<?php echo css_url('index_css/header_style')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('index_css/footer_style')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('index_css/section_style')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('index_css/style1')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('boutton_style')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('succes_styles')?>"/>
        <title>Cloud Data Security</title>
    </head>
    <body>
        
        <div class="containers">
            <header class="row">
                <div class="col-sm-2">
                    <a href="index.html"><img src="<?php echo img_url('cdslogo2.png'); ?>" alt="logo" class="cdslogo"></a>
                </div>
                <div class="col-sm-10 navbar-menu">
                    <ul>
                        <li><a href="<?php echo site_url('accueil'); ?>" class="lst-menu page-active" id="accueil">Accueil</a></li>
                        <li>
                            <div>
                                <a href="https://www.facebook.com/cloud-data-security" class="rs"><img src="<?php echo img_url('com.facebook.katana.png'); ?>" alt="logo_facebook" class="image-lien"></a>
                                <a href="https://www.twitter.com/cloud-data-security" class="rs"><img src="<?php echo img_url('twitter1.png'); ?>" alt="logo_twitter" class="image-lien"></a>
                                <a href="https://www.instagram.com/cloud-data-security" class="rs"><img src="<?php echo img_url('FB_IMG_16256680496716124.jpg'); ?>" alt="logo_instagram" class="image-lien"></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </header>
            <section class="row">
                <div class="col-lg-6 block-page-left">
                    <div class="row">
                        <div class="col-sm-12" id="image-accueil" 
                        <?php
                            if($this->input->post('inscription')) echo "style=\"display: none\"";
                            if($this->input->post('connexion')) echo "style=\"display: none\"";
                        ?>>
                            <img src="<?php echo img_url('image-accueil1.png'); ?>" alt="logo" class="image-a">
                        </div>
                    </div>
                    <?php include("connexion.php"); ?>
                        
                    <?php include("inscription.php"); ?>

                </div>
                <div class="col-lg-6 block-page-rigth">
                    <!--Texte d'accueil-->
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Bienvenue sur "Cloud Data Security"</h2>
                            <p>
                                Un site de stockage de données en ligne. <br>
                                Faites nous confiance pour securiser vos données.
                            </p>
                        </div>
                    </div>
                    <!--Boutton-->
                    <div class="row">
                        <div class="block-btn">
                            <input type="button" value="Se connecter" id="se_connecter" class="boutton">
                            <input type="button" value="S'inscrire" id="sinscrire" class="boutton">
                        </div>
                    </div>
                </div>
            </section>
            <footer class="row">
                    <div class="col-sm-12">
                        &copy;Copyright 2021
                    </div>
            </footer>
        </div> 
        
        <?php 
            if(isset($succes)){
                ?>
                <?php include('succes.php'); ?>
                <script src="<?php echo js_url('succes');?>" type="text/javascript"></script>       
                <?php
            }
        ?>
         
        
        <script src="<?php echo js_url('jquery-3.5.1'); ?>" type="text/javascript"></script>
        <script src="<?php echo js_url('index_script'); ?>" type="text/javascript"></script>
        <script src="<?php echo js_url('succes_script'); ?>" type="text/javascript"></script>
        <script src="<?php echo js_url('verification_inscription'); ?>" type="text/javascript"></script>
        <?php 
            if(isset($pseudo_existant)){
                ?>
                <script src="<?php echo js_url('erreur_pseudo');?>" type="text/javascript"></script>        
                <?php
            }
        ?> 
    </body>
</html>