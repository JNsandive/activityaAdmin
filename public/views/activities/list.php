<h2 style="margin-top: 20px; margin-bottom: 20px;">Activities List</h2>

<div class="activities-list">
    <?php if (!empty($activities)): ?>
        <ul>
            <?php foreach ($activities as $activity): ?>
                <li>
                    <a href="index.php?page=view_activity&id=<?php echo $activity->id; ?>">
                        <?php echo htmlspecialchars($activity->name); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No activities found.</p>
    <?php endif; ?>
</div>

<!-- Pagination Controls -->
<div class="pagination-container">
  <div class="pagination-summary">
    <?php
      $start = ($pageNum - 1) * $perPage + 1;
      $end = min($start + $perPage - 1, $totalActivities);
      echo "$start – $end of $totalActivities";
    ?>
  </div>

  <div class="pagination-nav">
    <?php if ($pageNum > 1): ?>
      <a href="index.php?page=activities&p=<?php echo $pageNum - 1; ?>" class="pagination-arrow">&lsaquo;</a>
    <?php else: ?>
      <span class="pagination-arrow disabled">&lsaquo;</span>
    <?php endif; ?>

    <?php if ($pageNum < $totalPages): ?>
      <a href="index.php?page=activities&p=<?php echo $pageNum + 1; ?>" class="pagination-arrow">&rsaquo;</a>
    <?php else: ?>
      <span class="pagination-arrow disabled">&rsaquo;</span>
    <?php endif; ?>
  </div>
</div>


