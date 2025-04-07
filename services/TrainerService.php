<?php
require_once __DIR__ . '/../models/TrainerInterface.php';

class TrainerService {
    private TrainerInterface $trainer;

    public function __construct(TrainerInterface $trainer) {
        $this->trainer = $trainer;
    }

    public function getPaginatedFormatted(int $limit, int $offset): array {
        $results = $this->trainer->getPaginated($limit, $offset);

        // Example: format email to lowercase (you can add more logic here)
        foreach ($results as $r) {
            $r->email = strtolower($r->email);
        }

        return $results;
    }

    public function getTotal(): int {
        return $this->trainer->count();
    }

    public function getOneById(int $id): object|null {
        return $this->trainer->getById($id);
    }

    public function createTrainer(array $data): bool {
        $trainer = $this->trainer;
        $trainer->name = $data['name'];
        $trainer->email = $data['email'];
        $trainer->location = $data['location'];
        $trainer->certifications = $data['certifications'];
        $trainer->years = (int)$data['years'];
        $trainer->specialization = $data['specialization'];
        return $trainer->create();
    }
    
    public function updateTrainer(int $id, array $data): bool {
        $trainer = $this->trainer;
        $trainer->id = $id;
        $trainer->name = $data['name'];
        $trainer->email = $data['email'];
        $trainer->location = $data['location'];
        $trainer->certifications = $data['certifications'];
        $trainer->years = (int)$data['years'];
        $trainer->specialization = $data['specialization'];
        return $trainer->update();
    }
    
    public function deleteTrainer(int $id): bool {
        return $this->trainer->delete($id);
    }
    
}
