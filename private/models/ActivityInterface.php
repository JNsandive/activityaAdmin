<?php
interface ActivityInterface {
    public function count(): int;
    public function getPaginated(int $limit, int $offset): array;
    public function getById(int $id): object|null;
}
