<?php require('app/views/partials/head.php');?>
    <h1>Capitals Page</h1>
    
    <table width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>City Id</th>
                <th>Country ID</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($capitals as $capital) { ?>
            <tr>
                <td><?=$capital->id;?></td>
                <td><?=$capital->city_id;?></td>
                <td><?=$capital->country_id;?></td>
                <td><?=$capital->latitude;?></td>
                <td><?=$capital->longitude;?></td>
                <td><?=$capital->name;?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php require('app/views/partials/footer.php');?>