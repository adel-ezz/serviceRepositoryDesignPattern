<?php

namespace App\Repositories;

interface ItemRepositoryInterface
{
    public function getAll();

    public function show($id);
}
