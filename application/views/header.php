<div class="h-left">
    <a href="<?php echo base_url().'accueil.html';?>"><img src="<?php echo img_url('cdslogo2.png'); ?>" alt="logo" class="cdslogo_accueil"></a>
    <?php /*<img src="<?php echo img_url('avatar/avatar1_rgb.jpg'); ?>" alt="" id="avatar"> */?>
</div>
<div class="h-rigth navbar-header">
    <ul>
        <li class="header-btn">
            <button id="btn_upload" class="header-lien boutton-header">
                <img src="<?php echo img_url('icon/back_btn_p.scale-140.png'); ?>" alt="" class="img-lien">Upload
            </button>
        </li>
        <li class="header-btn">
            <a href="<?php echo base_url().'accueil/deconnexion'; ?>" class="header-lien">
                <img src="<?php echo img_url('icon/shutdown_480px.png'); ?>" alt="" class="img-lien">Deconnexion
            </a>
        </li>
        <li>
            <form action="" method="POST">
                <input type="text" name="input-search" id="input-search" placeholder="Recherche"/>
                <input type="submit" name="btn-search" id="btn-search" value=""/>
            </form>
        </li>
    </ul>
</div>