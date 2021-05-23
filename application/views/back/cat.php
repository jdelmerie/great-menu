<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<a href="<? echo base_url('categories/nouveau')?>" class="btn btn-primary btn-sm">Ajouter une catégorie</a>
<br><br>

<?if ($this->session->flashdata('error')) {?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <?echo $this->session->flashdata('error') ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?} else if ($this->session->flashdata('success')) {?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <?echo $this->session->flashdata('success') ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?}?>

<table class="table">
    <thead class="thead-light">
        <tr class="small">
            <th class="text-center" style="width:10%;" scope="col"></th>
            <th class="text-center" style="width:10%;" scope="col">ORDRE</th>
            <th style="width:50%;" scope="col">CATÉGORIES DE PRODUITS</th>
            <th class="text-center" style="width:30%;"scope="col"></th>
        </tr>
    </thead>
    <tbody>

        <?foreach ($categories as $categorie) {?>
            <tr data-cat-id="<?=$categorie->id?>">
                <td class="text-center">
                    <? if ($categorie->image == "" || $categorie->image == 0) {?>
                        <img src="<? echo base_url("assets/img/icons/4-plate.png")?>" width="50px" height="50px">
                    <?} else {?>
                        <img src="<? echo base_url("assets/img/icons/$categorie->image")?>" width="50px" height="50px">
                    <?}?>
                </td>
                <td class="text-center">???</td>
                <td>
                    <a href="<? echo base_url("categories/edit/$categorie->id")?>">
                        <?=ucfirst($categorie->name)?><br>
                    </a>
                    <?foreach ($quantities as $quantity) {
                        if ($categorie->id == $quantity->qty_cat_id){
                        ?>
                        <i><?=ucfirst($quantity->qty_name)?></i> 
                    <?}}?>
                    <p class="small"><?=$categorie->description?></p>
                </td>
                <td class="text-center">
                    <a href="<? echo base_url("categories/edit/$categorie->id")?>" class="btn btn-primary btn-sm">Modifier</a>
                    <button class="btn btn-danger btn-sm delete_cat">Supprimer</button> 
                </td>
            </tr>
        <?}?>
    </tbody>
</table>


<script>
let delete_cat = document.getElementsByClassName('delete_cat');

for (let i = 0; i < delete_cat.length; i++) {
    delete_cat[i].addEventListener("click", function () {
        let cat_id = this.parentNode.parentNode.getAttribute("data-cat-id");
        console.log(cat_id)

        Swal.fire({
            title: 'Supprimer cette catégorie ?',
            text: "Vous êtes sur le point de supprimer cette catégorie de votre carte.",
            icon: 'warning',
            showCancelButton: true,
            //  confirmButtonColor: '#00509d',
            //  cancelButtonColor: '#dc3545',
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("/categories/delete/" + cat_id)
                location.reload();
            }
        })
   })
}
</script>