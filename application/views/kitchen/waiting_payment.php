<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view("includes/header"); ?>
    <!-- Page Content -->
    <div class="container">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pedidos Aguardando Pagamento
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Project One -->
        <div class="row">
            <?php
            if($pedidos){
                foreach($pedidos as $pedido){
                    $total = 0;
                ?>
            <div class="col-md-4">
                <h3>Pedido <?= $pedido[0]->pedido ?></h3>
                <h4>Mesa <?= $pedido[0]->mesa ?></h4>
                <div style="height: 150px; overflow: auto;">
                <h4>Itens:</h4>
                <ul>
                    <?php foreach($pedido as $item){
                        $total += $item->preco;
                    ?>
                        <li><?= $item->nome ?> + R$<?= number_format($item->preco,2,",","") ?></li>
                    <?php } ?>
                </ul>
                </div>
                <h3>Total: R$<?= number_format($total,2,",","") ?></h3>
                <a class="btn btn-warning" href="<?= base_url('finalizar/'.$item->pedido) ?>">Efetuar Pagamento <span class="glyphicon glyphicon-usd"></span></a>
            </div>
            <?php }} ?>
        </div>
        <!-- /.row -->
        <hr>
<?php $this->load->view("includes/footer"); ?>