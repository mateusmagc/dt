<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dados de usuário</title>
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
        <div class="row">			<h2>Dados de usuário</h2>
    		<div class='col-xs-12 text-right'>
            	<a href="<?php echo PASTASISTEMA?>Conta/usuarios" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-chevron-left" style="font-size:16px"></span> <font style="font-size:14px">Voltar</font></a>
            </div>

            <?php            
            if($upd==true):				$id = $item[0]->ID;
                $nome = $item[0]->Nome;                $email = $item[0]->Email;                $senha  = $item[0]->Senha;                $metodo = "Update_Usuario";
            else:				$id = "";
				$nome = "";                $email = "";                $senha  = "";                $metodo = "Insert_Usuario";
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
                        <label for='Nome'>Nome</label>
                        <?php 
                        (set_value('Nome')=="")? $nome= $nome : $nome = set_value('Nome');
                        echo "<span class='input_error' id='erroNome'>".str_replace("Nome","Nome",form_error('Nome'))."</span>"; 
                        echo form_input(array("name"=>"Nome","id"=>"Nome","placeholder"=>"Nome","class"=>"form-control"),$nome); 
                        ?>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <label for='Email'>E-mail</label>
                        <?php 
                        (set_value('Email')=="")? $email = $email : $email = set_value('Email');
                        echo "<span class='input_error'>".str_replace("Fabricante","E-mail",form_error('Email'))."</span>"; 
                        echo form_input(array("name"=>"Email","id"=>"Email","placeholder"=>"E-mail","class"=>"form-control"),$email); 
                        ?>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for='Senha'>Senha</label>
                        <?php
                        (set_value('Senha')=="")? $senha= $senha : $senha = set_value('Senha');

                        echo "<span class='input_error'>".str_replace("Senha","Senha",form_error('Senha'))."</span>";
                        echo form_password(array("name"=>"Senha","id"=>"Senha","placeholder"=>"Senha","class"=>"form-control"), $senha);
                        ?>
                    </div>
                </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" value="Salvar" class="btn btn-primary">&nbsp;<a href="<?php echo PASTASISTEMA?>Conta/usuarios" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove-sign" style="font-size:20px"></span> <font style="font-size:16px">Cancelar</font></a>
                    </div>
                </div>
            </div>
    
        <?php
        echo form_close();
        ?>
        </div>

    </div>
</section>
<script type="text/javascript" src="<?php echo PASTASISTEMA?>js/jquery-1.11.1.min.js"></script>			<script type="text/javascript" src="<?php echo PASTASISTEMA?>js/bootstrap.min.js"></script>
</body>
</html>
