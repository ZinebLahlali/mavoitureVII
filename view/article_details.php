<?php
   require_once __DIR__ . '/../classes/Database.php';
   require_once __DIR__ . '/../classes/Theme.php';
   require_once __DIR__ . '/../classes/Article.php';
   require_once __DIR__ . '/../classes/Commentaire.php';

    $id_theme = $_GET['id']; 

    $articles = Article::listerParTheme($pdo, $id_theme);

    $commentaire = Commentaire::listerParArticle($pdo,$id_article);


    if(isset($_POST['submit'])){
       
    }













?>












<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Détails de l'article</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

  <!-- HERO -->
  <section class="relative h-[420px]">
    <img
      src="https://via.placeholder.com/1600x600"
      class="absolute inset-0 w-full h-full object-cover"
      alt="Article image"
    />
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative max-w-5xl mx-auto px-6 h-full flex flex-col justify-center">
      <span class="inline-block w-fit mb-4 px-4 py-1 text-sm font-semibold bg-red-600 text-white rounded-full">
        Location de voiture
      </span>

      <h1 class="text-4xl md:text-5xl font-extrabold text-white leading-tight">
        Comment choisir la meilleure voiture de location
      </h1>
      <?php if(!empty($articles)):?>
      <?php foreach($articles as $art):?>
      <p class="mt-4 text-gray-200">
        Publié le <?=htmlspecialchars($art->getDatePublication()) ?>
      </p>
      <?php endforeach;?>
      <?php endif;?>
    </div>
  </section>

  <!-- MAIN CONTENT -->
  <main class="max-w-5xl mx-auto px-6 -mt-20 relative z-10">
    <?php if(!empty($articles)):?>
    <?php foreach($articles as $art):?>
<article class="bg-white rounded-3xl shadow-2xl p-10">

    
      <div class="prose max-w-none text-gray-800 leading-relaxed">
        <p><?=htmlspecialchars($art->getTitre()) ?></p>

        <p><?=htmlspecialchars($art->getContenu()) ?> </p>
      </div>

      <div class="my-10 border-t">
        <ul>
            <li><?=htmlspecialchars($art->getTags())?></li>
        </ul>
      </div>

</article>
      <?php endforeach;?>
      <?php endif;?>



    <section class="max-w-3xl mx-auto px-4 mt-8">

            <!-- Form de commentaire -->
            <form method="POST"  class="flex gap-2 mb-6">
                <input
                type="text" placeholder="Ajouter un commentaire..." name="commentaire"
                class="flex-1 px-4 py-2 border rounded focus:outline-none focus:ring-1 focus:ring-gray-400" required/>
                <button type="submit" name="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900">
                Publier
                </button>
            </form>


            <!-- Comment -->
             <?php if(!empty($commentaire)):?>
             <?php foreach($commentaire as $comm):?>
            <div class="flex items-center justify-between border-b py-2">
                <div>
                <p class="text-gray-800"><?= htmlspecialchars($comm->getcontenu()) ?></p>
                <span class="text-sm text-gray-500"><?= $comm->getDateCommentaire()?></span>
                </div>

                <div class="flex gap-2 text-sm">
                <button class="text-blue-600 hover:underline">
                    Modifier
                </button>
                <button class="text-red-600 hover:underline">
                    Supprimer
                </button>
                </div>
            </div>
            <?php endforeach;?>
            <?php endif; ?>

           

    </section>












  </main>

</body>
</html>
