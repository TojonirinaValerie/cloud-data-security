<div class="panel_alert_upload">
    <p class="alert_titre">Upload</p>
    <div>
        <form action="<?php echo base_url()."accueil/uploads"?>" id="form_upload" method="POST" enctype="multipart/form-data">
            <div id="custom-file">
                <input type="file" id="input_file" name="fichier"  hidden/>
                <label for="input_file" id="input_file_label">Selectionner un fichier</label>
            </div>
            <input type="submit" class="boutton" id="upload" name="upload" value="Upload">
        </form>
    </div>
</div>
<div class="blur blur-upload"></div>