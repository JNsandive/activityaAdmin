<h2 style="margin-top: 20px; margin-bottom: 20px;" >Trainer Details</h2>
<div class="trainer-details">
    <?php if($trainer): ?>
        <h3><?php echo htmlspecialchars($trainer->name); ?></h3>
        <br>
        <div class="detail-row">
            <strong>Email:</strong>
            <p><?php echo htmlspecialchars($trainer->email); ?></p>
        </div>
        <div class="detail-row">
            <strong>Location:</strong>
            <p><?php echo htmlspecialchars($trainer->location); ?></p>
        </div>
        <div class="detail-row">
            <strong>Certifications:</strong>
            <p><?php echo htmlspecialchars($trainer->certifications); ?></p>
        </div>
        <div class="detail-row">
            <strong>Years of Experience:</strong>
            <p><?php echo htmlspecialchars($trainer->years); ?></p>
        </div>
        <div class="detail-row">
            <strong>Specialization:</strong>
            <p><?php echo htmlspecialchars($trainer->specialization); ?></p>
        </div>
        <div class="actions" style="display: flex; justify-content: flex-end; gap: 10px;">
            <a href="index.php?page=edit_trainer&id=<?php echo $trainer->id; ?>" class="btn">Edit</a>
            <a href="index.php?page=trainers" class="btn">Back to Trainers</a>
        </div>
    <?php else: ?>
        <p>Trainer not found.</p>
        <a href="index.php?page=trainers" class="btn">Back to Trainers</a>
    <?php endif; ?>
</div>

