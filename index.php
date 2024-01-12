
<!DOCTYPE html>
<html>

<head>
        <meta charset="utf-8" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Ephesis&family=Festive&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <title>
            neo-retro WLM
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script  type ="module"  src ="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" ></script> 
        
        <!-- <link rel="stylesheet" type="text/css" href="style_chat.css"> --><!-- GENERAL -->



	</head>

	<body>
    <?php
    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['saisieRechercheFilms'])) {
        // TraitementRechercheDeFilms.php

        // Contenu saisi
        $saisieSecu = strip_tags($_POST['saisieRechercheFilms']);

        // Récupérer et sécuriser le texte saisi
        $cherche = $saisieSecu;

        // Clé API de TMDb (remplacez-la par votre propre clé)
        $api_key = "***";

        // Point d'extrémité de recherche de l'API TMDb
        $endpoint = "https://api.themoviedb.org/3/search/movie";

        // Construire l'URL de la requête avec le terme de recherche, la clé API et l'option include_adult=false
        $url = $endpoint . "?query=" . urlencode($cherche) . "&api_key=" . $api_key . "&include_adult=false";

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
                echo "<li><a href='#' onclick='showMovieDetails($id)'>$title</a></li>";
            }
            echo "</ul>";
        } else {
            echo "Aucun résultat trouvé.";
        }
    } else {
        // Afficher le formulaire de recherche
    ?>

        <!-- Formulaire HTML avec un champ d'input -->
        Rechercher un film : <input id="saisie_RechercheFilm" type="text" name="cherche">
        <button><img id="soumettreRecherche" src="fleche-droite.png" style='height:8px;'></button>

        <h1>Resultat de recherche</h1>
        <div id="resultatRequete"></div>
        <h1>Détails du Film</h1>

        <script>
            function showMovieDetails(movieId) {
                alert('Afficher les détails du film avec l\'ID ' + movieId);
            }

            // Déclaration de la variable en dehors de la fonction click
            var saisieRechercheFilms;

            $('#soumettreRecherche').on('click', function () {
                // Récupérer la valeur du champ de recherche
                saisieRechercheFilms = $('#saisie_RechercheFilm').val();

                // Appeler la fonction de recherche de films
                ajax_rechercheDeFilms(saisieRechercheFilms);
            });

            function ajax_rechercheDeFilms(saisieRechercheFilms) {
                $.ajax({
                        method: "POST",
                        url: "index.php", // Nom de la page actuelle
                        data: { saisieRechercheFilms: saisieRechercheFilms },
                    })
                    .done(function (retourReponse_html) {
                        $('#resultatRequete').html(retourReponse_html);
                    })
                    .fail(function () {
                        alert("error dans ajax_rechercheDeFilms");
                    });
            };
        </script>

    <?php
    } // Fin du else
    ?>
</body>
</html>
