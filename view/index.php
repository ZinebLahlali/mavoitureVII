<?php
include_once './classes/Vehicule.php';
include_once './classes/Database.php';
include_once './classes/VehiculeRepository.php';
include_once 'connexion.php';

  $db = new Database();
  $pdo = $db->getPdo();
  
  $vehicules = Vehicule::listerTous(); 


  //search
           if(isset($_POST['submit'])) {
            $key = $_POST['key'];
             $search = "%$key%";
             $vehiculeRepo = new VehiculeRepository($pdo);
             $vehicules = $vehiculeRepo->searchParModel($search);
           
            
             


     }   

     //filtering
       if(isset($_POST['submit'])){
            $key = $_POST['key'];
             $NomCategories = "%$key%";
             $vehiculeRepo = new VehiculeRepository($pdo);
             $vehicules = $vehiculeRepo->filtrerParCategorie($NomCategories);

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
        <a href="Home.php" class="hover:text-red-600 transition">Accueil</a>
        <a href="#" class="hover:text-red-600 transition">Nos Voitures</a>
        <a href="#" class="hover:text-red-600 transition">Contact</a>
      </div>
      
      <button class="md:hidden text-gray-600"><i class="fas fa-bars text-2xl"></i></button>
         <span class="font-bold text-red-600">LOCATION-VOITURE.ma</span>
    </nav>
  </header>

 

    <!-- <div id="loginModal" class="fixed inset-0 z-50 items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden border border-gray-100">
            <div class="bg-red-600 p-6 text-white flex justify-between items-center">
                <h3 class="text-2xl font-bold">Connexion</h3>
                <button id="closeLogin" class="text-white hover:text-gray-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form  method="POST"  class="p-8 space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input name="email" type="email" placeholder="exemple@mail.com" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe</label>
                    <input  name="password_hash" type="password" placeholder="••••••••" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none">
                </div>

                <button  name="login" type="submit" class="w-full bg-red-600 text-white font-bold py-3 rounded-xl hover:bg-red-700 transition shadow-lg">
                    Valider
                </button>
            </form>
        </div>
    </div> -->

  

       

  <section class="relative bg-gray-900 text-white py-20">
    <div class="absolute inset-0 opacity-40">
      <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&q=80&w=1920" alt="Background" class="w-full h-full object-cover">
    </div>
    <div class="container mx-auto px-6 relative z-10 text-center">
      <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Louez la voiture idéale</h1>
      <p class="text-xl mb-8 text-gray-200">Large choix de véhicules au meilleur prix à Casablanca.</p>
      
    </div>
  </section>

  <section id="fleet" class="container mx-auto px-6 py-16">
             
            <div class="container mx-auto mt-10 mb-10 px-4">
                    <form method="POST" action="index.php" class="flex items-center justify-center gap-3 bg-white p-4 rounded-2xl shadow-lg max-w-xl mx-auto">
                            <input type="text" name="key" placeholder="Rechercher une voiture..."
                                class="flex-1 px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                           <input type="submit" name="submit" value="Rechreche" 
                           class="px-6 py-2 rounded-full bg-blue-500 text-white font-medium hover:bg-blue-600 active:scale-95 transition shadow-md">
                    </form>
            </div>
            <div >
                <?php
                 if (!empty($result)) {
                        foreach ($result as $car) {
                            echo '<h4>' . htmlspecialchars($car['modele']) . ' ' . htmlspecialchars($car['categorie']) . '</h4>';
                        }
                    }
                    // } else {
                    //     echo '<h4 class="text-danger">Aucune voiture trouvée !</h4>';
                    // }

                    
                ?>
            </div>


    <div class="flex justify-between items-end mb-12">
      <div>
        <h2 class="text-3xl font-bold text-gray-800">Véhicules disponibles</h2>
        <div class="h-1 w-20 bg-red-600 mt-2"></div>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach($vehicules as $vehicule): ?>
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow group">
        <div class="relative overflow-hidden">
          <img src="<?php echo htmlspecialchars($vehicule["image"]);  ?>" class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
          <span   class="absolute top-4 right-4 bg-white px-3 py-1 rounded-full text-sm font-bold shadow-sm"><?php echo htmlspecialchars($vehicule["prix"]); ?>DH</span>
        </div>
        <div class="p-6">

          <h4 class="text-xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($vehicule["marque"]);  ?></h4>
          <h4 class="text-xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($vehicule["categorie"]);  ?></h4>
          
          <a href="details.php?id=<?= $vehicule['id_car'] ?>" class="block text-center bg-gray-100 text-gray-800 font-bold py-3 rounded-xl hover:bg-red-600 hover:text-white transition-colors">Voir détails</a>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </section>

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



    <!-- <script>
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

        document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("loginModal").classList.remove("hidden");
        document.getElementById("loginModal").classList.add("flex");
        });
    </script> -->


</body>
</html>