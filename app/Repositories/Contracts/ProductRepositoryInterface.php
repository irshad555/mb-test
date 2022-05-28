<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function all();
    public function get($id);
    public function save($request);
    public function update($request);
    public function delete($id);
}
