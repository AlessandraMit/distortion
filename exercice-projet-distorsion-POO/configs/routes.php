<?php

return [
    'home'          => [
        'action' => [HomeController::class, 'home']
    ],
    'add_category'  => [
        
        'action' => [CategoryController::class, 'add']
    ],
    'add_room'  => [
        
        'action' => [RoomController::class, 'add']
    ],
    'delete_room'  => [
        
        'action' => [RoomController::class, 'delete']
    ],
    'chat'  => [
        
        'action' => [MessageController::class, 'add']
    ],
    'register'  => [
        
        'action' => [UserController::class, 'add']
    ],
    'logout'  => [
        
        'action' => [UserController::class, 'connect']
    ],
    'login'  => [
        
        'action' => [UserController::class, 'connect']
    ],
    'profil'  => [
        
        'action' => [UserController::class, 'update']
    ]
];

?>