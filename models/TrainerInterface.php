<?php
interface TrainerInterface {
    public function count(): int;
    public function getPaginated(int $limit, int $offset): array;
    public function getById(int $id): object|null;
    public function create(): bool;
    public function update(): bool;
    public function delete(int $id): bool;
}
