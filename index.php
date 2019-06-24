<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Accueil du site Cinémalin qui vous propose des films du plus ancien au plus récent">
  <link rel="stylesheet" href="styles/style.css">
  <title>Accueil Cinémalin</title>
</head>

<body>

  <!-- Connexion BDD -->
  <?php
      try {
          $bdd = new PDO('mysql:host=localhost;dbname=epitech_tp', "root", "");       // Connexion 
          $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
          echo 'Erreur lors de la connexion a la bdd : ' . $e->getMessage(); // Si erreur de connexion 
          }
  ?>

  <div id="container">
    <header>
        <h1> <a href="index.php">CINEMALIN</a></h1>
        <nav>
          <div id="menu">
            <ul>
              <li><a href="index.php" title="Accueil du cinéma" class="border"><strong>ACCUEIL</strong></a>
              </li>
            </ul>
            <ul>
              <li><a href="cinema.php" title="Découvrez nos cinéma" class="border"><strong>CINEMA</strong></a>
              </li>
            </ul>
            <ul>
              <li><a href="film.php" title="Découvrez nos films" class="border"><strong>FILMS</strong></a>
              </li>
            </ul>
            <ul>
              <li><a href="membre.php" title="Découvrez nos films" class="border"><strong>MEMBRES</strong></a>
              </li>
            </ul>
            <ul>
              <li><a href="#"  title="Contactez-nous" class="border"><strong>CONTACT</strong></a>
              </li>
            </ul>
          </div>
        </nav>
        <div id="galerie">
          <img src="img/valerian.jpg" alt="image de présentation, film Valérian">
        </div>
    </header>
    <div id="principale">
      <div class="searchbar"> 
        <form action="film.php" class="formulaire" method="get">
          <input class="champ" name="recherche" type="text" placeholder="Trouvez votre film"/>
          <input type="submit" value="Recherche" />
        </form>
      </div>
      <div id="affiche">
        <h2>A L'AFFICHE</h2>
          <img src="img/gardien.jpg" alt="affiche des gardiens de la galaxie 2">
          <img src="img/muraille.jpg" alt="affiche de la grande muraille">
          <img src="img/pirate.jpg" alt="affiche pirates de caraibes">
          <img src="img/wonder.jpg" alt="affiche de wonderwoman">
      </div> <!-- Fermeture div affiche -->
      <div id="prochainement">
        <h2> PROCHAINEMENT</h2>
          <img src="img/moimoche.jpg" alt="Affiche de moi moche et méchant 3"> <!-- <a href=""><img src="img/fleche.png"></a> -->
          <img src="img/momie.jpg" alt="Affiche de la momie"> <!--  <a href=""><img src="img/fleche.png"></a> -->
          <img src="img/spiderman.jpg" alt="Affiche de spiderman"> <!-- <a href=""><img src="img/fleche.png"></a> -->
          <img src="img/transformers.jpg" alt="Affiche de transformers the last king"> <!-- <a href=""><img src="img/fleche.png"></a> -->
      </div>
      <div id="chance">
        <h2>DERNIERE CHANCE</h2>
          <img src="img/starwars.jpg" alt="affiche star wars">
          <img src="img/john.jpg" alt="affiche john wick 2">
          <img src="img/conjuring.jpg" alt="affiche conjuring 2">
          <img src="img/split.jpg" alt="affiche split">
      </div>
    </div>
  <footer>
    <h3>RETROUVEZ-NOUS SUR LES RESEAUX SOCIAUX</h3>
    <div id="suivez">
      <a href="http://facebook.fr" target="blank"><img src="img/facebook.png" alt="icone facebook"></a>
      <a href="http://twitter.fr" target="blank"><img src="img/twitter.png" alt="icone twitter"></a>
      <a href="http://instagram.fr" target="blank"><img src="img/instagram.png" alt="icone instagram"></a>
    </div>
    <div id="contact">
      <p><a href="">Qui sommes-nous ?</a> | <a href="contact.php">Donnez votre avis</a> | <a href="">Mentions légales</a> | <a href="">Recrutement</a> | <a href="contact.php">Contact</a></p>
    </div>
    <p>© Copyright </p>
  </footer>
  </div>
</body>
</html>