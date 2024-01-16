
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
    $api_key = "***";

?>
        <!-- Formulaire HTML avec un champ d'input -->
        Rechercher un film : <input id="saisie_RechercheFilm" type="text" name="cherche">
        <button><img id="soumettreRecherche" src="fleche-droite.png" style='height:8px;'></button>

        <h1>Resultat de recherche</h1>
        <div id="resultatRequete"></div>
        <h1>Détails du Film</h1>
        <div id="retourDetailFilm"></div>
        <script>
            function showMovieDetails(movieId) {
                console.log('Afficher les détails du film avec l\'ID ' + movieId);
                filmChoisi=movieId;

                ajax_detailDuFilm(filmChoisi);



}

function ajax_detailDuFilm(filmChoisi) {
                $.ajax({
                        method: "POST",
                        url: "TraitementDetailFilm.php", // Nom de la page actuelle
                        data: { filmChoisi: filmChoisi },
                    })
                    .done(function (retourDetail_html) {
                        $('#retourDetailFilm').html(retourDetail_html);
                    })
                    .fail(function () {
                        alert("error dans ajax_rechercheDeFilms");
                    });
            };




            

            // Déclaration de la variable en dehors de la fonction click
            var saisieRechercheFilms;

            $('#soumettreRecherche').on('click', function () {
                // Récupérer la valeur du champ de recherche
                saisieRechercheFilms = $('#saisie_RechercheFilm').val();
console.log("en cours");
                // Appeler la fonction de recherche de films
                ajax_rechercheDeFilms(saisieRechercheFilms);
            });

            function ajax_rechercheDeFilms(saisieRechercheFilms) {
                $.ajax({
                        method: "POST",
                        url: "TraitementRechercheDeFilms.php", // Nom de la page actuelle
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
     // Fin du else
    ?>
</body>
</html>
