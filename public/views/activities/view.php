<h2 style="margin-top: 20px; margin-bottom: 20px;">Activity Details</h2>
<div class="activity-details">
    <?php if ($activity): ?>
        <h3><?php echo htmlspecialchars($activity->name); ?></h3>
        <br>
        <div class="detail-row">
            <strong>Description:</strong>
            <p><?php echo htmlspecialchars($activity->description); ?></p>
        </div>
        <div class="detail-row">
            <strong>Benefits:</strong>
            <p><?php echo htmlspecialchars($activity->benefits); ?></p>
        </div>
        <div class="detail-row">
            <strong>Price:</strong>
            <p><?php echo htmlspecialchars($activity->price); ?></p>
        </div>
        <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
            <a href="index.php?page=activities" class="btn">Back to Activities</a>
        </div>
    <?php else: ?>
        <p>Activity not found.</p>
        <a href="index.php?page=activities" class="btn">Back to Activities</a>
    <?php endif; ?>
</div>