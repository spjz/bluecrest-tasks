<?php

namespace App\Interfaces;

use App\Models\User as User;

interface TaskRepositoryInterface
{
    public function index();
    public function forUser(User $user);
    public function paginate($items);
    public function getById($id);
    public function store(User $user, array $data);
    public function update(array $data, $id);
    public function delete($id);
}
