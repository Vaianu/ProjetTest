<?php
		/* Modal détail */
		for($i = 1; $i <= count($tabIdentifiantCommande); $i++)
		{
			$prestation = getPrestation($tabIdentifiantCommande[$i-1]); ?>
			<div class="modal fade" id="detailModal<?=$i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Détail de la commande "<?=$tabIdentifiantCommande[$i-1];?>"</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body row">
							<?php
							while ($data = $prestation->fetch())
							{
								echo '<div class="col-md-4" style="margin-bottom:50px;">';
								echo '<img src="'.$data['chemin_img'].'" alt="'.$data['intitule_article'].'" width="150px" height="120px" />';
								echo '<p><u class="text-uppercase">'.$data['intitule_article'].'</u><br/>';
								echo '<span class="'.$data['prix_article'].'">Prix : '.$data['prix_article'].' €</span><br/>';
								echo 'Date : '.$data['date_article'].'<br/>';
								echo 'Disponible entre '.$data['heure_debut'].' et '.$data['heure_fin'];
								echo '</p>';
								echo '<a href="delete-article.php?id_composer='.$data['id_composer'].'" class="btn-delete-article '.$data['id_composer'].'">';
								echo '<button" type="button" class="btn btn-danger">supprimer</button>';
								echo '</a>';
								echo '</div>';
							}
							?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		<?php
		}