<?php
// Start session
session_start();

// Include database configuration
require_once 'bootstrap.php';
require_once 'config/db.php';

// Include models
require_once 'models/Database.php';
require_once 'models/Activity.php';
require_once 'models/Trainer.php';

// Instantiate database
$database = new Database();
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
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';

            switch ($page) {
                case 'activities':
                    $activity = new Activity($database);

                    // --- Pagination logic ---
                    $perPage = 12;
                    $pageNum = isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p'] > 0 ? (int) $_GET['p'] : 1;

                    $totalActivities = $activity->count(); // You'll add this method in model
                    $totalPages = ceil($totalActivities / $perPage);
                    $offset = ($pageNum - 1) * $perPage;

                    $activities = $activity->getPaginated($perPage, $offset); // You'll add this method too

                    // --- Pass everything to view ---
                    include_once 'views/activities/list.php';
                    break;


                case 'view_activity':
                    if (isset($_GET['id'])) {
                        $activity = new Activity($database);
                        $activity = $activity->getById($_GET['id']);
                        include_once 'views/activities/view.php';
                    } else {
                        header('Location: index.php?page=activities');
                    }
                    break;

                case 'trainers':
                    $trainerModel = new Trainer($database);

                    $perPage = 12; // Show 12 trainers per page
                    $pageNum = isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p'] > 0 ? (int) $_GET['p'] : 1;

                    $totalTrainers = $trainerModel->count();
                    $totalPages = ceil($totalTrainers / $perPage);
                    $offset = ($pageNum - 1) * $perPage;

                    $trainers = $trainerModel->getPaginated($perPage, $offset);

                    include_once 'views/trainers/list.php';
                    break;


                case 'view_trainer':
                    if (isset($_GET['id'])) {
                        $trainer = new Trainer($database);
                        $trainer = $trainer->getById($_GET['id']);
                        include_once 'views/trainers/view.php';
                    } else {
                        header('Location: index.php?page=trainers');
                    }
                    break;

                case 'add_trainer':
                    $error = null;
                    $success = null;

                    if (isset($_POST['submit'])) {
                        $trainer = new Trainer($database);
                        $trainer->name = $_POST['name'];
                        $trainer->email = $_POST['email'];
                        $trainer->location = $_POST['location'];
                        $trainer->certifications = $_POST['certifications'];
                        $trainer->years = $_POST['years'];
                        $trainer->specialization = $_POST['specialization'];

                        if ($trainer->create()) {
                            $success = "Trainer added successfully!";
                        } else {
                            $error = "Error adding trainer.";
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

                    $trainer = new Trainer($database);

                    if (isset($_POST['submit'])) {
                        $trainer->id = $_GET['id'];
                        $trainer->name = $_POST['name'];
                        $trainer->email = $_POST['email'];
                        $trainer->location = $_POST['location'];
                        $trainer->certifications = $_POST['certifications'];
                        $trainer->years = $_POST['years'];
                        $trainer->specialization = $_POST['specialization'];

                        if ($trainer->update()) {
                            $success = "Trainer updated successfully!";
                        } else {
                            $error = "Error updating trainer.";
                        }
                    }

                    $trainer = $trainer->getById($_GET['id']);
                    include_once 'views/trainers/edit.php';
                    break;

                case 'delete_trainer':
                    if (isset($_GET['id'])) {
                        $trainer = new Trainer($database);
                        if ($trainer->delete($_GET['id'])) {
                            $_SESSION['message'] = "Trainer deleted successfully!";
                        } else {
                            $_SESSION['error'] = "Error deleting trainer.";
                        }
                        header('Location: index.php?page=trainers');
                        exit();
                    } else {
                        header('Location: index.php?page=trainers');
                        exit();
                    }
                    break;

                default:
                    include_once 'views/home.php';
                    break;
            }
            ?>
        </main>

        <?php include_once 'views/footer.php'; ?>
    </div>
</body>

</html>