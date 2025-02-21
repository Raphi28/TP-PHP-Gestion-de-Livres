<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

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
            <a href="">Accueil</a>
            <a href="./livres.php">Livres</a>
        </nav>
    </header>

    <h1>Liste des livres</h1>

    <!-- Afficher les livres stockés -->
    <?php
    $fichier = "livres.txt";
    // Vérifie si le fichier existe et contient du contenu
    if (file_exists($fichier) && filesize($fichier) > 0) {
        $contenu = file_get_contents($fichier);
        echo "<pre>" . htmlspecialchars($contenu) . "</pre>";
        echo '<button><a href="./partage.php?key=page_partage">Partage</a></button>';
    } else {
        echo "<p>Aucune donnée disponible.</p>";
        }
    ?>

    

    <!-- Le footer -->
    <footer>
        Mauduit Raphaël <span id="annee"></span>
    </footer>

    <script>
        document.getElementById("annee").textContent = new Date().getFullYear();
    </script>
</body>
</html>