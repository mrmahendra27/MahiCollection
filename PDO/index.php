<?php 

$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pdo';

//Set DSN(Data Source Name)
$dsn = 'mysql:host='.$host.';dbname='.$dbname;

//Create a PDO Instance

$connection = new PDO($dsn, $username, $password);

//setting the default featching mode
$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
#PDO QUERY
$query = $connection->query('SELECT * FROM posts');

// while($row = $query->fetch()){
//     echo $row->title . '<br />';
// }

//Overriding to different fetch mode(associative array)
while($row = $query->fetch(PDO::FETCH_ASSOC)){
    echo $row['title'] . '<br/>';
    echo $row['author'] . '<br/>';
}

//PREAPARED STATEMENT (prepare & execute)

//fetch multiple posts
$author = 'Mahendra';
$title = 'Book1';
$id = 1;
$limit = 1;

//positional parameters
// $sql = 'SELECT * FROM posts WHERE author = ?';

// $statement = $connection->prepare($sql);

// $statement->execute([$author]);

// $post = $statement->fetchAll();

// var_dump($post);


//named parameter
// $sql = 'SELECT * FROM posts WHERE author = :author && title = :title';

// $statement = $connection->prepare($sql);

// $statement->execute(['author' => $author, 'title' => $title]);

// $post = $statement->fetchAll();

// var_dump($post);


//featch single post
// $sql = 'SELECT * FROM posts WHERE id = :id';

// $statement = $connection->prepare($sql);

// $statement->execute(['id' => $id]);

// $post = $statement->fetch();

// var_dump($post);


//row Count
// $sql = 'SELECT * FROM posts WHERE author = :author';

// $statement = $connection->prepare($sql);

// $statement->execute(['author' => $author]);

// $post = $statement->rowCount();

// var_dump($post);


//Insert 
// $new_title = "Book4";
// $body = "test1";
// $new_author = "Mahendra";

// $sql = 'INSERT INTO posts(title, body, author) VALUES(:title, :body, :author)';
// $statement = $connection->prepare($sql);
// $statement->execute(['title' => $new_title, 'body' => $body, 'author' => $new_author]);

// echo "added";

//Update
// $id=5;
// $new_title = "Book5";
// $body = "test2";
// $new_author = "Mahendra2";

// $sql = 'UPDATE posts SET title = :title, body = :body, author = :author WHERE id= :id';
// $statement = $connection->prepare($sql);
// $statement->execute(['title' => $new_title, 'body' => $body, 'author' => $new_author, 'id'=> $id]);

// echo "updated";

//Delete
// $id=6;

// $sql = 'DELETE from posts WHERE id= :id';
// $statement = $connection->prepare($sql);
// $statement->execute(['id'=> $id]);

// echo "deleted";

//Search data
// $search = "%book1%";

// $sql = 'SELECT * FROM posts WHERE title LIKE ?';
// $statement = $connection->prepare($sql);
// $statement->execute([$search]);
// $data = $statement->fetchAll();

// var_dump($data);

//LIMIT
// $sql = 'SELECT * FROM posts WHERE author = ? LIMIT ?';

// $statement = $connection->prepare($sql);

// $statement->execute([$author, $limit]);

// $post = $statement->fetchAll();

// var_dump($post);

?>