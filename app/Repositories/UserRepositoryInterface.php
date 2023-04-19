<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function register($data);

    public function login($data);

}
