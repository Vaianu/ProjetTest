<?php
require('model.php');
?>
	<div class="modal fade" id="assignerCommandeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Assigner une commande</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group text-center">
						<label>Choix de la commande:*</label>
						<br />
						<select id="choix_commande">
							<option value="@@@@@">--sélectionner dans la liste--</option>
							<?php
							$req = getIdentifiantCommande();
							while ($data = $req->fetch())
							{
								echo '<option value="'.$data['id_commande_table'].'">'.$data['identifiant_commande'].'</option>';
							}
							?>
						</select>
					</div>
					<label for="message-text" class="col-form-label">Prestations:*</label>
					<div id="prestations" class="form-group row">
						<?php
						$req = getToutesLesPrestations();
						while ($data = $req->fetch())
						{
							echo '<div class="col-md-4" style="margin-bottom:50px;">';
							echo '<label for="'.$data['id_article'].'">';
							echo '<img src="'.$data['chemin_img'].'" alt="'.$data['intitule_article'].'" width="200px" height="150px" />';
							echo '<p><span class="text-uppercase font-weight-bold">'.$data['intitule_article'].'</span>';
							echo '<input class="decocheCase" style="margin-left:30px;margin-top:10px;width:20px;height:20px;" type="checkbox" id="'.$data['id_article'].'"><br/>';
							echo '<span class="'.$data['prix_article'].'">Prix : '.$data['prix_article'].' €</span><br/>';
							echo 'Date : '.$data['date_article'].'<br/>';
							echo 'Disponible entre '.$data['heure_debut'].' et '.$data['heure_fin'];
							echo '</p>';
							echo '</label>';
							echo '</div>';
						}
						?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success">Ajouter</button>
				</div>
			</div>
		</div>
	</div>