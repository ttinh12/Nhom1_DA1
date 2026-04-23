<?php
require_once __DIR__ . '/../../Model/User.php';

class UserController
{
    private $user;

    public function __construct($connect)
    {
        $this->user = new User($connect);
    }

    public function index()
    {
        $users = $this->user->getAll();

        require_once __DIR__ . '/../View/Modules/users/index.php';
    }
}