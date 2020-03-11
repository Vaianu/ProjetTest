		<?php
		/* Modal delete commande */
		for($i = 1; $i <= count($tabIdentifiantCommande); $i++)
		{?>
			<div class="modal fade" id="confirmDeleteCommandeModal<?=$i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Confirmation de la suppression</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>Etes-vous sûr de vouloir supprimer la commande "<?=$tabIdentifiantCommande[$i-1];?>" ?</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
							<a href="delete-commande.php?id=<?=$tabIdCommandeTable[$i-1];?>" class="btn-delete-commande">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Oui</button>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php
		}