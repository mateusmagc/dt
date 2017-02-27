<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Lista de salas</title>
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
 		<h2>Lista de salas</h2>
 		
 		<div class="col-xs-12 col-sm-12" style="padding-top:20px; margin-bottom: 20px; text-align: right;">
    
    	<div class="col-xs-12 col-sm-9"></div>
			<div class="col-xs-12 col-sm-3">
				<a href="<?php echo PASTASISTEMA?>Conta/Incluir_sala" class="btn btn-default">
					<span class="glyphicon glyphicon-plus"></span> Incluir Sala
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
									<th><a href="javascript:selecionar_tudo();" data-toggle="tooltip" title="Selecionar todos"><img src="<?php echo PASTASISTEMA ?>images/chk_1.gif" border="0"/><img src="<?php echo PASTASISTEMA ?>images/chk_0.gif" border="0"/></a></th>
			                        <th>Sala</th>
			                    </tr>
			                </thead>
			                <tbody>
			                    <?php 
			                        foreach ($resultado as $item=>$value):
			                    ?>
			                            <tr id="Item<?php echo $value['ID']?>">
											<td>
	                                            <input type="checkbox" name="Item" id="Item" value="<?php echo $value['ID']?>" class='marcar'>&nbsp;
    	                                        <a href="<?php echo PASTASISTEMA?>Conta/Alterar_sala/<?php echo $value['ID']?>" title="Editar sala" data-toggle="tooltip"><span class="glyphicon glyphicon-pencil" style="font-size:20px; color:#000"></span></a>
    	                                    </td>
			                                <td class="hidden-xs"><?php echo $value['Sala']?></td>
			                            </tr>
			                    <?php
			                        endforeach;
			                    ?>
                                <tr>
                                    <td colspan="3"><button type="button" id="ExcluirItem" style="margin-top:20px" class="btn btn-default btn-sm">Excluir Sala(s)</button></td>
                                </tr> 
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
<script>
$(document).ready(function(){

	$("#ExcluirItem").click(function(){
		var strItens = "";
		$('.marcar').each(function () {
        	if(this.checked){		
				if(strItens==""){
					strItens = $(this).val();
				}else{
					strItens += ","+$(this).val();
				}
			}
		})

		if(strItens!=""){
			$.ajax({
				type: "POST", 
				dataType: "json",
				url: "<?php echo PASTASISTEMA?>Conta/Delete_salas", 
				data: "itens="+strItens, 
				success: function(data){
					if(data.sucesse==true){
						arrItens = strItens.split(",");
						for(i=0;i<arrItens.length;i++){
							location.href = window.location.href;
						}
					}
				}
			});
		}
	});

	
})	

function selecionar_tudo() {
    $('.marcar').each(function () {
        if (this.checked){
			$(this).attr("checked", false);
		}else{
			$(this).prop("checked", true);
		}
    })
}
</script>
</body>
</html>