<?php 	
//contenusaisi
$sasieSecu=strip_tags($_POST['saisieRechercheFilms']);//stepUp' called on an object that does not implement interface HTMLInputElement.'



    // Récupérer et sécuriser le texte saisi
    //$cherche = htmlspecialchars($_POST["cherche"]);
    $cherche = $sasieSecu;

    // Clé API de TMDb (remplacez-la par votre propre clé)
    $api_key = "***";

    // Point d'extrémité de recherche de l'API TMDb
    $endpoint = "https://api.themoviedb.org/3/search/movie";

    // Construire l'URL de la requête avec le terme de recherche, la clé API et l'option include_adult=false
    $url = $endpoint . "?query=" . urlencode($sasieSecu) . "&api_key=" . $api_key . "&include_adult=false";

    // Initialiser cURL
    $curl = curl_init($url);

    // Configurer les options cURL
    curl_setopt($curl, CURLOPT_CAINFO, 'C:/Users/Proprietaire/Desktop/forum2/cacert.pem');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // Exécuter la requête
    $response = curl_exec($curl);

    // Vérifier s'il y a des erreurs cacert.pem
    if (curl_errno($curl)) {
        echo 'Erreur cURL : ' . curl_error($curl);
        exit;
    }

    // Fermer la session cURL
    curl_close($curl);

    // Décoder la réponse JSON
    $results = json_decode($response, true);

    // Vérifier si des résultats ont été trouvés
    if (isset($results['results']) && count($results['results']) > 0) {
        // Afficher la liste cliquable des résultats
        echo "<ul>";
        foreach ($results['results'] as $result) {
            $title = $result['title'];
            $id = $result['id'];
            echo "<li><a href='#' onclick='showMovieDetails($id)' data-id='".$id."'>$title</a></li>";
            //echo ("<span>".count($results['results'])."</span>");
        }
        echo "</ul>";
    } else {
        echo "Aucun résultat trouvé.";
    }
