<?php
$item_name = $item_price = $name = $email = $description = $item_tags = '';
$errors = array('email' => '', 'name' => '', 'item_name' => '', 'item_price' => '', 'description' => '', 'item_tags' => '');
if (isset($_POST['submit'])) {
    //check item name
    if (empty($_POST['item_name'])) {
        $errors['item_name'] = 'Item Name is required <br />';
    } else {
        $item_name = $_POST['item_name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $item_name)) {
            $errors['item_name'] = "Item Name must be letters and spaces only";
        }
    }
    //item price
    if (empty($_POST['item_price'])) {
        $errors['item_price'] = 'Item Price is required <br />';
    } else {
        $item_price = $_POST['item_price'];
        if (!preg_match('/^[0-9]+$/', $item_price)) {
            $errors['item_price'] = "Price must be numbers only";
        }
    }
    //check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email is required <br />';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Enter a valid Email <br />';
        }
    }
    //check name
    if (empty($_POST['name'])) {
        $errors['name'] = 'Name is required <br />';
    } else {
        $name = $_POST['name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $errors['name'] = "Name must be letters and spaces only";
        }
    }
    //check item description
    if (empty($_POST['description'])) {
        $errors['description'] = 'Item Description is required <br />';
    } else {
        $description = $_POST['description'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $description)) {
            $errors['description'] = "Description must be letters and spaces only";
        }
    }
    //item tags
    if (empty($_POST['item_tags'])) {
        echo 'At least one ingredient is required <br />';
    } else {
        $item_tags = $_POST['item_tags'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $item_tags)) {
            echo 'item_tags must be a comma separated list';
        }
    }

    //check for errors
    if (array_filter($errors)) {
        //if errors does nothing
    } else {
        //if no error
        include 'config/db_connect.php';

        $item_name = mysqli_real_escape_string($connection, $_POST['item_name']);
        $item_price = mysqli_real_escape_string($connection, $_POST['item_price']);
        $item_tags = mysqli_real_escape_string($connection, $_POST['item_tags']);
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $description = mysqli_real_escape_string($connection, $_POST['description']);

        //query
        $query = "INSERT INTO items(item_name,item_price,item_tags,name,email,description) VALUES('$item_name', '$item_price', '$item_tags', '$name', '$email', '$description')";
        if (mysqli_query($connection, $query)) {
            session_start();

            $_SESSION['success'] = "Added Item";

            header('Location: index.php');
        } else {
            echo 'query error ' . mysqli_error($connection);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'layouts/header.php'; ?>

<section class="container black-text">
    <h4 class="center">Add a Item</h4>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="white">
        <label class="brown-text" for="item_name">Item Name</label>
        <input type="text" name="item_name" id="item_name" placeholder="Enter Item Title.." required value="<?php echo htmlspecialchars($item_name) ?>">
        <div class="red-text"><?php echo $errors['item_name'] ?></div>
        <label class="brown-text" for="item_price">Item Price</label>
        <input type="number" name="item_price" id="item_price" placeholder="Enter Item Price.." required value="<?php echo htmlspecialchars($item_price) ?>">
        <div class="red-text"><?php echo $errors['item_price'] ?></div>
        <label class="brown-text" for="item_tags">Item Tags</label>
        <input type="text" name="item_tags" id="item_tags" placeholder="Enter Tags.." required value="<?php echo htmlspecialchars($item_tags) ?>">
        <div class="red-text"><?php echo $errors['item_tags'] ?></div>
        <label class="brown-text" for="name">Your Name</label>
        <input type="text" name="name" id="name" placeholder="Enter Your Name.." required value="<?php echo htmlspecialchars($name) ?>">
        <div class="red-text"><?php echo $errors['name'] ?></div>
        <label class="brown-text" for="email">Your Email</label>
        <input type="email" name="email" id="email" placeholder="Enter Your Email.." required value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors['email'] ?></div>
        <label class="brown-text" for="description">Description(About Item)</label>
        <textarea name="description" class="materialize-textarea" id="description" required placeholder="Enter Item description.."><?php echo htmlspecialchars($description) ?></textarea>
        <div class="red-text"><?php echo $errors['description'] ?></div>
        <div class="center">
            <button name="submit" class="btn brand z-depth-0" type="submit">Add</button>
        </div>
    </form>
</section>

<?php include 'layouts/footer.php'; ?>

</html>