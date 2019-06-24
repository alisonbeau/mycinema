<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Page des membres du site Cinémalin">
  <link rel="stylesheet" href="styles/style.css">
  <title>Membres de Cinémalin</title>
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
          <input class="champ" name="recherchem" type="text" placeholder="Rechercher un membre..."/>
          <input type="submit" value="Recherche" />
        </form>
      </div>


      <!-- PHP -->
      <?php

      $historique = '';
      $abonner = '';

      if (isset($_GET['recherchem'] )) {
        $abonner = $_GET['recherchem'];
        $abonner = "%$abonner%";
      }

      if (!empty($_GET['id'])) {
        $historique = $_GET['id'];
      }

      if (isset($_GET['abonner']) && $_GET['abonner'] != "abonnement") {
      }

        $req = $bdd->prepare("SELECT nom, prenom, id_perso 
                              FROM tp_fiche_personne 
                              WHERE nom 
                              LIKE :abonner 
                              OR prenom 
                              LIKE :abonner");
        $req->execute(array(
          ":abonner" => $abonner
        ));
        $abonner = $req->fetchAll(); 


        $req2 = $bdd->prepare("SELECT tp_historique_membre.id_film, tp_historique_membre.date, tp_fiche_personne.id_perso, tp_fiche_personne.nom, tp_film.id_film, tp_film.titre 
                               FROM tp_historique_membre 
                               LEFT JOIN tp_fiche_personne 
                               ON tp_historique_membre.id_membre = tp_fiche_personne.id_perso 
                               LEFT JOIN tp_film 
                               ON tp_historique_membre.id_film = tp_film.id_film 
                               WHERE tp_fiche_personne.id_perso = :historique");
        $req2->execute(array(
          ":historique" => $historique
        ));
        $historique = $req2->fetchAll(); 
        ?>

        <?php foreach ($abonner as $value) { ?>
          <div> <a href="membre.php?id=<?php echo $value['id_perso']; ?>"><?php echo $value["nom"]; ?> <?php echo $value["prenom"]; ?></a>
            <select name="abonner">
              <option value="abonnement">Abonnement</option>
              <option value="modifier">Modifier</option>
              <option value="supprimer">Supprimer</option>
              <option  value="ajouter">Ajouter</option>
            </select>
          </div>
        <?php
        } 
        ?> 
        
        <?php foreach ($historique as $value) { ?>
          <div> 
            <?php echo $value["titre"]; ?> 
            <?php echo $value["date"]; ?> 
          </div>
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

