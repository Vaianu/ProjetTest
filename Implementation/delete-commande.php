<?php
require('model.php');

if (isset($_GET['id']))
{
	supprimerCommande($_GET['id']);
}