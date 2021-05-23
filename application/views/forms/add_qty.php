<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="bg-success p-2 text-white small mb-3">
    Les quantités permettent de proposer des produits sous différentes formes. Pour une catégorie Vins, les quantités pourraient être Verre, Pichet et Bouteille.
</div>


<form action="<? echo base_url("quantites/add/$categorie->id")?>" method="POST" id="add">
    <div class="row">
        <div class="col-6">
            <label class="font-weight-bold" for="nom">Ajouter une quantité <i class="fas fa-star fa-xs input_required"></i></label>
            <input type="text" name="nom" class="form-control" placeholder="ex : Au verre" value="<? echo set_value('nom'); ?>">
            <? echo form_error('nom', ' <small class="text-danger">', '</small>'); ?>
        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-primary btn-sm">Ajouter cette quantité</button>
</form>


<?if ($this->session->flashdata('success')) {?>
    <br>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <?echo $this->session->flashdata('success') ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?}?>


<? if (count($quantites) > 0) {?>
    
<hr>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th class="text-center"style="width:10%;" scope="col">ORDRE D'AFFICHAGE</th>
                <th style="width:40%;" scope="col">NOM</th>
                <th style="width:10%;" scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?foreach ($quantites as $quantity) {?>
            <tr data-qty-id="<?=$quantity->id?>" data-cat-id="<?=$categorie->id?>"> 
                <td class="text-center">???</td>
                <td>
                    <form action="<? echo base_url("/quantites/edit/$quantity->id") ?>" method="POST" id="edit">
                        <div class="input-group mb-3">
                            <input type="hidden" name="cat_id" value="<?=$categorie->id?>">
                            <input type="text" class="form-control form-control-sm" value="<?=$quantity->name?>" name="qtyname" aria-describedby="button-edit">
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-sm" type="submit" id="button-edit">Modifier</button>
                            </div>
                        </div>
                    </form>
                </td>
                <td><button class="btn btn-danger btn-sm delete_qty">Supprimer</button></td>
            </tr>
            <?}?>
        </tbody>
    </table>
<?} else {?>
    <i class="text-center">Cette catégorie n'a aucune quantité</i>
<?}?>

<script>
let delete_qty = document.getElementsByClassName('delete_qty');

for (let i = 0; i < delete_qty.length; i++) {
    delete_qty[i].addEventListener("click", function () {
        let qty_id = this.parentNode.parentNode.getAttribute("data-qty-id");
        let cat_id = this.parentNode.parentNode.getAttribute("data-cat-id");
        Swal.fire({
            title: 'Supprimer cette quantité ?',
            text: "Vous êtes sur le point de supprimer cette quantité.",
            icon: 'warning',
            showCancelButton: true,
            //  confirmButtonColor: '#00509d',
            //  cancelButtonColor: '#dc3545',
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("/quantites/delete/" + qty_id + '/' + cat_id )
                location.reload();
            }
        })
   })
}
</script>