<?php
require('model.php');

$tabId = rechercher($_GET['mot_cles'])->fetchAll();
if (isset($_GET['mot_cles']) && count($tabId) > 0)
{
		if(count($tabId) > 1) {
			$mot_cles = str_replace("\\", "", $_GET['mot_cles']); // enlève les anti-slash
			echo '<h2 class="text-center font-italic">'.count($tabId).' résultats pour "'.htmlspecialchars($mot_cles).'"</h2>';
		}
		else {
			$mot_cles = str_replace("\\", "", $_GET['mot_cles']); // enlève les anti-slash
			echo '<h2 class="text-center font-italic">'.count($tabId).' résultat pour "'.htmlspecialchars($mot_cles).'"</h2>';
		}
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
				$tabIdCommandeTable = array();
				$tabIdentifiantCommande = array();
				$number = 1;
				foreach ($tabId as $data)
				{
					$tabIdCommandeTable[] = $data['id_commande_table'];
					$tabIdentifiantCommande[] = $data['identifiant_commande'];
					$intitules = getIntitules($data['identifiant_commande']);
					$cout_total = getCoutTotalcommande($data['identifiant_commande']);
					echo '<tr>';
					echo '<th scope="row">'.$number.'</th>';
					echo '<td>'.$data['identifiant_commande'].'</td>';
					echo '<td>';
					while ($intitule_article = $intitules->fetch())
					{
						echo '<span id='.$intitule_article['id_composer'].'>'.$intitule_article['intitule_article'].'</span><br/>';
					}
					echo '</td>';
					echo '<td class="'.$cout_total['cout_total'].'">'.$cout_total['cout_total'].' €</td>';
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
}
else
{
	$mot_cles = str_replace("\\", "", $_GET['mot_cles']); // enlève les anti-slash
	echo '<h2 class="text-center font-italic">Aucun résultat pour "'.htmlspecialchars($mot_cles).'"</h2>';
}
