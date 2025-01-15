<?php

interface IRepository
{
    public function add($entity): bool;
    public function update($entity): bool;
    public function delete($entity): bool;
    public function getAll(): array;
    public function getById(int $id): array;
    public function filterBy(int $condition): array;
}