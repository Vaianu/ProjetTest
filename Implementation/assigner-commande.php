<?php
require('model.php');

if (isset($_GET['id_commande']) && isset($_GET['id_article']))
{
	ajouterArticle($_GET['id_commande'], $_GET['id_article']);
}