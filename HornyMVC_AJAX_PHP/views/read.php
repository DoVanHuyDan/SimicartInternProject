<table class="table table-dark">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($data as $record) : ?>

            <tr>
                <th scope="row"> <?php echo $record['id']; ?> </th>
                <td> <?php echo $record['name']; ?> </td>
                <td> <?php echo $record['price']; ?></td>
                <td>

                    <button class="btn btn-info m-r-1em btn-detail" value=<?php echo $record['id']; ?>>Details</button>
                    <button class="btn btn-primary m-r-1em btn-edit" value=<?php echo $record['id']; ?> >Edit</button>
                    <button class="btn btn-danger btn-delete" value=<?php echo $record['id']; ?>>Delete</button>

                </td>

            </tr>

        <?php endforeach; ?>
    </tbody>
</table>


    <!-- <button id="btn-load-more" class="btn btn-success">Load More</button>
    <button id="btn-create" class="btn btn-dark">Create New Product</button> -->