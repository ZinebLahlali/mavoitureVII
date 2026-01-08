<?php
  require_once __DIR__ . '/../classes/Database.php';
  require_once __DIR__ . '/../classes/Theme.php';


   $db = new Database();
   $pdo = $db->getPdo();

 
    $th = Theme::listerTousActifs($pdo);
 

  

  





?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Thèmes de véhicules</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-400 min-h-screen">

    <section class="max-w-7xl mx-auto px-6 py-16">

        <!-- Titre -->
        <div class="text-center mb-14">
            <h1 class="text-4xl font-extrabold text-white mb-3">
                Nos thèmes de véhicules
            </h1>
            <p class="text-red-100 max-w-2xl mx-auto">
                Découvrez nos catégories de voitures adaptées à tous vos besoins de location
            </p>
        </div>

        <!-- Grille -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Card -->
             <?php if(!empty($th)): ?>
             <?php foreach($th as $theme): ?>
             <a href="article.php?id=<?= $theme->getIdTheme() ?>">   
            <div class="bg-white rounded-3xl shadow-xl p-8 hover:-translate-y-1 hover:shadow-2xl transition">
                <span class="inline-block text-xs font-semibold text-red-700 bg-red-100 px-3 py-1 rounded-full mb-4">
                    Actif
                </span>
                <h2 class="text-2xl font-bold text-gray-800 mb-3"><?= htmlspecialchars($theme->getTitre()) ?></h2>
                <p class="text-gray-600 text-sm leading-relaxed"><?=  htmlspecialchars($theme->getDescription()) ?></p>
            </div>
            <?php endforeach; ?>
             <?php endif;?>
        </div>
             </a>
    </section>

</body>
</html>
