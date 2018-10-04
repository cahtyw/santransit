<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>SanTransit</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/style-login.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/my-login.js"></script>
	</head>
	<body>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4 text-center">
				<img src="../img/santransit-logo.png" alt="santransit logo in black and white" class="logo-login">
			</div>
			<div class="col-md-4"></div>
		</div>
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Acessar painel</h4>
						<form action="../../controller/login.php" method="POST">
							<div class="form-group">
								<label for="usuario">Usuário</label>
								<input id="usuario" type="usuario" class="form-control" name="usuario" value="" required autofocus>
							</div>
							<div class="form-group">
								<label for="senha">
									Senha
								</label>
								<input id="senha" type="password" class="form-control" name="senha" required data-eye>
							</div>
							<div class="alert alert-warning" role="alert">
								Para a segurança do sistema, não é possível criar contas novas a qualquer momento. É necessário ter uma autorização do administrador, por favor, entre em contato pelo site.
							</div>
							<div class="form-group no-margin botao-login">
								<button type="submit" class="btn btn-warning btn-block">
									Entrar
								</button>
								<a href="index.php" class="btn btn-danger btn-block">Voltar</a>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4">
			</div>
		</div>
	</body>
</html>