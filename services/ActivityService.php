<?php
require_once __DIR__ . '/../models/ActivityInterface.php';

/**
 * ActivityService
 * Handles activity-related business logic, formatting, and interactions
 */
class ActivityService {
    private ActivityInterface $activity;

    /**
     * Constructor accepts anything that implements ActivityInterface
     */
    public function __construct(ActivityInterface $activity) {
        $this->activity = $activity;
    }

    /**
     * Get total number of activities
     */
    public function getTotal(): int {
        return $this->activity->count();
    }

    /**
     * Get paginated activities with optional formatting
     */
    public function getPaginatedFormatted(int $limit, int $offset): array {
        $results = $this->activity->getPaginated($limit, $offset);

        // Optional example formatting
        foreach ($results as $r) {
            $r->price = strtoupper($r->price);
        }

        return $results;
    }

    /**
     * Get a single activity by ID
     */
    public function getOneById(int $id): object|null {
        return $this->activity->getById($id);
    }

}
