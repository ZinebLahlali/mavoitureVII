<?php
// session_start();

include_once './classes/Vehicule.php';
include_once './classes/Database.php';
include_once './classes/Reservation.php';
include_once 'connexion.php';
include_once 'avis_submit.php';

  $db = new Database();
  $pdo = $db->getPdo();
 

 $id_car = $_GET['id'] ?? null;
//  echo $id_car;
//  echo $_SESSION['id'];

  if($id_car){
    $vehicule = Vehicule::getById($id_car);
  }

//Ajouter réservation
  if(isset($_POST['submit'])){
        $id_client = $_SESSION['id'] ; 
        $dateDebut = $_POST['date_debut'] ?? '';
        $dateFin = $_POST['date_fin'] ?? '';
        $lieuD = $_POST['lieu_depart'] ?? '';
        $lieuR = $_POST['lieu_retour'] ?? '';
        $statut = 'available';
       

        $reservation = new Reservation();

        $reservation->setDateDebut($dateDebut);
        $reservation->setDateFin($dateFin);
        $reservation->setLieuD($lieuD);
        $reservation->setLieuR($lieuR);
        $reservation->setClient($id_client);
        $reservation->setVehicule($id_car);

        $isDisponible = $reservation->isDisponible($id_car, $dateDebut, $dateFin);

        if ($isDisponible) {
            $reservation->creer();
            header('Location: details.php');
            exit;
        } else {
            echo "Cette voiture n'est pas disponible pour ces dates.";
        }

   
  }


  // //Ajouter avis
  // if(isset($_POST["avis"])){
  //     $id_car = $_POST['id_vehicule'];
  //     $id_client = $_SESSION['id']; 
  //     $note = $_POST['note'] ?? '';
  //     $commentaire = $_POST['commentaire'] ?? '';
      
  //     $av = new Avis();
  //     $av->setIdClient($id_client);
  //     $av->setIdVehicule($id_car);
  //     $av->setNote($note);
  //     $av->setComment($commentaire);

  //     echo $av->AddComment();


  // }







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

  <!-- Header -->
  <header class="bg-white shadow-sm sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-2">
        <div class="bg-red-600 p-2 rounded-lg">
          <i class="fas fa-car text-white text-xl"></i>
        </div>
        <span class="font-bold text-2xl tracking-tight text-gray-800">LOCATION<span class="text-red-600">VOITURE</span>.ma</span>
      </div>

      <div class=" md:flex items-center space-x-8 font-medium text-gray-600">
        <a href="Home.php" class="hover:text-red-600 transition">Accueil</a>
        <a href="index.php" class="hover:text-red-600 transition">Nos Voitures</a>
        <a href="#" class="hover:text-red-600 transition">Contact</a>
        <button id="openPopup"  class="bg-red-600 text-white px-6 py-3 rounded-xl hover:bg-red-700 transition">
            Réserver cette voiture </button>
      </div>
      
      <button class="md:hidden text-gray-600"><i class="fas fa-bars text-2xl"></i></button>
    </nav>
  </header>

  <!-- Fleet Section -->
  <section id="fleet" class="container mx-auto px-6 py-16">
    <div class="flex justify-between items-end mb-12">
      <h2 class="text-3xl font-bold text-gray-800">Notre flotte</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Example Vehicle Card -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow group">
        <!-- Image -->
        <div class="relative overflow-hidden">
          <img src="<?php echo htmlspecialchars($vehicule['image']); ?>" 
               class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
          <span class="absolute top-4 right-4 bg-white px-4 py-1 rounded-full text-sm font-bold shadow-sm">
            Le prix/Jour: <?php echo htmlspecialchars($vehicule['prix']); ?> DH
          </span>
        </div>

        <!-- Main info -->
        <div class="p-6">
          <h4 class="text-xl font-bold text-gray-800 mb-1">
            Marque: <?php echo htmlspecialchars($vehicule['marque']); ?>
          </h4>
          <h4 class="text-lg font-semibold text-gray-600">
            Catégorie: <?php echo htmlspecialchars($vehicule['categorie']); ?>
          </h4>
        </div>

        <!-- Details -->
        <div class="px-6 pb-6 grid grid-cols-2 gap-4 text-gray-700">
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-user-group text-green-600"></i>
            <span class="font-medium">Nombre places: <?php echo htmlspecialchars($vehicule['nb_places']); ?></span>
          </div>
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-gas-pump text-green-600"></i>
            <span class="font-medium">Carburant: <?php echo htmlspecialchars($vehicule['carburant']); ?></span>
          </div>
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-gears text-green-600"></i>
            <span class="font-medium">Boite vitesse: <?php echo htmlspecialchars($vehicule['boit_vitesse']); ?></span>
          </div>
          <div class="flex items-center gap-3">
            <i class="fa-solid fa-suitcase text-green-600"></i>
            <span class="font-medium">Bagages: <?php echo htmlspecialchars($vehicule['bagages']); ?></span>
          </div>
        </div>
      </div>

                 <!-- Reservation Form Card -->
                       
                <!-- Popup -->
                <div id="reservationPopup" 
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">

                <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg p-8 relative">
                    
                    <!-- Bouton fermer -->
                    <button id="closePopup" 
                            class="absolute top-4 right-4 text-gray-500 hover:text-red-600 text-2xl font-bold">
                    &times;
                    </button>

                    <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Réservez votre véhicule</h2>
                    
                    <form method="POST" id="reservationForm" class="space-y-5">

                    <!-- Dates -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4"><div>
                        <label for="startDate" class="block text-sm font-medium mb-1 text-gray-700">Date de début</label>
                        <input type="date" id="startDate" name="date_debut" 
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"/>
                        </div>
                        <div>
                        <label for="endDate" class="block text-sm font-medium mb-1 text-gray-700">Date de fin</label>
                        <input type="date" id="endDate" name="date_fin" 
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"/>
                        </div>
                    </div>

                    <!-- Lieux -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                        <label for="pickup" class="block text-sm font-medium mb-1 text-gray-700">Lieu de prise</label>
                        <select id="pickup" name="lieu_depart" 
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">Sélectionner un lieu</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Marrakech">Marrakech</option>
                        </select>
                        </div>
                        <div>
                        <label for="dropoff" class="block text-sm font-medium mb-1 text-gray-700">Lieu de retour</label>
                        <select id="dropoff" name="lieu_retour" 
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            <option value="">Sélectionner un lieu</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Marrakech">Marrakech</option>
                        </select>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" name="submit"
                            class="w-full bg-red-600 text-white font-semibold py-3 rounded-xl hover:bg-red-700 shadow-lg transition-colors">
                        Réserver maintenant
                    </button>

                    </form>
                </div>
                </div>


                        <!-- Commentaires -->
                        <div class="mb-8">
                                <h2 class="text-2xl font-bold mb-4 text-red-700">Commentaires</h2>

                                <?php foreach($avis as $avi): ?>
                                    <div class="space-y-4">
                                        <div class="bg-gray-100 p-4 rounded">
                                            <p class="font-semibold text-red-700"><?= htmlspecialchars($avi['note']); ?></p>
                                            <p><?= htmlspecialchars($avi['commentaire']); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                        </div>

        <!-- Formulaire pour ajouter un commentaire -->
                 <form method="POST" class="max-w-md mx-auto bg-white p-6 rounded-xl shadow space-y-4">
                    <input type="hidden" name="avis"  >

                <!-- Note (évaluation) -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Évaluation (1-5)</label>
                    <select name="note" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-red-700">
                    <option value="">Sélectionnez une note</option>
                    <option value="1">1 ⭐</option>
                    <option value="2">2 ⭐⭐</option>
                    <option value="3">3 ⭐⭐⭐</option>
                    <option value="4">4 ⭐⭐⭐⭐</option>
                    <option value="5">5 ⭐⭐⭐⭐⭐</option>
                    </select>
                </div>

                <!-- Commentaire -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Commentaire</label>
                    <textarea name="commentaire" rows="4"
                            placeholder="Ajoutez votre commentaire ici..."
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-red-700"></textarea>
                </div>

                <!-- Bouton d'envoi -->
                <button type="submit" name="submit"
                        class="w-full bg-red-700 text-white font-semibold py-3 rounded-xl hover:bg-red-800 transition">
                    Envoyer le commentaire
                </button>

                </form>

                 </div>







    </div>
  </section>

  <!-- Footer -->
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

                <!-- JS pour ouvrir/fermer le popup -->
                <script>
                const openBtn = document.getElementById('openPopup');
                const popup = document.getElementById('reservationPopup');
                const closeBtn = document.getElementById('closePopup');

                openBtn.addEventListener('click', () => {
                    popup.classList.remove('hidden');
                });

                closeBtn.addEventListener('click', () => {
                    popup.classList.add('hidden');
                });

                // Fermer le popup si on clique en dehors
                popup.addEventListener('click', (e) => {
                    if(e.target === popup){
                    popup.classList.add('hidden');
                    }
                });
                </script>
</body>
</html>
