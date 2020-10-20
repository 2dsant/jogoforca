<?php

require_once './src/Functions.php';

// Realiza a instancia direta das classes por meio da url informada
require_once './Controller/IndexController.php';

// Alterar daqui para baixo
require_once './Controller/ForcaController.php';
// Alterar daqui para cima

$p = $_GET['p'] ? $_GET['p'] . 'controller' : 'ForcaController';

$op = $_GET['op'] ?? 'perguntaPalavra';


eval("(new $p )->$op();");