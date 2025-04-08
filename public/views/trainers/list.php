<h2 style="margin-top: 20px; margin-bottom: 20px;">Trainers List</h2>

<!-- Flash messages -->
<?php if (isset($_SESSION['message'])): ?>
    <div class="success-message">
        <?= $_SESSION['message']; unset($_SESSION['message']); ?>
    </div>
<?php elseif (isset($_SESSION['error'])): ?>
    <div class="error-message">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="trainers-list">
    <?php if(!empty($trainers)): ?>
        <ul>
            <?php foreach($trainers as $trainer): ?>
                <li>
                    <a href="index.php?page=view_trainer&id=<?= $trainer->id; ?>">
                        <?= htmlspecialchars($trainer->name); ?>
                    </a>
                    <div class="actions">
                        <a href="index.php?page=edit_trainer&id=<?= $trainer->id; ?>" class="btn-edit">Edit</a>
                        <a href="index.php?page=delete_trainer&id=<?= $trainer->id; ?>" 
                           class="btn-delete" 
                           onclick="return confirm('Are you sure you want to delete this trainer?');">
                           Delete
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No trainers found.</p>
    <?php endif; ?>
</div>

<!-- Pagination Controls -->
<div class="pagination-container">
    <div class="pagination-summary">
        <?php
          $start = ($pageNum - 1) * $perPage + 1;
          $end = min($start + $perPage - 1, $totalTrainers);
          echo "$start – $end of $totalTrainers";
        ?>
    </div>

    <div class="pagination-nav">
        <?php if ($pageNum > 1): ?>
            <a href="index.php?page=trainers&p=<?= $pageNum - 1; ?>" class="pagination-arrow">&lsaquo;</a>
        <?php else: ?>
            <span class="pagination-arrow disabled">&lsaquo;</span>
        <?php endif; ?>

        <?php if ($pageNum < $totalPages): ?>
            <a href="index.php?page=trainers&p=<?= $pageNum + 1; ?>" class="pagination-arrow">&rsaquo;</a>
        <?php else: ?>
            <span class="pagination-arrow disabled">&rsaquo;</span>
        <?php endif; ?>
    </div>
</div>

<!-- JS for auto-hiding flash messages -->
<script>
  setTimeout(() => {
    document.querySelectorAll('.success-message, .error-message').forEach(el => {
      el.style.opacity = '0';
      setTimeout(() => el.remove(), 500);
    });
  }, 1000);
</script>
