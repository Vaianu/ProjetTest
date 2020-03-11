<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="resto.css" />
		<title>Restaurant</title>
    </head>
 
    <body>
		<header>
			<!-- Search form -->
			<form id="form_recherche" class="navbar-form navbar-right inline-form" method="get" style="width:30%; margin:auto;">
				<div class="form-group">
					<input type="search" name="mot_cles" id="mot_cles" class="input-sm form-control" placeholder="identifiant de commande ou intitulé de prestation">
					<button type="submit" class="btn btn-primary">Chercher</button>
					<button type="reset" class="btn btn-primary">Annuler la recherche</button>
				</div>
			</form>
			<!-- Assign commande -->
			<form id="form_assign_commande" class="navbar-form navbar-right inline-form" method="get" style="width:20%; margin:auto;">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assignerCommandeModal">Assigner une commande</button>
			<?php require('modal-assigner-commande.php'); ?>
			</form>
		</header>
		<div class="container">
			<div class="card border-0 shadow my-5">
				<div id="tableau"></div>
			</div>
		</div>
		
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script src="mon_script.js" type="text/javascript"></script>
    </body>
</html>