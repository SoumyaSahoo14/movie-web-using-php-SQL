<?php
// Include movies functions
include 'movies.php';

// Process form submission (Add or Update)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_movie'])) {
        $title = $_POST['title'];
        $genre = $_POST['genre'];
        $release_year = $_POST['release_year'];
        $director = $_POST['director'];

        // Add movie to database
        $result = addMovie($title, $genre, $release_year, $director);
        if ($result) {
            echo '<script>alert("Movie added successfully.");</script>';
        } else {
            echo '<script>alert("Error adding movie.");</script>';
        }
    } elseif (isset($_POST['update_movie'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $genre = $_POST['genre'];
        $release_year = $_POST['release_year'];
        $director = $_POST['director'];

        // Update movie in database
        $result = updateMovie($id, $title, $genre, $release_year, $director);
        if ($result) {
            echo '<script>alert("Movie updated successfully.");</script>';
        } else {
            echo '<script>alert("Error updating movie.");</script>';
        }
    }
}

// Fetch all movies from database
$movies = getAllMovies();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movie Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        input, button {
            margin-bottom: 10px;
            padding: 5px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1>Movie Management System</h1>

<!-- Add Movie Form -->
<h2>Add New Movie</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label>Title:</label>
    <input type="text" name="title" required><br>
    <label>Genre:</label>
    <input type="text" name="genre"><br>
    <label>Release Year:</label>
    <input type="number" name="release_year"><br>
    <label>Director:</label>
    <input type="text" name="director"><br>
    <button type="submit" name="add_movie">Add Movie</button>
</form>

<hr>

<!-- Display Movies -->
<h2>Movie List</h2>
<?php if (!empty($movies)) : ?>
    <ul>
        <?php foreach ($movies as $movie) : ?>
            <li>
                <?php echo $movie['title']; ?> -
                <?php echo $movie['genre']; ?> (
                <?php echo $movie['release_year']; ?>) -
                <?php echo $movie['director']; ?>

                <!-- Update and Delete Buttons -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="hidden" name="id" value="<?php echo $movie['id']; ?>">
                    <button type="submit" name="update_movie">Update</button>
                    <button type="submit" name="delete_movie">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>No movies found.</p>
<?php endif; ?>

</body>
</html>
