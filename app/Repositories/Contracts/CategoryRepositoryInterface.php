<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    public function all();
    public function get($id);
    public function save($request);
    public function update($request);
    public function delete($id);
}
