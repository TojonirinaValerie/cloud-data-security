<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" href="<?php echo css_url('bootstrap')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('footer')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('header')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('section_accueil_style')?>"/>
        <link rel="stylesheet" href="<?php echo css_url('style')?>"/>
        <title>Mon Page Web</title>
    </head>
    <body>
        <div class="containers">
            <header class="row header_accueil">
                <?php
                include('header.php');
                ?>
            </header>
            <section class="row p0">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-2 p0">
                            <?php
                                include('section_menu.php');
                            ?>
                        </div>
                        <div class="col-sm-10">
                            <div class="block-container">
                                <div class="row">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="file" name="fichier" id=""><br>
                                        <input type="submit" name="envoyer" value="Envoyer">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <footer>
                <div class="col-sm-12">
                    &copy;Copyright 2021
                </div>
            </footer>
        </div>
    </body>
</html>