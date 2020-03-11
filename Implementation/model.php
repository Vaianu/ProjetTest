<?php

/**
 * Retourne tous les identifiants de commandes
 *
 * @return $req la réponse de la requête
 */
function getIdentifiantCommande()
{
	$db = dbConnect();
	$req = $db->query("SELECT id_commande id_commande_table, identifiant identifiant_commande
	FROM commande ORDER BY identifiant");
	
	return $req;
}

/**
 * Retourne toutes les prestations
 *
 * @return $prestations la réponse de la requête
 */
function getToutesLesPrestations()
{
	$db = dbConnect();
	$prestations = $db->query("SELECT id_article, intitule intitule_article, prix prix_article, chemin_img,
	DATE_FORMAT(article.date, '%d-%m-%Y') date_article, DATE_FORMAT(heure_debut, '%k:%i') heure_debut, DATE_FORMAT(heure_fin, '%k:%i') heure_fin
	FROM article ORDER BY intitule");
	
	return $prestations;
}

/**
 * Retourne les identifiants des commandes et leurs coût total
 *
 * @return $req la réponse de la requête
 */
function getIdentifiantEtCoutTotalCommande()
{
	$db = dbConnect();
	$req = $db->query("SELECT commande.id_commande id_commande_table, identifiant identifiant_commande, SUM(prix) cout_total
	FROM ((commande INNER JOIN composer ON composer.id_commande=commande.id_commande) 
	INNER JOIN article ON composer.id_article=article.id_article) GROUP BY identifiant");
	
	return $req;
}

/**
 * Retourne les intitulés des articles d'une commande
 *
 * @param $id l'identifiant de la commande
 *
 * @return $intitules la réponse de la requête
 */
function getIntitules($id)
{
	$db = dbConnect();
	$intitules = $db->query("SELECT id_composer, intitule intitule_article
	FROM ((article INNER JOIN composer ON composer.id_article=article.id_article) 
	INNER JOIN commande ON composer.id_commande=commande.id_commande)
	WHERE commande.identifiant='$id'
	ORDER BY intitule");

	return $intitules;
}

/**
 * Retourne les prestations des articles d'une commande
 *
 * @param $id l'identifiant de la commande
 *
 * @return $prestations la réponse de la requête
 */
function getPrestation($id)
{
	$db = dbConnect();
	$prestations = $db->query("SELECT id_composer, intitule intitule_article, prix prix_article, chemin_img,
	DATE_FORMAT(article.date, '%d-%m-%Y') date_article, DATE_FORMAT(heure_debut, '%k:%i') heure_debut, DATE_FORMAT(heure_fin, '%k:%i') heure_fin
	FROM ((commande INNER JOIN composer ON composer.id_commande=commande.id_commande) 
	INNER JOIN article ON composer.id_article=article.id_article) WHERE identifiant='$id' ORDER BY intitule");
	
	return $prestations;
}

/**
 * Retourne les identifiants des commandes
 *
 * @param $mot_cles le mot clés à rechercher (identifiant commande ou intitulé d'un article)
 *
 * @return $req la réponse de la requête
 */
function rechercher($mot_cles)
{
	$db = dbConnect();
	$req = $db->query("SELECT commande.id_commande id_commande_table, identifiant identifiant_commande
	FROM ((commande INNER JOIN composer ON composer.id_commande=commande.id_commande)
	INNER JOIN article ON composer.id_article=article.id_article) 
	WHERE identifiant='$mot_cles' OR intitule='$mot_cles' GROUP  BY identifiant ORDER BY identifiant");
	
	return $req;
}

/**
 * Retourne le coût total d'une commande
 *
 * @param $id l'identifiant de la commande
 *
 * @return $req le coût total de la commande
 */
function getCoutTotalCommande($id)
{
	$db = dbConnect();
	$req = $db->query("SELECT SUM(prix) cout_total
	FROM ((commande INNER JOIN composer ON composer.id_commande=commande.id_commande)
	INNER JOIN article ON composer.id_article=article.id_article) 
	WHERE identifiant='$id'");
	
	return $req->fetch();
}

/**
 * Fonction pour supprimer une commande
 *
 * @param $id la clé primaire de la table commande
 */
function supprimerCommande($id_commande)
{
	$db = dbConnect();
	$db->query("DELETE FROM composer WHERE id_commande='$id_commande'");
}

/**
 * Fonction pour supprimer un article
 *
 * @param $id _composer la clé primaire de la table composer
 */
function supprimerArticle($id_composer)
{
	$db = dbConnect();
	$db->query("DELETE FROM composer WHERE id_composer='$id_composer'");
}

/**
 * Fonction qui ajoute un article à une commande
 *
 * @param $id_commande la clé primaire de la table commande
 * @param $id_article la clé primaire de la table article
 */
function ajouterArticle($id_commande, $id_article)
{
	$db = dbConnect();
	$db->query("INSERT INTO composer (id_composer, id_commande, id_article) VALUES (NULL, '$id_commande', '$id_article')");
}

/**
 * Connexion à la base de données
 *
 * @return $db la connexion à la base de données
 */
function dbConnect()
{
	try
	{
		$db = new PDO('mysql:host=localhost;dbname=restaurant;charset=utf8', 'root', '');
		return $db;
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
}