<?php
require_once 'BaseModel.php';
require_once 'ActivityInterface.php';

/**
 * Activity Model Class
 * Handles all operations related to the 'activities' table
 */
class Activity extends BaseModel implements ActivityInterface
{
    public int|null $id = null;
    public string $name;
    public string $description;
    public string $benefits;
    public string $price;

    /**
     * Constructor - Injects DB and sets table
     */
    public function __construct(Database $db)
    {
        parent::__construct($db, 'activities');
    }

}
