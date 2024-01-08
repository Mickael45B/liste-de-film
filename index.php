<?php
// Remplacez 'VOTRE_CLE_API' par votre clé d'API TMDb
$api_key = '***'; // Apres avoir créer un compte sur https://api.themoviedb.org, demandez une clef, pui inscrivez la ici

// Fonction pour faire une requête à l'API TMDb
function call_tmdb_api($endpoint, $params = array()) {
    global $api_key;

    $base_url = 'https://api.themoviedb.org/3/';
    $params['api_key'] = $api_key;

    $url = $base_url . $endpoint . '?' . http_build_query($params);
    $response = file_get_contents($url);

    return json_decode($response, true);
}

// Exemple : Obtenez les détails d'un film spécifique (par exemple, le film avec l'id 550 est Inception)
$movie_id = 600;
$movie_details = call_tmdb_api("movie/{$movie_id}");

// Affiche les détails du film
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Cinéma avec API</title>
</head>
<body>

    <h1>Détails du Film</h1>

    <?php if ($movie_details) : ?>
        <h2><?php echo $movie_details['title']; ?></h2>
        <p>Date de sortie : <?php echo $movie_details['release_date']; ?></p>
        <p>Vote moyen : <?php echo $movie_details['vote_average']; ?></p>
        <p>Résumé : <?php echo $movie_details['overview']; ?></p>
        <img src="https://image.tmdb.org/t/p/w500<?php echo $movie_details['poster_path']; ?>" alt="Affiche du film">
    <?php else : ?>
        <p>Erreur lors de la récupération des détails du film.</p>
    <?php endif; ?>

</body>
</html>

<!-- #region /*
    // Vérifie si le compteur d'erreurs est déjà défini dans la session 
    if (!isset($_SESSION['login_attempts'])) { 
      // S'il n'est pas défini, initialiser le compteur à zéro 
      $_SESSION[' login_attempts'] = 0; } ``` 2. 
    **Incrémenter le Compteur en Cas d'Erreur :** Chaque foi
*/


-->