<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?if ($this->session->flashdata('success')) {?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?echo $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?}?>

<div class="bg-success p-2 text-white small mb-3">
    La fonction "Aperçu de votre carte" vous permet d'avoir un rendu sur différents supports.
</div>

<div class="pt-3 pb-3">
    <label class="font-weight-bold">Aperçu de votre carte</label><br>
    <a class="btn btn-info" href="<?echo base_url("/carte/$etab->url") ?>" target='_blank'>Aperçu sur votre écran</a>
    <a class="btn btn-info disabled" href="">Aperçu smartphone</a>
</div>

<hr>

<div class="bg-success p-2 text-white small mb-3">
    Téléchargez votre logo, il s'affichera automatiquement dans différents endroits de votre carte.
</div>

<div class="pt-3 pb-3">
    <div class="row">
        <div class="form-group col-xl-6">
            <label class="font-weight-bold" for="logo">Logo</label><br>
                <?if (!isset($personnalisation) || $personnalisation->logo == '') {?>
                    <img src="<?echo base_url('assets/img/app/noimage.jpg') ?>" width="250px" height="250px"><br>
                    <i>Aucun logo défini.</i><br><br>
                <?} else {?>
                    <img class="border" src="<?echo base_url("assets/img/uploads/logos/$personnalisation->logo") ?>" width="250px" height="250px"><br>
                <?}?>
        </div>

        <div class="col-xl-6">
            <form action="<?echo base_url('personnalisation/logo') ?>" method="POST" enctype="multipart/form-data">
                <input type="file" class="form-control-file" id="logo" name="logo"><br>
                    <!-- <i class="text-danger font-weight-bold">Votre image doit faire moins de 8Mo.</i><br> -->
                <button type="submit" class="btn btn-color btn-sm">Enregistrer le logo</button>
            </form>
            <?if ($this->session->flashdata('error')) {?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?echo $this->session->flashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?}?>
        </div>
    </div>
</div>

<hr>

<div class="bg-success p-2 text-white small mb-3">
    Décrivez votre établissement, donnez les informations telles que les horaires d'ouverture, ce qui vous démarque des autres,... Cette présentation sera la page d'accueil de votre carte.
</div>

<div class="pt-3 pb-3">
    <label class="font-weight-bold">Présentation de votre établissement</label><br>
    <form action="<?echo base_url('personnalisation/presentation') ?>" method="post">
        <textarea name="presentation">
            <?echo $personnalisation->presentation == '' ? "" : $personnalisation->presentation; ?>
        </textarea>

        <script>
            CKEDITOR.replace('presentation');
        </script>
        <br>
        <input class="btn btn-primary" type="submit" value="Enregistrer la présentation">
    </form>
</div>

<hr>

<div class="bg-success p-2 text-white small mb-3">
    Modifier l'image de fond de votre carte pour mieux refléter l'image de votre établissement. Notez que ces images sont des motifs qui sont répétés pour remplir entièrement les dimensions de l'écran.
</div>

<div class="pt-3 pb-3">
    <label class="font-weight-bold">Image de fond de votre carte</label><br>
    <span class="alert alert-success hide" id="info"></span>
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="switch-bkg" value="<?=$personnalisation->background_image?>" <?=($personnalisation->background_image == "") ? 'checked="checked"' : ''?>>
        <label class="custom-control-label" for="switch-bkg">Ne pas utiliser d'image (le fond de votre carte sera blanche par défaut).</label>
    </div>
    <br>
    <div id="bckg-set" class="show">
        <?foreach ($images as $img) {?>
            <img src="<?echo base_url("assets/img/backgrounds/thumbnails/$img") ?>" width="128px" height="128px" value="<?echo $img ?>"  class="m-1 img <? echo isset($personnalisation->background_image) && $personnalisation->background_image == $img ? "border-select" : ""?>">
        <?}?>
    </div>
</div>

<script>
    let base_url = '<?echo base_url() ?>';
    let controller = "personnalisation/background";
    let url = base_url + controller;
    let bck_bloc = document.getElementById('bckg-set');
    let switch_bkg = document.getElementById('switch-bkg');
    let info =  document.getElementById('info');
    let img = document.getElementsByClassName('img');

    function fetchdata(url, data) {
        const options = {
            method: 'POST',
            headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
            body: JSON.stringify({ 'background_image': data })
        };

        fetch(url, options);
    }

    switch_bkg.checked ? bck_bloc.classList.replace('show', 'hide') : bck_bloc.classList.replace('hide', 'show');

    for (let i = 0; i < img.length; i++) {
        img[i].addEventListener("click", function () {
            info.innerHTML = "Image de fond mise à jour";
            info.classList.add('show');
            fetchdata(url, this.getAttribute('value'))
            document.location.reload();
        })
    }

    switch_bkg.addEventListener("change", function () {

        if (this.checked == false) {
            bck_bloc.classList.replace('hide', 'show');
            info.classList.replace('show', 'hide');

        } else {
            bck_bloc.classList.replace('show', 'hide');
            fetchdata(url, data = "")
            info.innerHTML = "Image de fond désactivée";
            info.classList.add('show');
        }
    });

</script>