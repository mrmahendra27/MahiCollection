<?php

include 'config/db_connect.php';

//delete item

if (isset($_POST['delete'])) {
    $item_id = mysqli_real_escape_string($connection, $_POST['item_id']);

    $query = "DELETE FROM items WHERE id = $item_id";

    if (mysqli_query($connection, $query)) {
        session_start();

        $_SESSION['success'] = "Deleted Item";

        header('Location: index.php');
    } else {

        echo 'query error ' . mysqli_error($connection);
    }
}

if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($connection, $_GET['id']);

    $query = "SELECT * FROM items WHERE id = $id";

    $result = mysqli_query($connection, $query);

    $item = mysqli_fetch_assoc($result);

    mysqli_free_result($result);

    mysqli_close($connection);
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include 'layouts/header.php'; ?>


<div class="container center">
    <div class="card z-depth-0">
        <?php if ($item) : ?>

            <h4><?php echo htmlspecialchars($item['item_name']); ?></h4>
            <div>₹ <?php echo htmlspecialchars($item['item_price']) ?></div>
            <h5>Tags:</h5>
            <div>
                <?php $tags = explode(',', $item['item_tags']); ?>
                <ul>
                    <?php foreach ($tags as $tag) : ?>
                        <li><?php echo htmlspecialchars($tag); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <p><?php echo htmlspecialchars($item['description']); ?></p>
            <p>Added By: <?php echo htmlspecialchars($item['name']); ?></p>
            <p>Email: <?php echo htmlspecialchars($item['email']); ?></p>
            <p><?php echo date($item['created_at']); ?></p>

            <div class="center">
                <form method="POST" action="item-details.php">
                    <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                    <button type="submit" name="delete" value="Delete" class="btn brand z-depth-0">Delete</button>
                </form>
            </div>
        <?php else : ?>

            <h5>No item found...!</h5>

        <?php endif; ?>
    </div>
</div>
<?php include 'layouts/footer.php'; ?>

</html>