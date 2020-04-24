<?php
// root pad. Nodig voor alle include bestanden
define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/KL/i-project');

// root pad. Nodig voor html href links.
$root = '/KL/i-project';

// Dit is relevant voor alle pagina's die iets in de pagina hebben wat afwijkt van andere pagina's.
// Bijvoorbeeld contact pagina met google maps of admin pagina's zonder header
$url = $_SERVER['REQUEST_URI'];