<?php

interface IRepository
{
    public function add($entity): bool | int;
    public function update($entity): bool;
    public function delete($entity): bool;
    public function getAll(): array;
    public function getById(int $id): array | bool;
    public function filterBy(int $condition): array;
}
