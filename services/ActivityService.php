<?php
require_once __DIR__ . '/../models/ActivityInterface.php';
require_once __DIR__ . '/../utils/Logger.php';


/**
 * ActivityService
 * Handles activity-related business logic, formatting, and interactions
 */
class ActivityService
{
    private ActivityInterface $activity;

    /**
     * Constructor accepts anything that implements ActivityInterface
     */
    public function __construct(ActivityInterface $activity)
    {
        $this->activity = $activity;
    }

    /**
     * Get total number of activities
     */
    public function getTotal(): int
    {
        try {
            return $this->activity->count();
        } catch (Throwable $e) {
            Logger::error('ActivityService::getTotal', $e->getMessage());
            return 0;
        }
    }

    /**
     * Get paginated activities with optional formatting
     */
    public function getPaginatedFormatted(int $limit, int $offset): array
    {
        try {
            $results = $this->activity->getPaginated($limit, $offset);

            // Optional example formatting
            foreach ($results as $r) {
                $r->price = strtoupper($r->price);
            }

            return $results;
        } catch (Throwable $e) {
            Logger::error('ActivityService::getPaginatedFormatted', $e->getMessage());
            return [];
        }
    }

    /**
     * Get a single activity by ID
     */
    public function getOneById(int $id): ?object
    {
        try {
            return $this->activity->getById($id);
        } catch (Throwable $e) {
            Logger::error('ActivityService::getOneById', $e->getMessage());
            return null;
        }
    }
}
