<?php
require_once __DIR__ . '/../models/TrainerInterface.php';
require_once __DIR__ . '/../utils/Logger.php';

class TrainerService {
    private TrainerInterface $trainer;

    public function __construct(TrainerInterface $trainer) {
        $this->trainer = $trainer;
    }

    /**
     * Get paginated and formatted trainers
     */
    public function getPaginatedFormatted(int $limit, int $offset): array {
        try {
            $results = $this->trainer->getPaginated($limit, $offset);
            foreach ($results as $r) {
                $r->email = strtolower($r->email);
            }
            return $results;
        } catch (Throwable $e) {
            Logger::error('TrainerService::getPaginatedFormatted', $e->getMessage());
            return [];
        }
    }

    /**
     * Get total number of trainers
     */
    public function getTotal(): int {
        try {
            return $this->trainer->count();
        } catch (Throwable $e) {
            Logger::error('TrainerService::getTotal', $e->getMessage());
            return 0;
        }
    }

    /**
     * Get a single trainer by ID
     */
    public function getOneById(int $id): ?object {
        try {
            return $this->trainer->getById($id);
        } catch (Throwable $e) {
            Logger::error('TrainerService::getOneById', $e->getMessage());
            return null;
        }
    }

    /**
     * Create a new trainer record
     */
    public function createTrainer(array $data): bool {
        try {
            $trainer = $this->trainer;
            $trainer->name = $data['name'];
            $trainer->email = $data['email'];
            $trainer->location = $data['location'];
            $trainer->certifications = $data['certifications'];
            $trainer->years = (int)$data['years'];
            $trainer->specialization = $data['specialization'];

            return $trainer->create();
        } catch (Throwable $e) {
            Logger::error('TrainerService::createTrainer', $e->getMessage());
            return false;
        }
    }

    /**
     * Update an existing trainer
     */
    public function updateTrainer(int $id, array $data): bool {
        try {
            $trainer = $this->trainer;
            $trainer->id = $id;
            $trainer->name = $data['name'];
            $trainer->email = $data['email'];
            $trainer->location = $data['location'];
            $trainer->certifications = $data['certifications'];
            $trainer->years = (int)$data['years'];
            $trainer->specialization = $data['specialization'];

            return $trainer->update();
        } catch (Throwable $e) {
            Logger::error('TrainerService::updateTrainer', $e->getMessage());
            return false;
        }
    }

    /**
     * Delete a trainer by ID
     */
    public function deleteTrainer(int $id): bool {
        try {
            return $this->trainer->delete($id);
        } catch (Throwable $e) {
            Logger::error('TrainerService::deleteTrainer', $e->getMessage());
            return false;
        }
    }
}
