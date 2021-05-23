<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="bg-success p-2 text-white small mb-3">
    Cette page vous permet d'ajouter un produit à votre carte. N'oubliez pas de l'associer à une de vos catégories.  
</div>

<?if ($this->session->flashdata('success')) {?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?echo $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?}?>

<a class="btn btn-retour btn-sm" href="<?echo base_url("produits/categories/$category->id") ?>"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp; Retour</a>

<br><br>


<form action="<?echo base_url('produits/update') ?>" method="POST" id="form" enctype="multipart/form-data">
    <input type="hidden" name="prod_id" value="<? echo $produit->id ?>">
    <div class="row">
        <div class="form-group col-xl-4">
        <label class="font-weight-bold" for="nom">Catégorie</label>
            <select class="form-control form-control-sm" name="categorie">
                <option selected value="<? echo $category->id?>"><?=ucfirst($category->name)?></option>
            </select>
            <? echo form_error('categorie', ' <small class="text-danger">', '</small>'); ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-xl-4">
            <label class="font-weight-bold" for="nom">Nom du produit <i class="fas fa-star fa-xs input_required"></i></label>
            <input type="text" name="nom" class="form-control" placeholder="Le nom de votre produit" value="<? echo set_value('nom', $produit->name); ?>">
            <? echo form_error('nom', ' <small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group col-xl-8">
            <label class="font-weight-bold" for="description">Composition</label>
            <input type="text" name="description" class="form-control" placeholder="La composition ou la description de votre produit" value="<? echo set_value('description', $produit->composition); ?>">
            <? echo form_error('description', ' <small class="text-danger">', '</small>'); ?>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="form-group col-xl-4">
            <label class="font-weight-bold" for="price">Prix <i class="fas fa-star fa-xs input_required"></i></label>
            <input type="text" name="price" class="form-control" placeholder="La composition ou la description de votre produit" value="<? echo set_value('price', $produit->price); ?>">
            <? echo form_error('price', ' <small class="text-danger">', '</small>'); ?>
        </div>
    </div>

    <hr>

    <input type="hidden" name="not_card" id="offcard">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="not_card" value="<?=$produit->not_in_card?>" <?=($produit->not_in_card == 1) ? 'checked="checked"' : ''?>>
        <label class="custom-control-label" for="not_card">Ne pas proposer ce produit à la carte > <span class="small">Produit non vendu à la carte</span></label>
    </div>

    <input type="hidden" name="sold_out" id="soldout">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="sold_out" value="<?=$produit->sold_out?>"<?=($produit->sold_out == 1) ? 'checked="checked"' : ''?>>
        <label class="custom-control-label" for="sold_out">Rupture de stock > <span class="small">Porduit en rupture de stock</span></label>
    </div>

    <hr>

    <div class="row">
        <div class="form-group col-xl-6">
            <label class="font-weight-bold" for="image">Image du produit</label><br>
                <?if ($produit->image == '') {?>
                    <img src="<?echo base_url('assets/img/app/noimage.jpg') ?>" width="150px" height="150px"><br>
                    <i>Aucune image définie.</i><br><br>
                <?} else {?>
                    <img class="border" src="<?echo base_url("assets/img/uploads/products/$produit->image") ?>" width="150px" height="150px"><br>
                <?}?>
        </div>


        <div class="col-xl-6">
            <input type="file" class="form-control-file" id="image" name="image"><br>
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
    
    <hr>
    <button type="submit" class="btn btn-primary btn-sm">Enregistrer les modifications</button>
</form>

<script>
    // les inputs cachés
    let soldout = document.getElementById('soldout');
    let offcard = document.getElementById('offcard');

    // les switch
    let sold_out = document.getElementById('sold_out');
    let not_card = document.getElementById('not_card');

    sold_out.addEventListener("change", function () {
       this.checked ? soldout.setAttribute("value", 1) : soldout.setAttribute("value", 0);
    })

    not_card.addEventListener("change", function () {
        this.checked ? offcard.setAttribute("value", 1) : offcard.setAttribute("value", 0);
    })
</script>