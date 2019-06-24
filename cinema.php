<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Tous les cinémas Cinémalin">
  <link rel="stylesheet" href="styles/style.css">
  <title>Cinéma Cinémalin</title>
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
    </header>
    <div id="principale">
      <div id="searchbar"> 
        <form action="membre.php" class="formulaire" method="get">
          <input class="champ" name="seance" type="text" placeholder="Rechercher une séance..."/>
            <select>
              <option>Aujourd'hui</option>
              <option>Demain</option>
              <option>Mercredi</option>
              <option>Jeudi</option>
              <option>Vendredi</option>
              <option>Samedi</option>
              <option>Dimanche</option>
            </select>
          <input type="submit" value="Recherche" />
        </form>
      </div>

    <!-- PHP -->
      <?php

      $seance = '';

      if (isset($_GET['seance'] )) {
          $seance = $_GET['seance'];
          $seance = "%$seance%";
      }

      $req = $bdd->prepare("SELECT debut_seance, fin_seance 
                            FROM tp_grille_programme 
                            WHERE debut_seance 
                            LIKE :seance");
      $req->execute(array(
        ":seance" => $seance
      ));
      $seance = $req->fetchAll();

      foreach ($seance as $value) { ?>
        <div> <?php echo $value["debut_seance"]; ?> </div>
      <?php
      } 
      ?>
    </div>
    <footer>
      <div id="contact">
        <p><a href="">Qui sommes-nous ?</a> | <a href="contact.php">Donnez votre avis</a> | <a href="">Mentions légales</a> | <a href="">Recrutement</a> | <a href="contact.php">Contact</a></p>
      </div>
      <p>© Copyright </p>
    </footer>
  </div>
</body>
</html>
