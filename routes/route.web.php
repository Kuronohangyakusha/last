<?php

use App\Controller\CompteController;
use App\Controller\InscriptionController;
use App\Controller\LoginController;
use App\Controller\TransactionController;
use App\Entity\Compte;

$TabUri = [
   
    '/' => [
        'controller' => LoginController::class,
        'method' => "index"
    ],
   
    '/liste' => [
        'controller' => CompteController::class,
        'method' => "index",
        'middlewares' => ['auth']
    ],
   '/dologin' => [
        'controller' => LoginController::class,
        'method' => "login",
   ],
    '/inscription'=>[
        'controller' => InscriptionController::class,
        'method' => "create"
    ],
   '/register' => [
    'controller' => InscriptionController::class,
    'method' => "store"
]
   
];