<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="bg-success p-2 text-white small mb-3">
    Les catégories de produits vous permettent de classer vos produits par groupe (ex : Entrées, Plats, Desserts, etc...).  
</div>

<form action="<?echo base_url('categories/update') ?>" method="POST">
    <input type="hidden" value="<? echo $category->id?>" name="id">
    <div class="row">
        <div class="form-group col-xl-4">
            <label class="font-weight-bold" for="nom">Nom de la catégorie de produits <i class="fas fa-star fa-xs input_required"></i></label>
            <input type="text" name="nom" class="form-control" placeholder="ex : Nos plats" value="<? echo set_value('nom', $category->name); ?>">
            <? echo form_error('nom', ' <small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group col-xl-8">
            <label class="font-weight-bold" for="description">Description</label>
            <input type="text" name="description" class="form-control" placeholder="ex : Tous nos plats sont servis avec des frites ou de la salade." value="<? echo set_value('description', $category->description); ?>">
            <? echo form_error('description', ' <small class="text-danger">', '</small>'); ?>
        </div>
    </div>

    <hr>
    <label class="font-weight-bold" for="image">Image associée</label>
    <input type="hidden" name="image" id="input-hidden" value="<?=$category->image?>">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="switch-icon_edit">
        <label class="custom-control-label" for="switch-icon_edit">Ne pas utiliser d'image pour cette catégorie</label>
    </div>
    <br>
    <div id="icon-set_edit" class="show">
        <?foreach ($icons as $icon) {?>
            <img src="<?echo base_url("assets/img/icons/$icon") ?>" width="65px" height="65px" value="<?echo $icon?>" class="img m-1 <? echo $icon == $category->image ? 'border-select' : ""?>">
        <?}?>
    </div>
    <br>
    <button type="submit" class="btn btn-primary btn-sm">Modifier cette catégorie de produits</button>
</form>


<script>
    
    let icon_bloc_edit = document.getElementById('icon-set_edit');
    let switch_icon_edit = document.getElementById('switch-icon_edit');
    let input_hidden = document.getElementById('input-hidden');

    switch_icon_edit.addEventListener("change", function () {
        if (this.checked){
            icon_bloc_edit.classList.replace('show', 'hide');
            input_hidden.setAttribute("value", 0);
        } else {
            icon_bloc_edit.classList.replace('hide', 'show');
        }
    });

    // console.log($(input_hidden).attr('value')) value de l input caché

    

    var btn = $('.img');
    // $(btn).css('border','1px solid #8f8f8f');

	btn.click(function(){
        $(btn).css('border','1px solid #8f8f8f');
        $(this).css('border','2px solid #ff0000');
        $(input_hidden).attr("value",$(this).attr('value'))
	})

</script>
