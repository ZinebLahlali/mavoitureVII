<?php
  


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
                <select name="theme" required class="w-full px-4 py-2 border rounded-lg bg-white focus:ring focus:ring-red-300 focus:outline-none">
                    <option value="">-- Choisir un thème --</option>
                    <option value="SUV">SUV</option>
                    <option value="Citadine">Citadine</option>
                    <option value="Luxe">Luxe</option>
                    <option value="Électrique">Électrique</option>
                </select>
                <?php foreach()?>
                <input type="checkbox" value="2">
                </div>

                <!-- Tags -->
                <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Tags
                </label>
                <input type="text" name="tags" placeholder="ex: location, voiture, luxe"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-red-300 focus:outline-none">
                <p class="text-xs text-gray-500 mt-1">
                    Sépare les tags par des virgules
                </p>
                </div>

                <!-- Bouton -->
                <button type="submit"
                        class="w-full bg-red-700 text-white py-2 rounded-lg font-semibold hover:bg-red-800 transition">
                Publier l'article
                </button>

            </form>

</body>
</html>
