<div class="row">
	<div class="col-6">
		<a class="btn btn-primary" href="<? echo base_url('inscription')?>">INSCRIPTION</a>
	</div>
	<div class="col-6">
		<a class="btn btn-primary" href="<? echo base_url('connexion')?>">CONNEXION</a>
	</div>
</div>

<?if ($this->session->flashdata('error')) {?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <?echo $this->session->flashdata('error') ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?}?>