<?php
include_once './classes/Vehicule.php';
include_once './classes/Database.php';
include_once './classes/VehiculeRepository.php';
include_once './connexion.php';

  $db = new Database();
  $pdo = $db->getPdo();

     $database = new Database();
     $pdo = $database->getPdo();
     $VehiculeRepo  = new VehiculeRepository($pdo);

     $cars = $VehiculeRepo->listerPagine(5,0);
     foreach($cars as $vehicule){
        // echo $vehicule->getModele(). '' . $vehicule->getMarque() . '<br>';
     }




?>




<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MaBagnole | Location de voitures au Maroc</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50 font-sans">

  <header class="bg-white shadow-sm sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-2">
        <div class="bg-red-600 p-2 rounded-lg">
          <i class="fas fa-car text-white text-xl"></i>
        </div>
        <span class="font-bold text-2xl tracking-tight text-gray-800">LOCATION<span class="text-red-600">VOITURE</span>.ma</span>
      </div>

      <div class="hidden md:flex items-center space-x-8 font-medium text-gray-600">
        <a href="#" class="hover:text-red-600 transition">Accueil</a>
        <a href="index.php" class="hover:text-red-600 transition">Nos Voitures</a>
        <a href="#" class="hover:text-red-600 transition">Contact</a>
           <button id="openLogin" class="bg-red-600 text-white px-6 py-2 rounded-full hover:bg-red-700 transition shadow-md">
            Se connecter
        </button>
      </div>
      
      <button class="md:hidden text-gray-600"><i class="fas fa-bars text-2xl"></i></button>
         <span class="font-bold text-red-600">LOCATION-VOITURE.ma</span>
        
     
    </nav>
  </header>

  <section class="relative bg-gray-900 text-white py-20">
    <div class="absolute inset-0 opacity-40">
      <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&q=80&w=1920" alt="Background" class="w-full h-full object-cover">
    </div>
    <div class="container mx-auto px-6 relative z-10 text-center">
      <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Louez la voiture idéale</h1>
      <p class="text-xl mb-8 text-gray-200">Large choix de véhicules au meilleur prix à Casablanca.</p>

    </div>
  </section>
  <section>
    
<div class="grid grid-cols-3 gap-6 p-6">
<?php foreach($cars as $vehicule): ?>
    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow">
        <div class="relative">
            <img src="<?= htmlspecialchars($vehicule->getImage()) ?>" 
                 alt="" 
                 class="w-full h-48 object-cover">
        </div>
        <div class="p-4">
            <h3 class="text-lg font-semibold"><?= htmlspecialchars($vehicule->getMarque()) ?> <?= htmlspecialchars($vehicule->getModele()) ?></h3>
            <p class="text-gray-500 mt-1">Prix: <?= htmlspecialchars($vehicule->getPrix()) ?> DH</p>
            <p class="text-gray-500 mt-1">Disponibilité: <?= htmlspecialchars($vehicule->getDisponible()) ?></p>
            <div class="flex justify-between mt-2 text-sm text-gray-600">
                <span>🚗 <?= htmlspecialchars($vehicule->getNbPlaces()) ?></span>
                <span>🚪 <?= htmlspecialchars($vehicule->getBagages()) ?></span>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
  </section>

  <!--login-->

      <div id="loginModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden border border-gray-100">
            <div class="bg-red-600 p-6 text-white flex justify-between items-center">
                <h3 class="text-2xl font-bold">Connexion</h3>
                <button id="closeLogin" class="text-white hover:text-gray-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form method="POST" class="p-8 space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email"  name="email" placeholder="exemple@mail.com" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe</label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none">
                </div>

                <button type="submit" name="login" class="w-full bg-red-600 text-white font-bold py-3 rounded-xl hover:bg-red-700 transition shadow-lg">
                    Valider
                </button>
            </form>
        </div>
    </div>





  <footer class="bg-gray-900 text-white pt-16 pb-8">
    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
      <div>
        <span class="font-bold text-2xl tracking-tight">LOCATION<span class="text-red-600">VOITURE</span>.ma</span>
        <p class="mt-4 text-gray-400">Votre partenaire de confiance pour la location de véhicules au Maroc depuis 2010.</p>
      </div>
      <div>
        <h4 class="text-lg font-bold mb-6">Liens Rapides</h4>
        <ul class="space-y-4 text-gray-400">
          <li><a href="#" class="hover:text-white transition">Nos Agences</a></li>
          <li><a href="#" class="hover:text-white transition">Conditions Générales</a></li>
          <li><a href="#" class="hover:text-white transition">F.A.Q</a></li>
        </ul>
      </div>
      <div>
        <h4 class="text-lg font-bold mb-6">Newsletter</h4>
        <div class="flex shadow-sm">
          <input type="email" placeholder="Votre email" class="bg-gray-800 border-none rounded-l-lg px-4 py-2 w-full focus:ring-2 focus:ring-red-600">
          <button class="bg-red-600 px-4 py-2 rounded-r-lg hover:bg-red-700 transition"><i class="fas fa-paper-plane"></i></button>
        </div>
      </div>
    </div>
    <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
      <p>&copy; 2025 MaBagnole. Tous droits réservés.</p>
    </div>
  </footer>
  <script>
        const modal = document.getElementById('loginModal');
        const btnOpen = document.getElementById('openLogin');
        const btnClose = document.getElementById('closeLogin');

        // Fonction pour OUVRIR (Retirer 'hidden' et ajouter 'flex')
        btnOpen.onclick = function() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        // Fonction pour FERMER (Ajouter 'hidden' et retirer 'flex')
        btnClose.onclick = function() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // FERMER si on clique à l'extérieur du formulaire
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }
    </script>
</body>
</html>