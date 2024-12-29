<?php
// cli-config.php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once "vendor/autoload.php"; // Carrega o autoload do Composer

// Criação de uma configuração simples para Doctrine ORM usando Atributos
$config = ORMSetup::createAttributeMetadataConfiguration(
  paths: [__DIR__ . '/Models'],
  isDevMode: true // Ativa o modo de desenvolvimento
);

// Configuração da conexão com o banco de dados
$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql', // Exemplo com MySQL, altere conforme necessário
    'user' => 'root',
    'password' => 'root',
    'dbname' => 'contacts',
    'host' => 'db', // Nome do serviço MySQL no docker-compose.yml
    'port' => 3306, // Porta padrão do MySQL dentro do container
], $config);

// Obtendo o EntityManager
$entityManager = new EntityManager($connection, $config);

// Inicializa o ConsoleRunner com o EntityManager
ConsoleRunner::run(
    new \Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider($entityManager)
);
