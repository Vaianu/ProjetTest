<?php
require('model.php');
?>
		<table class="table table-hover table-striped text-center">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Identifiant de commande</th>
					<th scope="col">Intitulé des articles</th>
					<th scope="col">Coût total de commande</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$id_and_coutTotal = getIdentifiantEtCoutTotalCommande();
				$tabIdCommandeTable = array();
				$tabIdentifiantCommande = array();
				$number = 1;
				while ($data = $id_and_coutTotal->fetch())
				{
					$tabIdCommandeTable[] = $data['id_commande_table']; // pour créer modal confirmation suppression de commande
					$tabIdentifiantCommande[] = $data['identifiant_commande']; // pour créer modal détail par commande
					$intitules = getIntitules($data['identifiant_commande']);
					echo '<tr>';
					echo '<th scope="row">'.$number.'</th>';
					echo '<td>'.$data['identifiant_commande'].'</td>';
					echo '<td>';
					while ($intitule_article = $intitules->fetch())
					{
						echo '<span id='.$intitule_article['id_composer'].'>'.$intitule_article['intitule_article'].'</span><br/>';
					}
					echo '</td>';
					echo '<td class="'.$data['cout_total'].'">'.$data['cout_total'].' €</td>';
					/* Button trigger modal */
					echo '<td>';
					echo '<p><button style="width:100px;" type="button" title="détail de la commande '.$data['identifiant_commande'].'" class="btn btn-info" data-toggle="modal" data-target="#detailModal'.$number.'">détail</button></p>';
					echo '<p><button type="button" title="supprimer la commande '.$data['identifiant_commande'].'" class="btn btn-warning" data-toggle="modal" data-target="#confirmDeleteCommandeModal'.$number.'">supprimer</button></p>';
					echo '</td>';
					echo '</tr>';
					$number++;
				}
				?>
			</tbody>
		</table>
		
		<?php 
		require('modal-detail.php');
		require('modal-delete-commande.php');
		
		