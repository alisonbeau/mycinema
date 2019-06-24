<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Tous les films disponible sur le site Cinémalin">
  <link rel="stylesheet" href="styles/style.css">
  <title>Films disponible sur Cinémalin</title>
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
      <div id="presentation">
        <h2>Trouvez votre film</h2>
        <img src="img/films.png" alt="présentation films">
      </div>
    </header>
    <div id="principale">
      <div class="searchbar"> 
        <form action="film.php" class="formulaire" method="get">
          <input class="champ" name="recherche" type="text" placeholder="Rechercher un film"/>
            <select name="categorie">
              <option value="categorie">Catégorie</option> 
              <?php
                $categorie = $bdd->query("SELECT * FROM tp_genre ORDER BY id_genre ASC"); // Séléctionne tout mes id_genre

                foreach ($categorie as $genre) { ?>
                <option value=<?php echo $genre["id_genre"]; ?>> <?php echo $genre["nom"]; ?></option>  <!-- J'echo le nom des mes id_genre -->
                <?php
                }
                ?>
            </select>
            <select name="distributeur">
              <option value="distributeur">Distributeurs</option> 
              <?php
                $genres = $bdd->query("SELECT * FROM tp_distrib ORDER BY id_distrib ASC");  // Séléctionne tout mes distributeurs

                foreach ($genres as $genre) { ?>
                <option value=<?php echo $genre["id_distrib"]; ?>> <?php echo $genre["nom"]; ?></option> <!-- Affiche le nom -->
                <?php
                }
                ?>
            </select>   
          <input type="submit" value="Recherche" />
        </form>
      </div>

    <!-- PHP -->
      <?php
  
        $query_where = '';
        $array_var = [];
        $titre = '%%';

        if (!empty($_GET['recherche'])) { // si mon champs n'est pas vide 
          $titre = "%${_GET['recherche']}%";
        }

        $query_where = "WHERE titre LIKE ? ";   // j'enregistre le nom de ma recherche
          array_push($array_var, $titre);
          if (isset($_GET['categorie']) && $_GET['categorie'] != 'categorie') {
            $query_where .= "AND tp_film.id_genre = ? ";
            array_push($array_var, $_GET['categorie']);
          }
  
          if (isset($_GET['distributeur']) && $_GET['distributeur'] != 'distributeur') {
            $query_where .= "AND tp_film.id_distrib = ? ";
            array_push($array_var, $_GET['distributeur']);
          }
 
          $req = $bdd->prepare("SELECT tp_film.titre, tp_film.resum, tp_genre.nom 
                                FROM tp_film 
                                INNER JOIN tp_genre 
                                ON tp_film.id_genre = tp_genre.id_genre $query_where 
                                ORDER BY nom ASC"); 
          $req->execute($array_var);
          $titre = $req->fetchAll();  ?>

    
      <div id="film"> 
        <table>
          <tr>
            <th>GENRE</th>
            <th>TITRES</th>
            <th>RESUMER</th>
          </tr>
            <?php foreach ($titre as $value) { ?>       <!-- Je parcours tout mes titres -->
          <tr>
            <td class="premier"> <?php echo $value["nom"]; ?> </td>
            <td class="premier"> <?php echo $value["titre"]; ?> <br> <a href=""><i>ajouter un avis</i></a></td>
            <td id="resum"> <?php echo $value["resum"]; ?> </td>
          </tr>
            <?php
            }
            ?>
        </table>  
      </div>
    </div> <!-- Fin div princiaple -->
    <footer>
      <div id="contact">
       <p><a href="">Qui sommes-nous ?</a> | <a href="contact.php">Donnez votre avis</a> | <a href="">Mentions légales</a> | <a href="">Recrutement</a> | <a href="contact.php">Contact</a></p>
      </div>
      <p>© Copyright </p>
    </footer>
  </div>
</body>
</html>