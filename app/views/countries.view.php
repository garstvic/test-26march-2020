<?php require('app/views/partials/head.php');?>
    <h1>Countries Page</h1>
    
    <table width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Code</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($countries as $country) { ?>
            <tr>
                <td><?=$country->id;?></td>
                <td><?=$country->name;?></td>
                <td><?=$country->code;?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php require('app/views/partials/footer.php');?>