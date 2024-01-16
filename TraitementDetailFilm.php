<?php 

$sasieSecu=strip_tags($_POST['filmChoisi']);//stepUp' called on an object that does not implement interface HTMLInputElement.'
//$sasieSecu=1643;//stepUp' called on an object that does not implement interface HTMLInputElement.'



    // Récupérer et sécuriser le texte saisi
    //$cherche = htmlspecialchars($_POST["cherche"]);
    $cherche = $sasieSecu;

    // Clé API de TMDb (remplacez-la par votre propre clé)
    $api_key = "4f77197f08dcc773f0e656aa372e4c3c";

    // Point d'extrémité de recherche de l'API TMDb
    $endpoint = "https://api.themoviedb.org/3/movie/$sasieSecu";
// Construire l'URL de la requête avec la clé API
$url = $endpoint . "?api_key=" . $api_key;

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
$result = json_decode($response, true);

// Vérifier si des résultats ont été trouvés
if (isset($result['id']) && $result['id'] == $sasieSecu) {
    echo "<span>".$result['title']."</span><br>".print_r($result);
    // Vous pouvez maintenant utiliser $result pour accéder aux détails du film
    // Afficher l'image du film
    if (isset($result['overview'])) {
        echo "<p>Résumé du film : " . $result['overview'] . "</p>";
    } else {
        echo "Aucun résumé disponible.";
    }
    if (isset($result['poster_path'])) {
        $imagePath = "https://image.tmdb.org/t/p/w500" . $result['poster_path'];
        echo "<div style='align-items:center;'><img src='$imagePath' alt='Affiche du film' ></div>";
        echo "<style>
        body {
            /*background-image: url('$imagePath');
            background-size: cover;
            background-position: center;
            height: auto; 
            margin: 0; */
        }
      </style>";
    } else {
        echo "Aucune image disponible.";
    }
} else {
    echo "Aucun résultat trouvé.";
}
?>
