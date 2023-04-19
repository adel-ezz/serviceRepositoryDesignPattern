<?php

namespace App\Repositories;

interface OrderRepositoryInterface
{
    public function save($data);

    public function show($id);
}
