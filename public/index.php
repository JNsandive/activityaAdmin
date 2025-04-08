<?php
session_start();

// Bootstrap & Config
require_once __DIR__ . '/../private/bootstrap.php';
require_once __DIR__ . '/../private/config/db.php';

// Models & Interfaces
require_once __DIR__ . '/../private/models/BaseModel.php';
require_once __DIR__ . '/../private/models/ActivityInterface.php';
require_once __DIR__ . '/../private/models/TrainerInterface.php';
require_once __DIR__ . '/../private/models/Database.php';
require_once __DIR__ . '/../private/models/Activity.php';
require_once __DIR__ . '/../private/models/Trainer.php';

// Services
require_once __DIR__ . '/../private/services/TrainerService.php';
require_once __DIR__ . '/../private/services/ActivityService.php';

// Logger
require_once __DIR__ . '/../private/utils/Logger.php';

// DB + Service Init
$database = new Database();
$activityService = new ActivityService(new Activity($database));
$trainerService = new TrainerService(new Trainer($database));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ActiveAtHome</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="main-wrapper">
        <?php include_once 'views/header.php'; ?>

        <main class="content">
            <?php
            $page = $_GET['page'] ?? 'home';

            try {
                switch ($page) {
                    case 'activities':
                        $perPage = 12;
                        $pageNum = (isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p'] > 0) ? (int) $_GET['p'] : 1;
                        $totalActivities = $activityService->getTotal();
                        $totalPages = ceil($totalActivities / $perPage);
                        $offset = ($pageNum - 1) * $perPage;
                        $activities = $activityService->getPaginatedFormatted($perPage, $offset);
                        include_once 'views/activities/list.php';
                        break;

                    case 'view_activity':
                        if (!isset($_GET['id'])) {
                            header('Location: index.php?page=activities');
                            exit();
                        }
                        $activity = $activityService->getOneById($_GET['id']);
                        include_once 'views/activities/view.php';
                        break;

                    case 'trainers':
                        $perPage = 12;
                        $pageNum = (isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p'] > 0) ? (int) $_GET['p'] : 1;
                        $totalTrainers = $trainerService->getTotal();
                        $totalPages = ceil($totalTrainers / $perPage);
                        $offset = ($pageNum - 1) * $perPage;
                        $trainers = $trainerService->getPaginatedFormatted($perPage, $offset);
                        include_once 'views/trainers/list.php';
                        break;

                    case 'view_trainer':
                        if (!isset($_GET['id'])) {
                            header('Location: index.php?page=trainers');
                            exit();
                        }
                        $trainer = $trainerService->getOneById($_GET['id']);
                        include_once 'views/trainers/view.php';
                        break;

                    case 'add_trainer':
                        $error = null;
                        $success = null;

                        if (isset($_POST['submit'])) {
                            $name = trim($_POST['name']);
                            $email = trim($_POST['email']);
                            $location = trim($_POST['location']);
                            $certifications = trim($_POST['certifications']);
                            $years = trim($_POST['years']);
                            $specialization = trim($_POST['specialization']);

                            $errors = [];

                            if ($name === '') $errors[] = "Full Name is required.";
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid Email is required.";
                            if ($location === '') $errors[] = "Location is required.";
                            if ($certifications === '') $errors[] = "Certifications are required.";
                            if (!is_numeric($years) || (int)$years < 0) $errors[] = "Years of Experience must be a positive number.";
                            if ($specialization === '') $errors[] = "Specialization is required.";

                            if (!empty($errors)) {
                                $error = implode('<br>', $errors);
                            } else {
                                $success = $trainerService->createTrainer($_POST)
                                    ? "Trainer added successfully!"
                                    : "Error adding trainer.";
                            }
                        }

                        include_once 'views/trainers/add.php';
                        break;

                    case 'edit_trainer':
                        $error = null;
                        $success = null;

                        if (!isset($_GET['id'])) {
                            header('Location: index.php?page=trainers');
                            exit();
                        }

                        if (isset($_POST['submit'])) {
                            $name = trim($_POST['name']);
                            $email = trim($_POST['email']);
                            $location = trim($_POST['location']);
                            $certifications = trim($_POST['certifications']);
                            $years = trim($_POST['years']);
                            $specialization = trim($_POST['specialization']);

                            $errors = [];

                            if ($name === '') $errors[] = "Full Name is required.";
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid Email is required.";
                            if ($location === '') $errors[] = "Location is required.";
                            if ($certifications === '') $errors[] = "Certifications are required.";
                            if (!is_numeric($years) || (int)$years < 0) $errors[] = "Years of Experience must be a positive number.";
                            if ($specialization === '') $errors[] = "Specialization is required.";

                            if (!empty($errors)) {
                                $error = implode('<br>', $errors);
                            } else {
                                $success = $trainerService->updateTrainer($_GET['id'], $_POST)
                                    ? "Trainer updated successfully!"
                                    : "Error updating trainer.";
                            }
                        }

                        $trainer = $trainerService->getOneById($_GET['id']);
                        include_once 'views/trainers/edit.php';
                        break;

                    case 'delete_trainer':
                        if (isset($_GET['id'])) {
                            if ($trainerService->deleteTrainer($_GET['id'])) {
                                $_SESSION['message'] = "Trainer deleted successfully!";
                            } else {
                                $_SESSION['error'] = "Error deleting trainer.";
                            }
                            header('Location: index.php?page=trainers');
                            exit();
                        }

                    default:
                        include_once 'views/home.php';
                        break;
                }
            } catch (Throwable $e) {

                // Log to file
                Logger::error('IndexError', $e->getMessage());


                echo "<div style='padding:1rem;background:#ffdddd;color:#900;border:1px solid #f00;'>
            <strong>Something went wrong. Please try again later.</strong>
        </div>";
            }
            ?>
        </main>

        <?php include_once 'views/footer.php'; ?>
    </div>
</body>

</html>