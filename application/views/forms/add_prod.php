<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="bg-success p-2 text-white small mb-3">
    Cette page vous permet d'ajouter un produit à votre carte. N'oubliez pas de l'associer à une de vos catégories.  
</div>



<form action="<?echo base_url('produits/add') ?>" method="POST">
    <div class="row">
        <div class="form-group col-xl-4">
        <label class="font-weight-bold" for="nom">Catégorie du produit <i class="fas fa-star fa-xs input_required"></i></label>
            <select class="form-control form-control-sm <? echo !empty($categories) ? "show" : "hide"?>" name="categorie" id="categorie">
                <option value="">Choisir une catégorie</option>
                <?foreach ($categories as $categorie) {?>
                    <option value="<?=$categorie->id ?>" <? echo set_select('categorie', $categorie->id); ?>><?=ucfirst($categorie->name)?></option>
                <?}?>
            </select>
           
            <div class="<? echo !empty($categories) ? "hide" : "show"?>">
                <span class="font-weight-bold text-danger small">Vous n'avez enregistré aucune catégorie de produits.</span><br>
                <span><a href="<? echo base_url('categories/nouveau')?>">Ajouter une catégorie de produits</a></span>
            </div>
            <? echo form_error('categorie', ' <small class="text-danger">', '</small>'); ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-xl-4">
            <label class="font-weight-bold" for="nom">Nom du produit <i class="fas fa-star fa-xs input_required"></i></label>
            <input type="text" name="nom" class="form-control" placeholder="Le nom de votre produit" value="<? echo set_value('nom'); ?>">
            <? echo form_error('nom', ' <small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group col-xl-8">
            <label class="font-weight-bold" for="description">Composition</label>
            <input type="text" name="description" class="form-control" placeholder="La composition ou la description de votre produit" value="<? echo set_value('description'); ?>">
            <? echo form_error('description', ' <small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="form-group col-xl-4" id="single_price">
            <label class="font-weight-bold show" for="price">Prix</label>
            <input type="text" name="price" class="form-control" placeholder="Le prix du produit" value="<? echo set_value('price'); ?>">
            <? echo form_error('price', ' <small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group col-xl-4" id="many_price">
            <label class="font-weight-bold hide" for="price"> plusieurs</label>
        </div>
    </div>


    <button type="submit" class="btn btn-primary btn-sm" <? echo empty($categories) ? "disabled" : "" ?>>Ajouter ce produit</button>
</form>

<pre>
    <? print_r($test)?>
</pre>

<select id="states">

</select>


<? if (count($test) > 0){
    echo "plusieurs prix";
}?>

<script>
    let cat = document.getElementById("categorie"); 
    let single_price = document.getElementById("single_price");
    let many_price = document.getElementById("many_price");
    let base_url = '<?echo base_url() ?>';

    cat.addEventListener("change", function(){

        let cat_id = this.value;

        // getjson('api', cat_id)

        $.ajax({
            type: "POST",
            url: "api", 
            data:{ 'id': cat_id }, 
            dataType:"json",//return type expected as json
            success: function(test){
                // $.each(states,function(key,val){
                //         var opt = $('<option />'); 
                //         opt.val(key);
                //         opt.text(val);
                //         $('#states').append(opt);
                // });

                console.log(quantites)
            },
        });

    })
    
</script>