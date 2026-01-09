<?php
   require_once __DIR__ . '/../classes/Database.php';
   require_once __DIR__ . '/../classes/Theme.php';
   require_once __DIR__ . '/../classes/Article.php';
  


     
    $themes = Theme::listerTousActifs($pdo);

   //print_r($themes);
//    foreach($themes as $theme){
//     echo($theme->getIdTheme());
//    }


$article = new Article();

if(isset($_POST["ajouter"])){
    $article->setIdTheme($_POST['id_theme']);
     $article->setTitre($_POST['titre']);
      $article->setContenu($_POST['contenu']);

       $article->create($pdo);
}



   

?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un article</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

            <form method="POST" class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg space-y-5">
                <h2 class="text-2xl font-bold text-center text-gray-800">
                Ajouter un article</h2>

                <!-- Titre -->
                <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Titre
                </label>
                <input type="text" name="titre" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-red-300 focus:outline-none">
                </div>

                <!-- Contenu -->
                <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Contenu
                </label>
                <textarea name="contenu" rows="5" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-red-300 focus:outline-none"></textarea>
                </div>

                <!-- Thème -->
                <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Thème
                </label>
                <select name="id_theme"  required class="w-full px-4 py-2 border rounded-lg text-black focus:ring focus:ring-red-300 focus:outline-none">
                <option value="">-- Choisir un thème --</option>
                <?php foreach($themes as $theme):?>
                 <option value="<?= $theme->getIdTheme(); ?>"><?= htmlspecialchars($theme->getTitre()); ?></option> 
                <?php endforeach;?>
                </select>
                <!-- Bouton -->
                <button type="submit" name="ajouter"
                        class=" mt-9 w-full bg-red-700 text-white py-2 rounded-lg font-semibold hover:bg-red-800 transition">
                Publier l'article
                </button>

            </form>

</body>
</html>
