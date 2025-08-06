<?php
// views/layout.php

// Carga el header (menú)
include __DIR__ . '/partials/header.php';

// Contenido dinámico
echo $content;

// Carga el footer
include __DIR__ . '/partials/footer.php';
