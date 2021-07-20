<?php
include './_header.php';
?>
<div class="container mt-3">
    <h1>Profile Settings</h1>
    <h4>Name : 
        <?php echo $_SESSION['name']; ?>
    </h4>
    <h4>
        SDRN : <?php echo $_SESSION['username']; ?>
    </h4>
</div>
<?php
include './__footer.php';
?>