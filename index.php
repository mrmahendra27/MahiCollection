<?php

include 'config/db_connect.php';

//query to get all items list
$query = "SELECT * from items ORDER BY created_at";
//getting data
$result = mysqli_query($connection, $query);
//fetching data in as an array
$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
//free result from memory
mysqli_free_result($result);
//closing the connection
mysqli_close($connection);
//end
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'layouts/header.php'; ?>
<h4 class="center">Items</h4>

<div class="container">
    <div class="row">
        <?php foreach ($items as $key => $item): ?>
            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($item['item_name']); ?></h6>
                        <div>₹ <?php echo htmlspecialchars($item['item_price']) ?></div>
                        <div>
                            <?php $tags = explode(',', $item['item_tags']); ?>
                            <ul>
                                <?php foreach($tags as $tag): ?>
                                    <li><?php echo htmlspecialchars($tag); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <p><?php echo htmlspecialchars($item['description']) ?></p>
                    </div>

                    <div class="card-action right-align">
                        <a class="brand-text" href="item-details.php?id=<?php echo $item['id']; ?>">more info</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>

</html>