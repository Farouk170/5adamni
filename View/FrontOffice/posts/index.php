<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>5adamni</title>
  <link rel="shortcut icon" href="../logo-mini.svg">
  <link rel="stylesheet" href="./css/all.css">
  <link rel="stylesheet" href="style3.css">
  <link rel="stylesheet" href="new_style.css">
  <link rel="stylesheet" href="new_style1.css">
  <link rel="stylesheet" href="new_style2.css">
  <link rel="stylesheet" href="new_style3.css">
  <link rel="stylesheet" href="new_style4.css">
  <link rel="stylesheet" href="new_style6.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  
  <script src="https://kit.fontawesome.com/3892138727.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <?php
        require_once "../../../Controller/UserController.php";
        session_start();
        if(!isset($_SESSION['prenom'])) {
            header("location: ../login.php");
            exit;
        }
        else{
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '    var prenom = "' . htmlspecialchars($_SESSION['prenom']) . '";';
            echo '    var users = document.getElementsByClassName("user");';
            echo '    for (var i = 0; i < users.length; i++) {';
            echo '        users[i].textContent = prenom;';
            echo '    }';
            echo '});';
            echo '</script>';
        }
        $usrc = new UserC();
        $user = $usrc->GetUserById($_SESSION['id']);
    ?>
    <style>
    .material-symbols-outlined {
      font-variation-settings:
      'FILL' 0,
      'wght' 400,
      'GRAD' 0,
      'opsz' 24
    }
    </style>
    <style>
      .container input {
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }
        
        .container {
            display: block;
            cursor: pointer;
            user-select: none;
            margin-right: 100px;
        }
        .container input:checked ~ svg {
            fill: rgb(198, 23, 23);
        }

        .icon-container {
            display: flex;
            align-items: center; /* Align items vertically */
            margin-left: 10px; /* Adjust margin as needed */
        }

        .icon-container i {
            margin-right: 5px; /* Adjust margin between icons as needed */
            cursor: pointer;
        }

        .icons {
            display: flex;
        }

        .icons i {
            margin-right: 5px; /* Adjust margin between icons as needed */
        }
        .icon-container {
    display: flex;
    align-items: center;
    gap: 0.5px; /* Adjust the gap as needed */
}

.icon-link, .icon-button {
    text-decoration: none;
    border: none;
    background: none;
    cursor: pointer;
    padding: 0;
    margin: 0; /* Ensuring no extra margins are applied */
    color: inherit;
    display: flex;
    align-items: center;
}

.icon-form {
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
}

#delete_post {
    color: red; /* Adjust color as needed */
}

.fa-pen {
    cursor: pointer;
    color: blue; /* Adjust color as needed */
    font-size: 16px; /* Match the size to other icons */
    line-height: 1; /* Ensure the line height does not add extra space */
}

.fa-exclamation-circle, .fa-trash {
    font-size: 16px; /* Match the size to other icons */
    line-height: 1; /* Ensure the line height does not add extra space */
}

    </style>
</head>
<body>

  <div class="main-flex-container">
    <div class="left-flex-container flex-item">
      <div class="nav-links">
        <ul>
          <li class="nav-items logo"><a href="#"><img src="../logo-mini.svg"></img></a></li>
          <li class="nav-items"><a href="../index.php"><i class="fas fa-home"></i> Home</a></li>
          <li class="nav-items"><a href="../postulant/reclamationIndex.php"><i class="fa fa-exclamation-circle"></i> Reclamations</a></li>
          <li class="nav-items"><a href="../postulant/entretiens_c.php"><i class="fa fa-calendar"></i> Entretiens</a></li>
          <li class="nav-items"><a href="../postulant/index.php"><i class="far fa-bookmark"></i> Offres</a></li>
        </ul>
      </div>
      <div class="profile-box">
        <img src="data:image/png;base64,<?php if (isset($user['image'])){echo base64_encode($user['image']);} ?>" alt="Image de l'utilisateur">
        <div class="profile-link">
          <p class="full-name"><?php echo $user['prenom']?></p>
        </div>
        <div class="options-icon"><i class="fas fa-caret-down"></i></div>
      </div><br>
      <div class="nav-links">
        <ul>
        <li class="nav-items"><a href="../postulant/profile.php"><i class="far fa-user"></i> Profile</a></li>  
        <li class="nav-items"><a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
        </ul>
      </div>
    </div>

    <div class="center-flex-container flex-item">
      <div class="home">
        <h1>Home</h1>
      </div>

      <div class="post-tweet">
        <form action="add_post.php" id="postForm" method="post" enctype="multipart/form-data">
          <div class="form-group-1">
            <img src="data:image/png;base64,<?php if (isset($user['image'])){echo base64_encode($user['image']);} ?>" alt="Image de l'utilisateur">
            <input class="txt_message" type="text" placeholder="Quoi de neuf?" name="post-textarea">
          </div>
          <div class="form-group-2">
            <div class="post-icons">
              <i class="far fa-image" id="image-icon"><input type="file" name="photo-upload" id="photo-upload" style="display: none;" accept="image/*"></i>
              <script>
                  document.getElementById('image-icon').addEventListener('click', function() {
                      document.getElementById('photo-upload').click();
                  });
              </script>
              <i class="far fa-smile emojis"></i>
            </div>
            <button class="btn" type="submit" onclick="submitPost()">Publier</button>
          </div>
        </form>

      </div>
      <!-- User Content -->
      <?php

      include '../../../Controller/PostsC.php';
      include '../../../Controller/CommentsC.php';
      include '../../../Model/Posts.php';
      include '../../../Model/Comments.php';
      include 'conversion.php';

      $postC= new postsC();
      $Comments = new commentsC();

      $posts = $postC->afficherPost();
      $comments= $Comments->afficherComments();

      foreach ($posts as $post) {
          $PostID = $post['PostID']; 
          $time = $post['Time']; 
          $content = $post['Content']; 
          $MediaData= $post['MediaData'];
          $user_id= $post['user_id'];
          $usrcont = new UserC();
          $userpost = $usrcont->GetUserById($user_id);
      ?>
        <div class="tweets" style="width: 100%; margin: 0 auto;">
          <input type="hidden" name="post_id" value="<?php echo $post['PostID']; ?>">
          <div class="user-content-box">
            <div class="user-names">
            <div class="user-pics"><img src="data:image/png;base64,<?php if (isset($userpost['image'])){echo base64_encode($userpost['image']);} ?>" alt="Image de l'utilisateur"></div>
              <hi class="full-name" style="text-decoration: none; cursor:default;"><?php echo $userpost['prenom']; ?></hi>
              <p class="time"><?php echo time_elapsed_string($post['Time']); ?></p>
              <div class="icons"style="margin-left: auto; margin-right: 25px">
                <div class="icon-container">
                  <a href="../postulant/ajouterReclamation.php" class="icon-link">
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                  </a>
                  <?php 
                  if ($user_id == $_SESSION['id']) {
                      echo '<form action="delete_post.php" method="GET" onsubmit="return confirmDelete()" class="icon-form">
                                <button type="submit" class="icon-button">
                                  <i class="fa fa-trash" id="delete_post" aria-hidden="true"></i>
                                </button>
                                <input type="hidden" name="post_id" value="' . $post['PostID'] . '">
                            </form>
                            <i style="margin-left:10px;" class="fa fa-pen icon-link" data-post-id="' . $post['PostID'] . '" onclick="toggleEditPost(this)"></i>';
                  }
                  ?>
                </div>
                <script>
                    function toggleEditPost(element) {
                        // Get the post ID from the data attribute
                        var postId = element.getAttribute('data-post-id');
                        // Get the corresponding post text element
                        var postTextElement = document.querySelector('.post-text[data-comment-id="' + postId + '"]');

                        if (postTextElement.contentEditable === "true") {
                            // Save the post
                            postTextElement.contentEditable = false;
                            element.classList.remove('fa-save');
                            element.classList.add('fa-pen-to-square');
                            console.log("Saving post with ID:", postId, "and content:", postTextElement.textContent);
                            savePost(postId, postTextElement.textContent);
                        } else {
                            // Edit the post
                            postTextElement.contentEditable = true;
                            postTextElement.focus();
                            element.classList.remove('fa-pen-to-square');
                            element.classList.add('fa-save');
                        }
                    }

                    function savePost(postId, updatedContent) {
                        $.ajax({
                            type: "POST",
                            url: "submit_post_edit.php",
                            data: {
                                post_id: postId,
                                post_content: updatedContent
                            },
                            success: function(response) {
                                console.log('Post updated successfully:', response);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error updating post:', error);
                            }
                        });
                    }

                    function confirmDelete() {
                        return confirm('Are you sure you want to delete this?');
                    }
                  </script>

                <script>
                  var speechSynthesisInstance;

                document.addEventListener('click', function(event) {
                    if (event.target && event.target.id === 'speak_comment') {
                        var commentText = event.target.getAttribute('data-comment');
                        
                        if (speechSynthesisInstance && speechSynthesisInstance.speaking) {
                            speechSynthesisInstance.cancel();
                        }
                        
                        var speechSynthesis = window.speechSynthesis;
                        var speechUtterance = new SpeechSynthesisUtterance(commentText);

                        speechUtterance.lang = 'en-US';
                        
                        speechSynthesisInstance = speechSynthesis;
                        speechSynthesisInstance.speak(speechUtterance);
                    }
                });
                </script>
              </div>
          </div>
            
            
          <div class="user-content" style="width: 100%;">
            <p class="post-text" data-comment-id="<?php echo $post['PostID']; ?>" name="post_content" contenteditable="false"><?php echo $content; ?></p>
            <img src="<?php echo $MediaData ?>" class="post-img" contenteditable="false">
          </div>

            <!-- <label class="container">
              <input type="checkbox">
              <svg id="Glyph" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M29.845,17.099l-2.489,8.725C26.989,27.105,25.804,28,24.473,28H11c-0.553,0-1-0.448-1-1V13  c0-0.215,0.069-0.425,0.198-0.597l5.392-7.24C16.188,4.414,17.05,4,17.974,4C19.643,4,21,5.357,21,7.026V12h5.002  c1.265,0,2.427,0.579,3.188,1.589C29.954,14.601,30.192,15.88,29.845,17.099z" id="XMLID_254_"></path><path d="M7,12H3c-0.553,0-1,0.448-1,1v14c0,0.552,0.447,1,1,1h4c0.553,0,1-0.448,1-1V13C8,12.448,7.553,12,7,12z   M5,25.5c-0.828,0-1.5-0.672-1.5-1.5c0-0.828,0.672-1.5,1.5-1.5c0.828,0,1.5,0.672,1.5,1.5C6.5,24.828,5.828,25.5,5,25.5z" id="XMLID_256_"></path></svg>
            </label> -->
            <section class="follow-users-box">
          <div class="follow-header">
            <h1 class="main-text">Comment Section</h1>
          </div>
          <div class="follow-user">
            <div class="related-followers">
            </div>
            <?php
            $postComments = array_filter($comments, function($comment) use ($PostID) {
                return $comment['PostID'] == $PostID;
            });
            foreach($postComments as $comment){
              $user_id= $comment['user_id'];
              $usrcont = new UserC();
              $usercomment = $usrcont->GetUserById($user_id);?>

            <div class="user-profile">
              <input type="hidden" name="post_id" value="<?php echo $comment['CommentID']; ?>">
              <div class="user-pics"><img src="data:image/png;base64,<?php if (isset($user['image'])){echo base64_encode($usercomment['image']);} ?>" alt="Image de l'utilisateur">
              </div>

              <div class="user-profile-content">
                <div class="title-container">
                  <div class="user-names">
                    <div class="full-name"><h1 class="main-text"><?php echo $usercomment['prenom']; ?></h1></div>
                    <p class="time"><?php echo time_elapsed_string($comment['Timestamp']); ?></p>
                  </div>
                <div class="icon-container">
                <?php 
                
                if ($user_id == $_SESSION['id']) {
                    echo '<form action="delete_comment.php" method="GET" onsubmit="return confirmDelete()">
                              <button type="submit" style="text-decoration: none; border:0; background-color:#ffffff;" >
                                <i class="fa fa-trash" id="delete_comment" aria-hidden="true"></i>
                              </button>
                              <input type="hidden" name="comment_id" value="' . $comment['CommentID'] . '">
                          </form>
                          <i class="fa-solid fa-pen-to-square" data-comment-id="' . $comment['CommentID']. '" onclick="toggleEdit(this)"></i>';
                }
              ?>
                <i class="fa fa-volume-up" id="speak_comment" data-comment="<?php echo $comment['content']; ?>" aria-hidden="true"></i>
                </div>
                </div>
                <div class="bio-container" id="comment-<?php echo $comment['CommentID']; ?>">
                <p class="bio-text" data-comment-id="<?php echo $comment['CommentID']; ?>" contenteditable="false" name="comment_content"><?php echo $comment['content']; ?></p>
                </div>
                
              </div>

            </div>
            <?php
            }
            ?>
          </div>
          <script>
           function toggleEdit(element) {
            // Get the comment ID from the data attribute
            var commentId = element.getAttribute('data-comment-id');
            // Get the corresponding bio text element
            var bioTextElement = document.querySelector('.bio-text[data-comment-id="' + commentId + '"]');

            if (bioTextElement.contentEditable === "true") {
                // Save the comment
                bioTextElement.contentEditable = false;
                element.classList.remove('fa-save');
                element.classList.add('fa-pen-to-square');
                console.log("Saving comment with ID:", commentId, "and content:", bioTextElement.textContent);
                saveComment(commentId, bioTextElement.textContent);
            } else {
                // Edit the comment
                bioTextElement.contentEditable = true;
                bioTextElement.focus();
                element.classList.remove('fa-pen-to-square');
                element.classList.add('fa-save');
            }
        }

        function saveComment(commentId, updatedComment) {
          $.ajax({
              type: "POST",
              url: "submit_comment_edit.php",
              data: {
                  comment_id: commentId,
                  comment_content: updatedComment
              },
              success: function(response) {
                  console.log('Comment updated successfully:', response);
              },
              error: function(xhr, status, error) {
                  console.error('Error updating comment:', error);
              }
          });
}


          </script>
        <form method="post" action="add_comment.php">
        <div class="follow-user">
            <div class="user-profile">
              <input type="hidden" name="post_id" value="<?php echo $post['PostID']; ?>">
              <div class="user-pics"><img src="data:image/png;base64,<?php if (isset($user['image'])){echo base64_encode($user['image']);} ?>" alt="Image de l'utilisateur"></div>

              <div class="user-profile-content">
                <div class="title-container">
                  <div class="user-names">
                    <div class="full-name"><h1 class="main-text"><?php echo $user['prenom']; ?></h1></div>
                  </div>
                </div>
                <div class="comment-container">
                    <div class="comment-box"><input name="comment" placeholder="Add a comment"></textarea></div>
                    <button class="btn-comment" type="submit" name="post_comment">Commenter</button>
                </div>
                
              </div>

            </div>
          </div>
          </form>

        </section>
  
          </div>
        </div>
        <?php
        }
        ?>




    </div>

    

    <div class="right-flex-container flex-item">
    <?php require_once "../../../Controller/chatbotFront.php";?>
      <div class="trends">
        <ul>
          <li class="nav-list header">
            <h2>Offres à la une</h2>
          </i>
          <?php

          include '../../../Controller/OffreC.php';
          include '../../../Model/offre.php';

          $Offre= new OffreC();
          $Comments = new commentsC();

          $offres = $Offre->AfficherOffreForum();

          foreach ($offres as $Offre) {
            $OffreID = $Offre['idOffre'];
            $OffreTitre = $Offre['titreOffre']; 
            $OffreLocation = $Offre['localOffre']; 
            $OffreCategorie = $Offre['catgOffre'];
            $usrcont = new UserC();
            $userpost = $usrcont->GetUserById($user_id);
            ?>
          <li class="nav-list">
            <form id="detailleOffreForm" method="post" action="../postulant/detailleOffre.php">
            <div class="trend-list">
            <input type="hidden" name="idOffre" value="<?php echo $Offre['idOffre']; ?>">
              <p class="main-text"><?php echo $OffreTitre; ?></p>
              <p class="sub-text"><i class="fa-solid fa-location-dot"></i>  <?php echo $OffreLocation; ?></p>
              <p class="sub-text"><?php echo $OffreCategorie; ?></p>
            </div>
            <div class="trend-icon">
            </div>
            </form>
            <script>
              document.getElementById('trendList').addEventListener('click', function() {
                document.getElementById('detailleOffreForm').submit();
              });
            </script>
          </li>
          <?php
          }
          ?>
          </a>
          
          
          <li class="nav-list"><a href="../postulant/index.php">Voir plus</a></li>
        </ul>
      </div>

      <div class="right-footer">
        <div class="footer-copyright">
          <p class="sub-text">&copy; 2024 5adamni, Inc.</p>
        </div>

      </div>
    
    </div>
    
  </div>
    <script src="vanillaEmojiPicker.js"></script>
    <script>

        new EmojiPicker({
            trigger: [
                {
                    selector: '.emojis',
                    insertInto: '.txt_message'
                }
            ],
            closeButton: true,
            //specialButtons: green
        });

    </script>
  
</body>
</html>