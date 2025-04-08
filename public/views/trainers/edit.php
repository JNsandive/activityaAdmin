<h2 style="margin-top: 20px; margin-bottom: 20px;">Edit Trainer</h2>
<div class="form-container">
    <?php if (isset($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>

    <?php if ($trainer): ?>
        <form action="index.php?page=edit_trainer&id=<?php echo $trainer->id; ?>" method="post">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($trainer->name); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($trainer->email); ?>" required>
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" name="location" id="location" value="<?php echo htmlspecialchars($trainer->location); ?>" required>
            </div>

            <div class="form-group">
                <label for="certifications">Certifications:</label>
                <input type="text" name="certifications" id="certifications" value="<?php echo htmlspecialchars($trainer->certifications); ?>" required>
            </div>

            <div class="form-group">
                <label for="years">Years of Experience:</label>
                <input type="number" name="years" id="years" min="0" value="<?php echo htmlspecialchars($trainer->years); ?>" required>
            </div>

            <div class="form-group">
                <label for="specialization">Specialization:</label>
                <input type="text" name="specialization" id="specialization" value="<?php echo htmlspecialchars($trainer->specialization); ?>" required>
            </div>

            <div class="form-group" style="display: flex; justify-content: flex-end; gap: 10px;">
                <input type="submit" name="submit" value="Update Trainer" class="btn">
                <a href="index.php?page=trainers" class="btn">Cancel</a>
            </div>

        </form>
    <?php else: ?>
        <p>Trainer not found.</p>
        <a href="index.php?page=trainers" class="btn">Back to Trainers</a>
    <?php endif; ?>
</div>