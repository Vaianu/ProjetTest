
$(document).ready(function() {
	
	$("#tableau").load('toutes-les-commandes.php');
	
	/** Recherche par identifiant ou prestation **/
	$("#form_recherche").on('submit',function(event)
	{
		var mot_cles = $("#mot_cles").prop('value');
		
		if (mot_cles != "") {
			// Remplace les espaces par des + pour la requête sql
			// Exemple : poisson cru devient poisson+cru
			mot_cles = mot_cles.replace(/ /gi, '+');
		
			mot_cles = mot_cles.replace(/'/gi, '\\\''); // ajoute un anti-slash devant tout les apostrophes
		
			$("#tableau").load('research.php?mot_cles='+mot_cles);
		}
		// On empêche le rechargement de la page
		event.preventDefault();
	});
	
	$("#form_recherche").on('reset',function(event)
	{
		$("#tableau").load('toutes-les-commandes.php');
	});
	
	/** Suppresion commande **/
	$("#tableau").on('click', 'a.btn-delete-commande', function(event)
	{
		var url = $(this).attr('href');
		$.ajax({
			type: 'GET',
			url: url,
			success: function(event) {
				var mot_cles = $("#mot_cles").prop('value');
				if (mot_cles == "") {
					$("#tableau").load('toutes-les-commandes.php');
				}
				else {
					mot_cles = mot_cles.replace(/ /gi, '+');
					mot_cles = mot_cles.replace(/'/gi, '\\\'');
					$("#tableau").load('research.php?mot_cles='+mot_cles);
				}
			}
		});

		event.preventDefault();
	});
	
	/** Suppresion article **/
	$("#tableau").on('click', 'a.btn-delete-article', function(event)
	{
		var url = $(this).attr('href');
		var id_composer = $(this).attr('class');
		id_composer = id_composer.split(" ");
		id_composer = id_composer[1];
		$.ajax({
			type: 'GET',
			url: url,
			success: function() {
				var div = event.target.parentNode.parentNode;
				var span_commande = document.getElementById(id_composer);
				var td = span_commande.parentNode;
				var tr = td.parentNode;
				var tbody = tr.parentNode;
				var mot_cles = $("#mot_cles").prop('value');
				if (mot_cles == "")
				{
					div.parentNode.removeChild(div);
					var tab_span = td.querySelectorAll('span');
					if(tab_span.length > 1) {
						var p = event.target.parentNode.previousSibling;
						var span_prix = p.querySelector('span');
						var prix_article = $(span_prix).attr('class');
						var td_coutTotal = td.nextSibling;
						var cout_total_actuel = $(td_coutTotal).attr('class');
						var cout_nouveau = cout_total_actuel - prix_article;
						$(td_coutTotal).attr('class', cout_nouveau);
						td_coutTotal.textContent = cout_nouveau + " €";
						
						var br = span_commande.nextSibling;
						br.parentNode.removeChild(br);
						span_commande.parentNode.removeChild(span_commande);
					}
					else {
						tr.parentNode.removeChild(tr);
						var tab_tr = tbody.querySelectorAll('tr');
						for(var i=0; i<tab_tr.length; i++) {
							tab_tr[i].firstChild.textContent = i+1;
						}
					}
				}
				else
				{	
					var div_modal_body = div.parentNode;
					div.parentNode.removeChild(div);
					var children_div = div_modal_body.querySelectorAll('div');
					var total = 0;
					for(var i=0; i<children_div.length; i++) {
						var p = children_div[i].firstChild.nextSibling;
						var u = p.firstChild;
						if(u.innerHTML.toLowerCase() == mot_cles.toLowerCase()) {
							total++;
						}
					}
					
					var tab_tr = tbody.querySelectorAll('tr');
					
					if(total == 0 && tbody.querySelectorAll('tr').length > 1)
					{
						tr.parentNode.removeChild(tr);
						h2 = document.getElementById('tableau').firstChild;
						if(tab_tr.length > 1) {
							h2.textContent = tab_tr.length + " résultats pour \"" + mot_cles + "\"";
						}
						else {
							h2.textContent = tab_tr.length + " résultat pour \"" + mot_cles + "\"";
						}
						var tab_tr = tbody.querySelectorAll('tr');
						for(var i=0; i<tab_tr.length; i++) {
							tab_tr[i].firstChild.textContent = i+1;
						}
					}
					else
					{
						var p = event.target.parentNode.previousSibling;
						var span_prix = p.querySelector('span');
						var prix_article = $(span_prix).attr('class');
						var td_coutTotal = td.nextSibling;
						var cout_total_actuel = $(td_coutTotal).attr('class');
						var cout_nouveau = cout_total_actuel - prix_article;
						$(td_coutTotal).attr('class', cout_nouveau);
						td_coutTotal.textContent = cout_nouveau + " €";
						
						var br = span_commande.nextSibling;
						br.parentNode.removeChild(br);
						span_commande.parentNode.removeChild(span_commande);
					}
				}
			}
		});

		event.preventDefault();
	});
	
	/** Assigner une commande **/
	$("#form_assign_commande").on('submit',function(event)
	{
		var id_commande = $("#choix_commande").children("option:selected").attr('value');
		$("#prestations input[type=checkbox]:checked").each(function()
		{
			var id_article = $(this).attr('id');
			$.ajax({
				type: 'GET',
				url: 'assigner-commande.php?id_commande='+id_commande+'&id_article='+id_article,
				success: function(event) {
					var mot_cles = $("#mot_cles").prop('value');
					if (mot_cles == "") {
						$("#tableau").load('toutes-les-commandes.php');
					}
					else {
						mot_cles = mot_cles.replace(/ /gi, '+');
						mot_cles = mot_cles.replace(/'/gi, '\\\'');
						$("#tableau").load('research.php?mot_cles='+mot_cles);
					}
				}
			});
		});
		$("#prestations .decocheCase").prop("checked", false);
		event.preventDefault();
	});

});