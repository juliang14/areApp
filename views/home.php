<?php
// views/home.php

// Define el contenido para esta vista
ob_start();
?>
<div class="container my-5">
  <h1>Welcome to Arepa Sales</h1>
  <p>Discover our delicious arepas!</p>
  <!-- aquí podrías listar productos destacados -->
</div>
<?php
$content = ob_get_clean();

// Renderiza el layout principal
include __DIR__ . '/layout.php';
