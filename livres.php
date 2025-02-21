<?php
$erreurs = [];

session_start(); // Démarrer la session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'] ?? '';
    $nomAuteur = $_POST['nom_auteur'] ?? '';
    $civilite = $_POST['civilite'] ?? '';
    $anneePublication = $_POST['annee_publication'] ?? '';
    $nombrePages = $_POST['nombre_pages'] ?? '';
    $categorie = $_POST['categorie'] ?? '';
    $prix = $_POST['prix'] ?? '';
    $description = $_POST['description'] ?? '';
    $imageCouverture = $_POST['image_couverture'] ?? '';
    $lienVersPageAchat = $_POST['lien_vers_page_achat'] ?? '';

    // Validation des champs
    if (empty($titre)) {
        $erreurs['titre'] = 'Veuillez entrer un titre.';
    } elseif (strlen($titre) < 2 || strlen($titre) > 150) {
        $erreurs['titre'] = 'Le titre doit être compris entre 2 et 150 caractères.';
    }

    if (empty($nomAuteur)) {
        $erreurs['nom_auteur'] = 'Veuillez entrer le nom auteur.';
    } elseif (strlen($nomAuteur) < 2 || strlen($nomAuteur) > 150) {
        $erreurs['nom_auteur'] = 'Le nom de l\'auteur doit être compris entre 2 et 150 caractères.';
    }

    if (empty($civilite)) {
        $erreurs['civilite'] = 'Veuillez sélectionner une civilité.';
    }

    if (empty($anneePublication)) {
        $erreurs['annee_publication'] = 'Veuillez entrer une année de publication.';
    } elseif (!is_numeric($anneePublication) || strlen($anneePublication) != 4 || $anneePublication < 2000 || $anneePublication > 2025) {
        $erreurs['annee_publication'] = 'L\'année doit être comprise entre 2000 et 2025.';
    }

    if (empty($nombrePages)) {
        $erreurs['nombre_pages'] = 'Veuillez entrer le nombre de pages.';
    } elseif (!is_numeric($nombrePages) || $nombrePages < 10 || $nombrePages > 1000) {
        $erreurs['nombre_pages'] = 'Le nombre de pages doit être compris entre 10 et 1000.';
    }

    if (empty($categorie)) {
        $erreurs['categorie'] = 'Veuillez choisir une catégorie.';
    }

    if (empty($prix)) {
        $erreurs['prix'] = 'Veuillez entrer un prix.';
    } elseif (!is_numeric($prix) || $prix < 0 || $prix > 299) {
        $erreurs['prix'] = 'Le prix doit être compris entre 0 et 299.';
    }

    if (empty($description)) {
        $erreurs['description'] = 'Veuillez entrer une description.';
    } elseif (strlen($description) < 1 || strlen($description) > 500) {
        $erreurs['description'] = 'La description doit être comprise entre 1 et 500 caractères.';
    }

    if (empty($imageCouverture)) {
        $erreurs['image_couverture'] = 'Veuillez fournir une image de couverture.';
    }

    if (empty($lienVersPageAchat)) {
        $erreurs['lien_vers_page_achat'] = 'Veuillez fournir un lien vers la page d\'achat.';
    }

    // Si aucune erreur, rediriger vers details.php
    if (empty($erreurs)) {
        $_SESSION['livre'] = $_POST; // Stocker toutes les données du formulaire
        header("Location: details.php"); // Rediriger vers la page de détails
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livres</title>

    <style> 
        /* Styles de base pour le document Markdown */ 
        body { font-family: 'Open Sans', sans-serif; line-height: 1.6; max-width: 900px; margin: 0 auto; padding: 2rem; color: #333; word-wrap: balance; background-color: #f9f9f9; }

        /* Titres */ 
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; color: #2c3e50; margin-top: 1rem; font-weight: 600; }
        
        h1 { font-size: 2rem; solid #3498db; }
        
        h2 { font-size: 1.75rem; solid #2ecc71; } 
        
        h3 { font-size: 1.25rem; color:#301d87; } 
        
        h4 { font-size: 1rem; color: #9b59b6; } 
        
        /* Liens */ 
        a { color: #3498db; text-decoration: none; transition: all 0.3s ease; } 
        
        a:hover { color: #2980b9; } 
        
        /* Paragraphes et texte */ 
        p { text-align: justify; } 
        
        /* Listes */ 
        ul, ol { padding-left: 2rem; margin-bottom: 1rem; } 
        
        li { margin-bottom: 0.5rem; } 
        
        /* Code */ 
        code { background-color: #f8f9fa; padding: 0.2rem 0.4rem; border-radius: 4px; font-family: 'Fira Code', monospace; font-size: 0.9em; color: #e83e8c; } 
        
        pre { background-color: #2c3e50; color: #ecf0f1; padding: 1rem; border-radius: 8px; overflow-x: auto; margin: 1.5rem 0; } 
        
        pre code { background-color: transparent; color: inherit; padding: 0; } 
        
        /* Blockquotes */ 
        blockquote { border-left: 4px solid #3498db; margin: 1.5rem 0; padding: 1rem; background-color: #ecf0f1; font-style: italic; } 
        
        /* Tables */ 
        table { width: 100%; border-collapse: collapse; margin: 1.5rem 0; } 
        
        th, td { padding: 0.75rem; border:1px solid lightgrey !important; } 
        
        td{ } 
        
        th { background-color: #3498db; color: white; } 
        
        tr:nth-child(even) { background-color: #f8f9fa; } 
        
        /* Images */ 
        img { max-width: 100%; height: auto; border-radius: 8px; margin: 1.5rem 0; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); } 
        
        /* Séparateur horizontal */ 
        
        hr { border: 0; height: 2px; background: linear-gradient(to right, #3498db, #2ecc71); margin: 2rem 0; } 
        
        /* Mise en évidence */ 
        mark { background-color: #ffd700; padding: 0.2rem 0.4rem; border-radius: 4px; } 
        
        /* Animations de transition */ 
        * { transition: all 0.3s ease; } 

        /*La couleur pour les erreurs du formulaire*/
        .error { color: red; font-size: 14px; }
        
        /* Media Queries pour la responsivité */ 
        @media (max-width: 768px)
        { body { padding: 1rem; } h1 { font-size: 2rem; } h2 { font-size: 1.75rem; } h3 { font-size: 1.5rem; } h4 { font-size: 1.25rem; } } .module { font-size: 2.5rem; color: #f8f9fa; background-color: #3498db; text-align: center; padding: 0.5rem; margin: 1rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body>
    <!-- Le header -->
    <header>
        <nav>
            <a href="./home.php">Accueil</a>
            <a href="">Livres</a>
        </nav>
    </header>

    <h1>Ajout de livres</h1>

    <!-- Le formulaire -->
    <form action="" method="post">
        <label>Titre :</label>
        <input type="text" name="titre" value="<?= htmlspecialchars($titre ?? '') ?>">
        <br>
        <span class="error"><?= $erreurs['titre'] ?? '' ?></span>
        <br>

        <label>Nom de l'auteur :</label>
        <input type="text" name="nom_auteur" value="<?= htmlspecialchars($nomAuteur ?? '') ?>">
        <br>
        <span class="error"><?= $erreurs['nom_auteur'] ?? '' ?></span>
        <br>

        <label>Civilité :</label>
        <input type="radio" name="civilite" value="M." <?= isset($civilite) && $civilite == 'M.' ? 'checked' : '' ?>> M.
        <input type="radio" name="civilite" value="Mme" <?= isset($civilite) && $civilite == 'Mme' ? 'checked' : '' ?>> Mme
        <input type="radio" name="civilite" value="Mlle" <?= isset($civilite) && $civilite == 'Mlle' ? 'checked' : '' ?>> Mlle
        <br>
        <span class="error"><?= $erreurs['civilite'] ?? '' ?></span>
        <br>

        <label>Année de publication :</label>
        <input type="number" name="annee_publication" value="<?= htmlspecialchars($anneePublication ?? '') ?>">
        <br>
        <span class="error"><?= $erreurs['annee_publication'] ?? '' ?></span>
        <br>

        <label>Nombre de pages :</label>
        <input type="number" name="nombre_pages" value="<?= htmlspecialchars($nombrePages ?? '') ?>">
        <br>
        <span class="error"><?= $erreurs['nombre_pages'] ?? '' ?></span>
        <br>

        <label>Catégorie :</label>
        <input type="radio" name="categorie" value="roman" <?= isset($categorie) && $categorie == 'roman' ? 'checked' : '' ?>> Roman
        <input type="radio" name="categorie" value="poesie" <?= isset($categorie) && $categorie == 'poesie' ? 'checked' : '' ?>> Poésie
        <input type="radio" name="categorie" value="theatre" <?= isset($categorie) && $categorie == 'theatre' ? 'checked' : '' ?>> Théâtre
        <input type="radio" name="categorie" value="essai" <?= isset($categorie) && $categorie == 'essai' ? 'checked' : '' ?>> Essai
        <input type="radio" name="categorie" value="BD" <?= isset($categorie) && $categorie == 'BD' ? 'checked' : '' ?>> BD
        <input type="radio" name="categorie" value="jeunesse" <?= isset($categorie) && $categorie == 'jeunesse' ? 'checked' : '' ?>> Jeunesse
        <br>
        <span class="error"><?= $erreurs['categorie'] ?? '' ?></span>
        <br>

        <label>Prix :</label>
        <input type="number" name="prix" value="<?= htmlspecialchars($prix ?? '') ?>">
        <br>
        <span class="error"><?= $erreurs['prix'] ?? '' ?></span>
        <br>

        <label>Description :</label>
        <textarea name="description"><?= htmlspecialchars($description ?? '') ?></textarea>
        <br>
        <span class="error"><?= $erreurs['description'] ?? '' ?></span>
        <br>

        <label>Image de couverture :</label>
        <input type="url" name="image_couverture" value="<?= htmlspecialchars($imageCouverture ?? '') ?>">
        <br>
        <span class="error"><?= $erreurs['image_couverture'] ?? '' ?></span>
        <br>

        <label>Lien vers la page d'achat :</label>
        <input type="url" name="lien_vers_page_achat" value="<?= htmlspecialchars($lienVersPageAchat ?? '') ?>">
        <br>
        <span class="error"><?= $erreurs['lien_vers_page_achat'] ?? '' ?></span>
        <br>

        <button type="submit">Soumettre</button>
    </form>

    <!-- Le footer -->
    <footer>
        Mauduit Raphaël <span id="annee"></span>
    </footer>

    <script>
        document.getElementById("annee").textContent = new Date().getFullYear();
    </script>
</body>
</html>