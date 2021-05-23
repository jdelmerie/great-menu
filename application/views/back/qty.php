<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

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
                <td>
                    <a href="<? echo base_url("quantites/nouveau/$categorie->id")?>"><?=ucfirst($categorie->name)?></a> 
                    <?foreach ($quantities as $quantity) {
                        if ($categorie->id == $quantity->qty_cat_id){
                        ?>
                        <i><?=ucfirst($quantity->qty_name)?></i>  
                    <?}}?>
                </td>
                <td class="text-center">
                    <a href="<? echo base_url("quantites/nouveau/$categorie->id")?>" class="btn btn-primary btn-sm">Modifier</a>
                </td>
            </tr>
        <?}?>
    </tbody>
</table>
