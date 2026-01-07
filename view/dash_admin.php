<?php
include_once './classes/Vehicule.php';
include_once './classes/Database.php';
include_once './classes/VehiculeRepository.php';

  $db = new Database();
  $pdo = $db->getPdo();
  
  $vehicules = Vehicule::listerTous(); 
  //nombre vehicules
  $cars =  new VehiculeRepository($pdo);
  $nombreVoitures = $cars->countVehicules();

  //nombre category
  $cate =  new VehiculeRepository($pdo);
  $nombreCategories = $cars->countCategories();

  //nombre clients
  $users = new VehiculeRepository($pdo);
  $nombreUsers = $users->countUsers();

 //nombre réservations
  $reserv = new VehiculeRepository($pdo);
  $nombrereservation = $reserv->countUsers();





?>






<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="flex h-screen">

  <!-- Sidebar -->
  <aside class="w-64 bg-red-700 text-white shadow-lg">
    <div class="p-6 text-2xl font-bold border-b border-red-600">
      Admin Panel
    </div>
    <nav class="p-4 space-y-2">
      <a href="#" class="block py-2 px-4 rounded hover:bg-red-600">Dashboard</a>
      <a href="#" class="block py-2 px-4 rounded hover:bg-red-600">Users</a>
      <a href="#" class="block py-2 px-4 rounded hover:bg-red-600">Orders</a>
      <a href="#" class="block py-2 px-4 rounded hover:bg-red-600">Products</a>
      <a href="#" class="block py-2 px-4 rounded hover:bg-red-600">Settings</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-8 overflow-y-auto">

    <!-- Top Bar -->
    <header class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-red-700">Dashboard</h1>
      <button class="bg-red-700 text-white px-4 py-2 rounded hover:bg-red-800">
        Logout
      </button>
    </header>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <div class="bg-white p-6 rounded-xl shadow border-l-4 border-red-700">
        <p class="text-gray-500">Les clients</p>
        <h2 class="text-3xl font-bold"><?= $nombreUsers ?></h2>
      </div>
      <div class="bg-white p-6 rounded-xl shadow border-l-4 border-red-700">
        <p class="text-gray-500">Les véhicules</p>
        <h2 class="text-3xl font-bold"><?= $nombreVoitures ?></h2>
      </div>
      <div class="bg-white p-6 rounded-xl shadow border-l-4 border-red-700">
        <p class="text-gray-500">Les categories</p>
        <h2 class="text-3xl font-bold"><?= $nombreCategories ?></h2>
      </div>
      <div class="bg-white p-6 rounded-xl shadow border-l-4 border-red-700">
        <p class="text-gray-500">les réservations</p>
        <h2 class="text-3xl font-bold"><?=$nombrereservation ?></h2>
      </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow p-6">
      <h2 class="text-2xl font-bold mb-4 text-red-700">Les véhicules</h2>

      <div class="overflow-x-auto">
        <table class="w-full text-left">
          <thead class="bg-red-700 text-white">
            <tr>
              <th class="p-3">Marque</th>
              <th class="p-3">Modele</th>
              <th class="p-3">Prix</th>
              <th class="p-3">Disponible</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($vehicules as $vehicule): ?>
            <tr class="border-b hover:bg-gray-100">
              <td class="p-3"><?php echo htmlspecialchars($vehicule["marque"]);  ?></td>
              <td class="p-3"><?php echo htmlspecialchars($vehicule["modele"]);  ?></td>
              <td class="p-3"><?php echo htmlspecialchars($vehicule["prix"]);  ?>DH</td>
              <td class="p-3 text-green-600 font-semibold"><?php echo htmlspecialchars($vehicule["disponible"]);  ?></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>

  </main>
</div>

</body>
</html>
