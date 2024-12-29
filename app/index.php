<?php

// Carregar o arquivo de rotas
$routes = require_once(__DIR__ . '/routes/routes.php');

// Check if routes were loaded properly and handle the error
if (!is_array($routes)) {
    // Handle the error (e.g., log it or display a user-friendly message)
    echo "Error loading routes file.";
    exit;
}

// Obter a URL e o método HTTP
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Remover qualquer parâmetro de consulta da URL
$requestPath = strtok($requestUri, '?');
$found = false;

foreach ($routes as $route => $handler) {
    
   if (preg_match('#^' . preg_replace('#\{([a-z0-9]+)\}#', '(?<$1>[^/]+)', $route) . '$#', $requestPath, $matches)) {
         $params = array_filter($matches, function ($key) {
            return !is_numeric($key);
         }, ARRAY_FILTER_USE_KEY);
        
          if(count($params) > 0){
               call_user_func_array($handler, $params);
            } else{
                 call_user_func($handler);
            }
        $found = true;
        break;
    }
}


// Se não encontrou nenhuma rota, exibe uma mensagem de erro
if (!$found) {
     require_once("./View/index.php");
}
exit;