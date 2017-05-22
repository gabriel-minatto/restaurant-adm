<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view("includes/header"); ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pedidos Em Espera
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Project One -->
        <div class="row">
            <?php foreach($pedidos as $pedido){ ?>
            <div class="col-md-4 pedido">
                <h3 class="numero">Pedido <?= $pedido[0]->pedido ?></h3>
                <h4 class="mesa">Mesa <?= $pedido[0]->mesa ?></h4>
                <div style="height: 150px; overflow: auto;">
                <h4>Itens:</h4>
                <ul>
                    <?php foreach($pedido as $item){ ?>
                        <li><?= $item->nome ?></li>
                    <?php } ?>
                </ul>
                </div>
                <h5>Acompanhamentos e Observações:</h5>
                <p class="obs"><?= $item->observacoes ?></p>
                <a class="btn btn-success" href="<?= base_url('/processar/'.$item->pedido) ?>">Fazer <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
            <?php } ?>
        </div>
        <!-- /.row -->

        <hr>
        
        
<?php $this->load->view("includes/footer"); ?>
<script>
    setInterval(function(){
        location.reload();
    }, 5000);
</script>