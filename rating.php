<?php
// Connect to the database
$connection = mysqli_connect("localhost", "root", "", "lakbaymarista");

// Function to insert/update rating
function ratePage($pageId, $rating, $review, $userId) {
    global $connection;
    $query = "REPLACE INTO ratings (page_id, user_id, rating_value, review) VALUES ($pageId, $userId, $rating, '$review')";
    mysqli_query($connection, $query);
}

// Function to calculate average rating for a page
function getAverageRating($pageId) {
    global $connection;
    $query = "SELECT AVG(rating_value) AS avg_rating FROM ratings WHERE page_id = $pageId";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['avg_rating'];
}

// Function to get reviews for a page
function getReviews($pageId) {
    global $connection;
    $query = "SELECT review FROM ratings WHERE page_id = $pageId AND review IS NOT NULL";
    $result = mysqli_query($connection, $query);
    $reviews = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $reviews[] = $row['review'];
    }
    return $reviews;
}

// Example usage:
$pageId = 1; // You would replace this with the actual page ID
$userId = 1; // You would replace this with the actual user ID
$rating = isset($_POST['rating']) ? $_POST['rating'] : null;
$review = isset($_POST['review']) ? $_POST['review'] : null;

if ($rating !== null && $review !== null) {
    ratePage($pageId, $rating, $review, $userId);
}

$averageRating = getAverageRating($pageId);
$reviews = getReviews($pageId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webpage Rating System</title>
    <style>
        /* Styles for rating and review display */
    </style>
</head>
<body>
    <h1>Rate This Page</h1>
    <div id="average-rating">
        Average Rating: <?php echo number_format($averageRating, 1); ?>
    </div>
    <h2>User Reviews</h2>
    <div id="reviews">
        <?php foreach ($reviews as $review) : ?>
            <div class="review">
                <?php echo $review; ?>
            </div>
        <?php endforeach; ?>
    </div>
    
    <hr>
    <h2>Rate and Review</h2>
    <form method="post" action="">
        <div class="rating-stars">
            <!-- Star rating system (similar to previous HTML) -->
        </div>
        <div class="review-field">
            <label for="review">Your Review:</label><br>
            <textarea id="review" name="review" rows="4" cols="50"></textarea>
        </div>
        <button type="submit">Submit Rating</button>
    </form>
</body>
</html>
