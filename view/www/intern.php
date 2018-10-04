<?php
	session_start();
	if(!isset($_SESSION['logged'])){
		header("Location: login.php");
	}
	require "../../model/database.php";
?>
<html>
	<head lang="pt-br">
		<meta charset="utf-8">
		<title>SANtransit!</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/style-intern.css">
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/my-login.js"></script>
	</head>
	<body>
		<div class="sup-main">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<img src="../img/santransit-logo.png" alt="santransit logo in black and white" class="logo-intern">
					</div>
				</div>
			</div>
		</div>
		<div class="sub-main">
			<div class="container text-white">
				<div class="row">
					<div class="col-md-12 sub-main-content bg-dark">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-12">
										<h1 class="display-4 text-santransit">Seja bem-vindo,<br><b><?=strtoupper($_SESSION['sobrenome'])?></b>!</h1>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<h4 class="display-4 display-6"><b>Informações básicas</b></h4>
										<?php
											if($stmt = $mysqli->prepare("SELECT motorista.nome, motorista.sobrenome, motorista.usuario, motorista.ooc_nome FROM motorista WHERE motorista.codigo = ?")){
												$stmt->bind_param('i', $_SESSION['logged']);
												$stmt->bind_result($nome, $sobrenome, $usuario, $ooc);
												if($stmt->execute()){
													$stmt->fetch();
												}
											}
										?>
										<div class="row">
											<div class="col-md-12">
												<span class="display-4 display-7"><b>Nome completo: </b><?=$nome." ".$sobrenome?></span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span class="display-4 display-7"><b>Usuário: </b><?=$usuario?></span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span class="display-4 display-7">((<b>Nome OOC: </b><?=$ooc?>))</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<span class="display-4 display-7"><b>Nível: </b><?=($_SESSION['nivel'] > 1)?'Administrador' : 'Motorista'?></span>
											</div>
										</div>
									</div>
								</div>
								<hr>
							</div>
							<div class="col-md-3">

							</div>
							<div class="col-md-3">
								<?php
									if($_SESSION['nivel'] > 1){
										?>	
											<div class="row intern-admin-comando-titulo">
												<div class="col-md-12">
													<h3 class="display-4 display-6 text-right"><b>Administração</b></h3>
												</div>
											</div>
											<div class="row intern-admin-comando">
												<div class="col-md-12">
													<a href="rotas.php" class="btn btn-warning btn-block"><b>Gerenciar motoristas</b></a>
												</div>
											</div>
											<div class="row intern-admin-comando">
												<div class="col-md-12">
													<a href="rotas.php" class="btn btn-warning btn-block"><b>Gerenciar rotas</b></a>
												</div>
											</div>
											<div class="row intern-admin-comando">
												<div class="col-md-12">
													<a href="rotas.php" class="btn btn-warning btn-block"><b>Gerenciar pontos de ônibus</b></a>
												</div>
											</div>
										<?php
									}
								?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?php
								echo "aaaa";
									if($stmt = $mysqli->prepare("SELECT motorista.nome, motorista.sobrenome, linha.nome_linha, linha.codigo FROM motorista INNER JOIN linha ON motorista.codigo_linha = linha.codigo")){
										echo "aaaa";
										$stmt->bind_result($nome, $sobrenome, $linha_nome, $linha_codigo);
										echo "aaaa";
										if($stmt->execute()){
											echo "a";
											while($stmt->fetch()){
												?>
													<div class="motorista-ativo">
														<div class="row">
															<div class="col-md-10">
																<div class="row">
																	<div class="col-md-12">
																		<b><?=$nome." ".$sobrenome?></b>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12">
																		<?=$linha_nome?>
																	</div>
																</div>
															</div>
															<div class="col-md-2 text-right">
																<i class="fas fa-bus-alt intern-busao"></i>
															</div>
														</div>
													</div>
												<?php
											}
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>