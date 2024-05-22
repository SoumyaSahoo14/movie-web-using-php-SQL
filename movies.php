<?php
// Include database connection
include 'config.php';

// Function to add a new movie
function addMovie($title, $genre, $release_year, $director) {
    global $conn;

    $title = $conn->real_escape_string($title);
    $genre = $conn->real_escape_string($genre);
    $release_year = intval($release_year); // Convert to integer
    $director = $conn->real_escape_string($director);

    $sql = "INSERT INTO movies (title, genre, release_year, director) 
            VALUES ('$title', '$genre', '$release_year', '$director')";

    if ($conn->query($sql) === TRUE) {
        return true; // Movie added successfully
    } else {
        return false; // Error adding movie
    }
}

// Function to update an existing movie
function updateMovie($id, $title, $genre, $release_year, $director) {
    global $conn;

    $title = $conn->real_escape_string($title);
    $genre = $conn->real_escape_string($genre);
    $release_year = intval($release_year); // Convert to integer
    $director = $conn->real_escape_string($director);

    $sql = "UPDATE movies 
            SET title='$title', genre='$genre', release_year='$release_year', director='$director'
            WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        return true; // Movie updated successfully
    } else {
        return false; // Error updating movie
    }
}

// Function to delete a movie
function deleteMovie($id) {
    global $conn;

    $sql = "DELETE FROM movies WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        return true; // Movie deleted successfully
    } else {
        return false; // Error deleting movie
    }
}

// Function to get all movies
function getAllMovies() {
    global $conn;

    $sql = "SELECT * FROM movies";
    $result = $conn->query($sql);

    $movies = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
    }

    return $movies;
}
?>
