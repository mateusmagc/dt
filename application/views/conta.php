<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">

<title>Desafio Técnico - Painel Administrativo</title>

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

	<div class="col-xs-12" class="text-center">
	<h2>Painel Administrativo -   <a href="<?php echo PASTASISTEMA.'conta/Logoff'?>"><span class="glyphicon glyphicon-off" style="font-size:28px;color:#000;margin-top:30px" title="Sair"></span></a></h2>
	
	</div>
	<div class="col-xs-12" class="text-center">

      
            <div class="col-sm-6 col-md-4 block">
    
                <a href="<?php echo PASTASISTEMA."Conta/Usuarios"?>">
    
                <p><span class="glyphicon glyphicon-pencil" style="font-size:36px;"></span></p>
    
                <p>Usuário</p>
    
                </a>
    
            </div>

                <div class="col-sm-6 col-md-4 block">
        
                    <a href="<?php echo PASTASISTEMA."Conta/Salas"?>">
        
                    <p><span class="glyphicon glyphicon-upload" style="font-size:36px;"></span></p>
        
                    <p>Salas</p>
        
                    </a>	
        
                </div>


            <div class="col-sm-6 col-md-4 block">
    
                <a href="<?php echo PASTASISTEMA."Conta/Reservas"?>">
    
                <p><span class="glyphicon glyphicon-shopping-cart" style="font-size:36px;"></span></p>
    
                <p>Reservas</p>
    
                </a>	
    
            </div>
			
	</div>



</div>

</div>

</section>

<script type="text/javascript" src="<?php echo PASTASISTEMA?>js/jquery-1.11.1.min.js"></script>			
<script type="text/javascript" src="<?php echo PASTASISTEMA?>js/bootstrap.min.js"></script>
</body>

</html>

