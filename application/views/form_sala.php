<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dados de sala</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico">

<!-- Core CSS -->
<link href="<?php echo PASTASISTEMA?>css/b336/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo PASTASISTEMA?>css/b336/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo PASTASISTEMA?>css/b336/css/personalize.css" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="<?php echo PASTASISTEMA?>js/html5shiv.js"></script>
  <script src="<?php echo PASTASISTEMA?>js/respond.min.js"></script>
<![endif]-->

</head>
<body>
<section class="entrar content-block">
    <div class="container">
        <div class="row">			<h2>Dados de sala</h2>
    		<div class='col-xs-12 text-right'>
            	<a href="<?php echo PASTASISTEMA?>Conta/salas" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-chevron-left" style="font-size:16px"></span> <font style="font-size:14px">Voltar</font></a>
            </div>

            <?php            
            if($upd==true):				$id = $item[0]->ID;
                $sala = $item[0]->Sala;                $metodo = "Update_Sala";
            else:				$id = "";
				$sala = "";                $metodo = "Insert_Sala";
            endif;
    		
			if(($upd==true)&&($update==true)):
				echo "<div class='col-xs-12'><h3 style='text-align:center;color:#090''>Dados salvos com sucesso</h3></div>";
			else:
				if(($upd==false)&&($update==true)):
					echo "<div class='col-xs-12'><h3 style='text-align:center;color:#090'>Dados incluidos com sucesso</h3></div>";
				endif;
			endif;

            echo form_open(PASTASISTEMA.'Conta/'.$metodo,array('id'=>'frmItem'));
            echo form_hidden('ID',$id);
            ?>

            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for='Sala'>Sala</label>
                        <?php 
                        (set_value('Sala')=="")? $sala= $sala : $sala = set_value('Sala');
                        echo "<span class='input_error' id='erroSala'>".str_replace("sala","Sala",form_error('sala'))."</span>"; 
                        echo form_input(array("name"=>"Sala","id"=>"Sala","placeholder"=>"Sala","class"=>"form-control"),$sala); 
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" value="Salvar" class="btn btn-primary">&nbsp;<a href="<?php echo PASTASISTEMA?>Conta/salas" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove-sign" style="font-size:20px"></span> <font style="font-size:16px">Cancelar</font></a>
                    </div>
                </div>
            </div>
    
        <?php
        echo form_close();
        ?>
        </div>

    </div>
</section><script type="text/javascript" src="<?php echo PASTASISTEMA?>js/jquery-1.11.1.min.js"></script>			<script type="text/javascript" src="<?php echo PASTASISTEMA?>js/bootstrap.min.js"></script></body></html>