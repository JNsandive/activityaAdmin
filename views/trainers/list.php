<h2 style="margin-top: 20px; margin-bottom: 20px;" >Trainers List</h2>
<div class="trainers-list">
    <?php if(!empty($trainers)): ?>
        <ul>
            <?php foreach($trainers as $trainer): ?>
                <li>
                    <a href="index.php?page=view_trainer&id=<?php echo $trainer->id; ?>">
                        <?php echo htmlspecialchars($trainer->name); ?>
                    </a>
                    <div class="actions">
                        <a href="index.php?page=edit_trainer&id=<?php echo $trainer->id; ?>" class="btn-edit">Edit</a>
                        <a href="index.php?page=delete_trainer&id=<?php echo $trainer->id; ?>" 
                           class="btn-delete" 
                           onclick="return confirm('Are you sure you want to delete this trainer?');">Delete</a>
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
      <a href="index.php?page=trainers&p=<?php echo $pageNum - 1; ?>" class="pagination-arrow">&lsaquo;</a>
    <?php else: ?>
      <span class="pagination-arrow disabled">&lsaquo;</span>
    <?php endif; ?>

    <?php if ($pageNum < $totalPages): ?>
      <a href="index.php?page=trainers&p=<?php echo $pageNum + 1; ?>" class="pagination-arrow">&rsaquo;</a>
    <?php else: ?>
      <span class="pagination-arrow disabled">&rsaquo;</span>
    <?php endif; ?>
  </div>
</div>
