<?php
include('validation.php');

$errors = [];
if(isset($_POST['submit'])){
    $validate  = new ValidationForm($_POST);


    $errors = $validate->validateForm();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/form.css">
    <title>Validation Form</title>
</head>
<body>
    <div class="new-user">
        <h4>Validation Form</h4>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="name" value="<?php echo htmlspecialchars($_POST['name']) ?? '' ?>">
    <div class="error">
        <?php echo $errors['name'] ?? '' ?>
    </div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="email" value="<?php echo htmlspecialchars($_POST['email']) ?? '' ?>">
        <div class="error">
        <?php echo $errors['email'] ?? '' ?>
    </div>

        <button name="submit" type="submit" value="submit">Submit</button>
    </form>
    </div>
</body>
</html>