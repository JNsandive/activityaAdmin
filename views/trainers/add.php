<h2>Add New Trainer</h2>
<div class="form-container">
    <?php if(isset($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <?php if(isset($success)): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <form action="index.php?page=add_trainer" method="post">
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>
        
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" name="location" id="location" required>
        </div>
        
        <div class="form-group">
            <label for="certifications">Certifications:</label>
            <input type="text" name="certifications" id="certifications" required>
        </div>
        
        <div class="form-group">
            <label for="years">Years of Experience:</label>
            <input type="number" name="years" id="years" min="0" required>
        </div>
        
        <div class="form-group">
            <label for="specialization">Specialization:</label>
            <input type="text" name="specialization" id="specialization" required>
        </div>
        
        <div class="form-group">
            <input type="submit" name="submit" value="Add Trainer" class="btn">
            <a href="index.php?page=trainers" class="btn">Cancel</a>
        </div>
    </form>
</div>

