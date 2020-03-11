<?php
require('model.php');

if (isset($_GET['id_composer']))
{
	supprimerArticle($_GET['id_composer']);
}