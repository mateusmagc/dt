<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Lista de reservas</title>
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
<section class="entrar">
<div class="container">
    <div class="row">
 		<h2>Lista de reservas</h2>
 		
 		<div class="col-xs-12 col-sm-12" style="padding-top:20px; margin-bottom: 20px; text-align: right;">
    
    	<div class="col-xs-12 col-sm-8"></div>
			<div class="col-xs-12 col-sm-4">
				<a href="<?php echo PASTASISTEMA?>Conta/Incluir_reserva" class="btn btn-default">
					<span class="glyphicon glyphicon-plus"></span> Incluir Reserva
				</a>
				
				<a href="<?php echo PASTASISTEMA.'/conta'?>"><span class="glyphicon glyphicon-th" style="font-size:28px;color:#000;margin:20px; padding-top: 10px" title="Painel Administrativo"></span></a> 
        	</div>
       </div>
 		
 	</div>
 	<div class="row">
        <div class="col-xs-12">
    		<?php
			if($result==false):
			?>
			    <div class="row">
			        <h5 style='text-align:center'><?php echo $resultado ?></h5>
			    </div>
			<?php
			else:
			?>
				<section class="resultado">
				<div class="container-fluid">
			        <div class="row">
			            <div class="col-xs-12">
			                <table class="table table-striped">
			                <thead>
			                    <tr>
			                    	<th></th>
			                    	<th>Data</th>
			                        <th>Horaio</th>
			                        <th>Sala</th>
			                        <th>Nome</th>
			                    </tr>
			                </thead>
			                <tbody>
			                    <?php 
			                        foreach ($resultado as $item=>$value):
			                    ?>
			                            <tr id="Item<?php echo $value['ID']?>">
			                                <td>
			                                <?php 
		                                		if($value["IDUsuario"]==$IDUser):
			                                ?>
			                                		<a style="cursor: pointer;" onclick="removeReserva(<?php echo $value['ID']?>)"><span class="glyphicon glyphicon-trash"></span></a>
			                                <?php 
			                                	endif;
			                                ?>
			                                </td>
			                                <td class="hidden-xs"><?php echo $value['Data']?></td>
			                                <td class="hidden-xs"><?php echo $value['Hora']?></td>
			                                <td class="hidden-xs"><?php echo $value['Sala']?></td>
			                                <td class="hidden-xs"><?php echo $value['Nome']?></td>
			                            </tr>
			                    <?php
			                        endforeach;
			                    ?>
			                </tbody>
			                </table>
			            </div>
			        </div>
				</div>
				</section> 
			<?php
			endif;
			?>
		</div>
	</div>
</div>
</section>

<script type="text/javascript" src="<?php echo PASTASISTEMA?>js/jquery-1.11.1.min.js"></script>			
<script type="text/javascript" src="<?php echo PASTASISTEMA?>js/bootstrap.min.js"></script>
<script type="text/javascript">

function removeReserva(quem){

	$.ajax({
		type: "POST", 
		dataType: "json",
		url: "<?php echo PASTASISTEMA?>Conta/Delete_reservas", 
		data: "reserva="+quem, 
		success: function(data){
			if(data.sucesse==true){
				location.href = "<?php echo PASTASISTEMA?>Conta/reservas";
			}
		}
	});
	
}

</script>

</body>
</html>