<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Desafio Técnico - Login</title>

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
<div class="row">
	<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
	<h2>Faça seu login</h2>
	</div>
	<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <?php
		echo form_open(PASTASISTEMA.'Conta/login',array('id'=>'frmCad'));
		if(!empty($error)==1):
			echo("<span class='input_error' id='erroDados'><p>".$error."</p></span>");
		endif;
		?>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                	<?php echo "<span class='input_error' id='erroEmail'>".str_replace("Email","E-mail",form_error('Email'))."</span>"; ?>
                	<?php echo form_input(array("name"=>"Email","id"=>"Email","placeholder"=>"Digite seu e-mail","class"=>"form-control"),set_value('Email'),'autofocus'); ?>
                </div>
            </div>
		</div>
		
		<div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                	<?php echo "<span class='input_error' id='erroSenha'>".str_replace("Senha","Senha", form_error('Senha'))."</span>"; ?>
                	<?php echo form_password(array("name"=>"Senha","id"=>"Senha","placeholder"=>"Digite sua senha","class"=>"form-control")); ?>
                </div>
            </div>
       	</div>

       	<div class="row">
       		<div class="col-xs-4">
		        <div class="form-group">
		            <input type="submit" name="acessar" id="acessar" value="Acessar" class="btn btn-primary">
		        </div>
		   </div> 
		</div>
		<?php 
	    echo form_close();
	    ?>

	</div>

</div>
</div>
</section>

<script type="text/javascript" src="<?php echo PASTASISTEMA?>js/jquery-1.11.1.min.js"></script>			
<script type="text/javascript" src="<?php echo PASTASISTEMA?>js/bootstrap.min.js"></script>
