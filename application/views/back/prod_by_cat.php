
 <?if ($this->session->flashdata('success')) {?>
    <br>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <?echo $this->session->flashdata('success') ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?}?>

<? if (count($produits) > 0) {?>
<table class="table mt-5">
    <thead class="thead-light">
        <tr class="small">
            <th class="text-center" style="width:10%;" scope="col"></th>
            <th class="text-center" style="width:10%;" scope="col">ORDRE</th>
            <th style="width:50%;" scope="col">NOM DU PRODUIT</th>
            <th style="width:10%;" scope="col">PRIX</th>
            <th class="text-center" style="width:30%;"scope="col"></th>
        </tr>
    </thead>

    <tbody>
    <?foreach ($produits as $produit) {?>
        <tr data-prod-id="<?=$produit->id?>" data-cat-id="<?=$produit->cat_id?>">
            <td class="text-center">
                <? if ($produit->image == "") {?>
                    <img src="<? echo base_url("assets/img/icons/4-plate.png")?>" width="50px" height="50px">
                <?} else {?>
                    <img src="<? echo base_url("assets/img/uploads/products/$produit->image")?>" width="50px" height="50px">
                <?}?>
            </td>
            <td class="text-center">???</td>
            <td>
                <a href="<? echo base_url("produits/edit/$produit->id")?>"><?=ucfirst($produit->prod_name)?></a>
                <p class="small"><? echo $produit->composition != '' ? $produit->composition : '<i>Pas de composition</i>'?></p>
            </td>
            <td>
                <!-- PRIX PAR TYPE -->
             
                <!-- PRIX UNIQUE -->
                    <span><?=$produit->price?> €</span>
             
            </td>
            <td class="text-center">
                <a href="<? echo base_url("produits/edit/$produit->id")?>" class="btn btn-primary btn-sm">Modifier</a>
                <button class="btn btn-danger btn-sm delete_prod">Supprimer</button> 
            </td>
        </tr>
    <?}?>
    </tbody>
</table>
<? } else {?>
    <p class="text-center m-5">Aucun produit n'est enregistré dans cette catégorie.</p>
<? } ?>

<script>
let delete_prod = document.getElementsByClassName('delete_prod');

for (let i = 0; i < delete_prod.length; i++) {
    delete_prod[i].addEventListener("click", function () {
        let prod_id = this.parentNode.parentNode.getAttribute("data-prod-id");
        let cat_id = this.parentNode.parentNode.getAttribute("data-cat-id");
        Swal.fire({
            title: 'Supprimer ce produit ?',
            text: "Vous êtes sur le point de supprimer ce produit de votre carte.",
            icon: 'warning',
            showCancelButton: true,
            //  confirmButtonColor: '#00509d',
            //  cancelButtonColor: '#dc3545',
            confirmButtonText: 'Supprimer',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("/produits/delete/" + cat_id + '/' + prod_id )
                location.reload();
            }
        })
   })
}
</script>