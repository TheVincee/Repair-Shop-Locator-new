<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Ratings System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .star-rating {
            font-size: 2em;
            direction: rtl;
            display: inline-block;
        }
        .star-rating input[type="radio"] {
            display: none;
        }
        .star-rating label {
            color: #ddd;
            cursor: pointer;
        }
        .star-rating label:hover,
        .star-rating input[type="radio"]:checked ~ label {
            color: #f5c518;
        }
        .admin-reply {
            margin-top: 10px;
        }
        .reply-btn {
            cursor: pointer;
            color: blue;
        }
    </style>
</head>
<body>

<div class="rating-section">
    <h3>User Ratings</h3>

    <!-- User Rating Section -->
    <div id="user-rating">
        <div class="star-rating">
            <input type="radio" name="rating" value="5" id="5"><label for="5">&#9733;</label>
            <input type="radio" name="rating" value="4" id="4"><label for="4">&#9733;</label>
            <input type="radio" name="rating" value="3" id="3"><label for="3">&#9733;</label>
            <input type="radio" name="rating" value="2" id="2"><label for="2">&#9733;</label>
            <input type="radio" name="rating" value="1" id="1"><label for="1">&#9733;</label>
        </div>
        <textarea id="user-comment" placeholder="Leave a comment"></textarea>
        <button id="submit-rating">Submit Rating</button>
    </div>

    <!-- Admin Reply Section -->
    <div id="admin-section" class="admin-reply">
        <h4>Admin Reply</h4>
        <textarea id="admin-reply" placeholder="Reply to the user"></textarea>
        <button id="submit-reply">Submit Reply</button>
    </div>

    <!-- Ratings Display Section -->
    <div id="ratings-display">
        <!-- Ratings will be dynamically loaded here -->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    loadRatings();

    // Disable Admin Ratings Section (Assuming admin view)
    $('.star-rating input[type="radio"]').prop('disabled', true);

    // Submit Rating (User)
    $('#submit-rating').click(function() {
        var rating = $('input[name="rating"]:checked').val();
        var comment = $('#user-comment').val();
        if (rating && comment) {
            $.ajax({
                url: 'submit_rating.php',
                type: 'POST',
                data: {
                    rating: rating,
                    comment: comment
                },
                success: function(response) {
                    $('#user-comment').val('');
                    loadRatings();
                }
            });
        } else {
            alert('Please fill out both fields.');
        }
    });

    // Submit Admin Reply
    $('#submit-reply').click(function() {
        var reply = $('#admin-reply').val();
        if (reply) {
            $.ajax({
                url: 'submit_reply.php',
                type: 'POST',
                data: { reply: reply },
                success: function(response) {
                    $('#admin-reply').val('');
                    loadRatings();
                }
            });
        } else {
            alert('Please provide a reply.');
        }
    });

    // Load Ratings
    function loadRatings() {
        $.ajax({
            url: 'load_ratings.php',
            type: 'GET',
            success: function(response) {
                $('#ratings-display').html(response);
            }
        });
    }
});
</script>

</body>
</html>
