<?php
// Include CommentsC.php
include '../../../Controller/CommentsC.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure that both comment_id and comment_content are set in the POST data
    if (isset($_POST['comment_id'], $_POST['comment_content'])) {
        // Sanitize and validate input
        $commentId = $_POST['comment_id'];
        $updatedComment = $_POST['comment_content'];

        // Update the comment in the database
        $commentsController = new CommentsC();
        $result = $commentsController->updateComment($commentId, $updatedComment);

        if ($result) {
            // Return a success response
            http_response_code(200);
            echo "Comment updated successfully";
        } else {
            // Return an error response if the update fails
            http_response_code(500);
            echo "Failed to update comment";
        }
    } else {
        // Return an error response if required parameters are missing
        http_response_code(400);
        echo "Missing comment ID or content";
    }
} else {
    // Return an error response for unsupported request method
    http_response_code(405);
    echo "Method Not Allowed";
}
?>
