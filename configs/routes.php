<?php

return [
    'home'              => [
        'action'        => [HomeController::class, 'home']
    ],
    'add_category'      => [
        
        'action'        => [CategoryController::class, 'add']
    ],
    'add_room'          => [
        
        'action'        => [RoomController::class, 'add']
    ],
    'chat'              => [
        
        'action'        => [MessageController::class, 'add']
    ],
    'register'          => [
        
        'action'        => [UserController::class, 'add']
    ],
    'logout'            => [
        
        'action'        => [UserController::class, 'connect']
    ],
    'login'             => [
        
        'action'        => [UserController::class, 'connect']
    ],
    'profil'            => [
        
        'action'        => [UserController::class, 'update']
    ],
    'private'           => [
        
        'action'        => [UserController::class, 'liste']
    ],
    'private_message'   => [
        
        'action'        => [PrivateMessageController::class, 'add']
    ]    
];

?>