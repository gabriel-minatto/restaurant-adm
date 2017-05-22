<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $this->load->view("includes/header"); ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <h1 class="page-header">Itens Cadastrados</h1>
                </div>
                <div class="row">
                    <table class="table table-bordered table-striped table-hover table-responsive">
                    	<thead>
                    		<tr>
                    			<th>
                    				Nome
                    			</th>
                    			<th>
                    				Preço
                    			</th>
                    			<th>
                    			    Disponibilidade
                    			</th>
                    			<th>
                    				Tipo
                    			</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    	    <?php foreach($itens as $item){ ?>
                        		<tr>
                        			<td>
                        				<?= $item->nome ?>
                        			</td>
                        			<td>
                        				<?= $item->preco ?>R$
                        			</td>
                        			<td>
                        			    <input type="checkbox" class="disponilibidade_switcher" data-id-availability="<?= $item->id ?>" <?= ($item->disponibilidade == 1 ? "checked" : "") ?>>
                        			</td>
                        			<td>
                        				<?= ($item->tipo == 1 ? "Bebida" : "Prato") ?>
                        			</td>
                        		</tr>
                    		<?php } ?>
                    	</tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <h1 class="page-header">Novo Item</h1>
                </div>
                <div class="row">
                    <form class="form-horizontal" method="post" action="<?= base_url('salvar-item') ?>">
                        <fieldset>
                        
                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="nome">Nome:</label>  
                          <div class="col-md-4">
                          <input id="nome" name="nome" type="text" placeholder="nome" class="form-control input-md" required="">
                          </div>
                        </div>
                        
                        <!-- Text input-->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="preco">Preço:</label>  
                          <div class="col-md-4">
                          <input id="preco" name="preco" type="text" placeholder="preço" class="form-control input-md number" required="">
                            
                          </div>
                        </div>
                        
                        <!-- Multiple Radios -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="tipo">Tipo:</label>
                          <div class="col-md-4">
                          <div class="radio">
                            <label for="tipo-0">
                              <input type="radio" name="tipo" id="tipo-0" value="1" checked="checked">
                              Bebida
                            </label>
                        	</div>
                          <div class="radio">
                            <label for="tipo-1">
                              <input type="radio" name="tipo" id="tipo-1" value="2">
                              Prato
                            </label>
                        	</div>
                          </div>
                        </div>
                        
                        <!-- Multiple Checkboxes (inline) -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="disponivel">Disponível:</label>
                          <div class="col-md-4">
                            <label class="checkbox-inline" for="disponivel-0">
                              <input type="checkbox" name="disponivel" id="disponivel-0" value="1">
                              &nbsp;
                            </label>
                          </div>
                        </div>
                        
                        <!-- Button -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="submit"></label>
                          <div class="col-md-4">
                            <button id="submit" name="submit" class="btn btn-success">Salvar</button>
                          </div>
                        </div>
                        
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.row -->
        <hr>
        
        
<?php $this->load->view("includes/footer"); ?>
<script>
    $('.number').keypress(function(event) {
    if(event.which < 46
    || event.which > 59) {
        event.preventDefault();
    } // prevent if not number/dot

    if(event.which == 46
    && $(this).val().indexOf('.') != -1) {
        event.preventDefault();
    } // prevent if already dot
    });
    
    $(".disponilibidade_switcher").change(function(){
        link="<?= base_url('ativar-disponibilidade/') ?>"+$(this).data("id-availability");
        if(!this.checked){
            link="<?= base_url('desativar-disponibilidade/') ?>"+$(this).data("id-availability");
        }
        $.post(link);
    });
</script>

