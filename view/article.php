<?php
   require_once __DIR__ . '/../classes/Database.php';
   require_once __DIR__ . '/../classes/Theme.php';
   require_once __DIR__ . '/../classes/Article.php';
    require_once __DIR__ . '/../classes/Commentaire.php';


  

   $id_theme = $_GET['id']; 

    $articles = Article::listerParTheme($pdo, $id_theme);



    if(isset($_POST['like'])){
        $articles = Article:: rechercherParTitre($pdo, $_POST['like'], $id_theme);
    }







?>







<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Blog Location Voitures</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <section class="max-w-7xl mx-auto px-6 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-red-700 mb-3">Blog Location de Voitures</h1>
            <p class="text-gray-200">Découvrez nos articles sur les véhicules et conseils de location</p>
        </div>
    
    <div>
           <button class="bg-red-700 text-white px-6 py-2 rounded-xl hover:bg-red-800 transition flex justify-end items-end ">
            <a href="ajout_article.php?id_theme=<?= $id_theme ?>">
                Ajouter un article</a></button> 
        </div>

                <div class="max-w-2xl mx-auto my-8">
                    <form  method="POST" class="flex items-center">
                        <input  type="text" name="like" placeholder="Rechercher un article..."  class="w-full px-4 py-2 rounded-l-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-700 focus:border-red-700">
                        <button type="submit"  name="submit" class="bg-red-700 text-white px-6 py-2 rounded-r-xl hover:bg-red-800 transition"> Rechercher
                        </button>
                    </form>
                </div>

         
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <?php if(!empty($articles)):?>
             <?php foreach($articles as $art):?>
            <a href="article_details.php?id=<?= $art->getIdArticle()?>">
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition">
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-2xl font-bold text-gray-800"><?=htmlspecialchars($art->getTitre()) ?></h2>
                    <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full"><?=htmlspecialchars($art->getContenu()) ?></span>
                </div>
                <p class="text-gray-600 text-sm mb-3">
                    
                </p>
                <div class="flex justify-between items-center text-gray-500 text-xs">
                    <span><?=htmlspecialchars($art->getDatePublication())?></span>
                    <span><?=htmlspecialchars($art->getTags()) ?></span>
                </div>
            </div>
            </a>
            <?php endforeach;?>
            <?php endif;?>

        </div>
        

    </section>

</body>
</html>
