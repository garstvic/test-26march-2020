<?php require('app/views/partials/head.php');?>
    <h1>Users Page</h1>
    
    <?php require('app/views/partials/_form.php');?>
    
    <ul>
        <?php foreach($users as $user) { ?>
            <li><?=$user->name;?></li>
        <?php } ?>
    </ul>
<?php require('app/views/partials/footer.php');?>