<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>SanTransit</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	</head>
	<body>
		<div class="main">
			<div class="sup-main">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
							<img src="../img/santransit-logo.png" alt="santransit logo in black and white">
						</div>
					</div>
				</div>
			</div>
			<div class="sub-main">
				<div class="container bg-dark text-white sub-main-content">
					<div class="row">
						<div class="col-md-4">
							<h1 class="display-4 text-santransit">Você está na<br><b>SANTRANSIT</b>!</h1>
							<span class="display-4 display-6">Acompanhe o transporte público <br>em tempo real.</span>
							<div class="row">
								<div class="col-md-12">
									<a type="a" href="./login.php" class="btn btn-light btn-lg btn-block linha-botao"><b>IR PARA O PAINEL</b></a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<span>Clique no ícone de mapa na linha desejada e carregará a imagem da trajetória de seu transporte.</span>
							<div class="row">
								<div class="col-md-12">
									<!-- <img src="../img/map.png" class="img-fluid" alt="map of los santos"> -->
									<div id="linhas-mapa" class="carousel slide" data-ride="carousel">
										<div class="carousel-inner">
											<div class="carousel-item active">
												<a href="../img/map.png">
													<img class="d-block w-100" src="../img/map.png">
												</a>
											</div>
											<?php 
												require "../../model/database.php";
												if($stmt = $mysqli->prepare("SELECT linha.imagem FROM linha INNER JOIN ponto_onibus ON linha.codigo_ponto_ativo = ponto_onibus.codigo ORDER BY ponto_onibus.codigo DESC LIMIT 6")){ 
													$stmt->bind_result($ponto_imagem);
													if(!$stmt->execute()){
														echo("Select failed (".$stmt->errno.") ".$stmt->error);
													}
													while($stmt->fetch()){
														?>
															<div class="carousel-item">
																<a href="<?=(!$ponto_imagem)? '../img/map.png' : $ponto_imagem?>" target="_blank">
																	<img class="d-block w-100" src="<?=(!$ponto_imagem)? '../img/map.png' : $ponto_imagem?>">
																</a>
															</div>
														<?php
													}
												}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<h3 class="display-4 display-6">Linhas operantes e não operantes:</h3>
							<?php
								if($stmt = $mysqli->prepare("SELECT linha.codigo, linha.nome_linha, ponto_onibus.endereco, ponto_onibus.bairro, ponto_onibus.codigo, linha.imagem FROM linha INNER JOIN ponto_onibus ON linha.codigo_ponto_ativo = ponto_onibus.codigo ORDER BY ponto_onibus.codigo DESC LIMIT 6")){ 
									$stmt->bind_result($codigo, $linha, $endereco, $bairro, $ponto_codigo, $ponto_imagem);
									if(!$stmt->execute()){
										echo("Select failed (".$stmt->errno.") ".$stmt->error);
									}
									$cont = 0;
									while($stmt->fetch()){
										$mapa[$cont] = $ponto_imagem;
										?>
										<div class="row linha-ativa">
											<div class="col-md-9">
												<div class="row">
													<div class="col-md-12">
														<b>
															<?php 
																$string = (($codigo < 100)?"0": '');
																$string = (($codigo > 9)?:"0").$string."".$codigo;
																echo $string." - ".$linha;
															?>
														</b>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<?php
															if($ponto_codigo > 1)
																echo ($endereco.", ".$bairro);
															else
																echo "Fora de operação";
														?>
													</div>
												</div>
											</div>
											<div class="col-md-3 linha-status text-right">
												<div class="row">
													<div class="col-md-6">
														<i class="fas fa-map-marked-alt linha-busao text-map<?=(!$ponto_imagem)?'-disabled':''?>" id="linha-map-<?=$cont++?>"></i>
													</div>
													<div class="col-md-6">
														<i class="fas fa-bus-alt linha-busao <?=($ponto_codigo > 1)?'linha-operacao':'linha-nao-operacao'?>"></i>
													</div>
												</div>
											</div>
										</div>
										<?php
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			//var_dump($mapa);
		?>
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script>
			$('.carousel').carousel({
				interval: false
			});
			$(document).ready(function(){
				//$("#linhas-mapa").carousel("pause");
				<?php 
					for($i=0;$i<6;$i++){
						?>
						$("#linha-map-<?=$i?>").click(function(){
							$("#linhas-mapa").carousel(<?=$i+1?>);
						});
						<?php
					}
				?>
			});
		</script>
	</body>
</html>