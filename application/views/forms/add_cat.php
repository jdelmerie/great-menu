<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="bg-success p-2 text-white small mb-3">
    Les catégories de produits vous permettent de classer vos produits par groupe (ex : Entrées, Plats, Desserts, etc...).  
</div>

<form action="<?echo base_url('categories/add') ?>" method="POST">
    <div class="row">
        <div class="form-group col-xl-4">
            <label class="font-weight-bold" for="nom">Nom de la catégorie de produits <i class="fas fa-star fa-xs input_required"></i></label>
            <input type="text" name="nom" class="form-control" placeholder="ex : Nos plats" value="<? echo set_value('nom'); ?>">
            <? echo form_error('nom', ' <small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group col-xl-8">
            <label class="font-weight-bold" for="description">Description</label>
            <input type="text" name="description" class="form-control" placeholder="ex : Tous nos plats sont servis avec des frites ou de la salade." value="<? echo set_value('description'); ?>">
            <? echo form_error('description', ' <small class="text-danger">', '</small>'); ?>
        </div>
    </div>

    <hr>
    <label class="font-weight-bold" for="image">Image associée</label>
    <input type="hidden" name="image" id="input-hidden">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="switch-icon">
        <label class="custom-control-label" for="switch-icon">Ne pas utiliser d'image pour cette catégorie</label>
    </div>
    <br>
    <div id="icon-set" class="show">
        <?foreach ($icons as $icon) {?>
            <img class="img m-1" src="<?echo base_url("assets/img/icons/$icon") ?>" width="65px" height="65px" value="<?echo $icon?>" >
        <?}?>
    </div>
    <br>
    <button type="submit" class="btn btn-primary btn-sm">Créer cette catégorie de produits</button>
</form>

<script>
    let icon_bloc = document.getElementById('icon-set');
    let switch_icon = document.getElementById('switch-icon');
    let input_hidden = document.getElementById('input-hidden');


    switch_icon.addEventListener("change", function () {
        if (this.checked){
            icon_bloc.classList.replace('show', 'hide');
            input_hidden.setAttribute("value", 0);
        } else {
            icon_bloc.classList.replace('hide', 'show');
        }
    });

    var btn = $('.img');
    $(btn).css('border','1px solid #8f8f8f');

	btn.click(function(){
        $(btn).css('border','1px solid #8f8f8f');
        $(this).css('border','2px solid #ff0000');
        $(input_hidden).attr("value",$(this).attr('value'))
	})

</script>