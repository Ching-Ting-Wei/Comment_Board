<?php
    require_once("conn.php");
    $result = $conn->query("SELECT * FROM comments ORDER BY id DESC");
    if(!$result){
        die('Error' . $conn->error);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>comment</title>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header class="warning"> 
            <strong>
                It's for practice
            </strong>
         </header>
         <main class="board">
            <h1 class="board__title">Comments</h1>
            <form class="board__new-comment-form" method="POST" action="handle_add_comment.php" onsubmit="return validateForm()">
                <div class="board__nickname">
                    <span>Nickname:</span>
                    <input type="text" name="nickname" id="nickname"/>
                </div>
                <textarea name="content" rows="5" id="content"></textarea>
                <input class="board__submit-btn" type="submit" />
            </form>
            <script>
                function validateForm() {
                    var nickname = document.getElementById('nickname').value;
                    var content = document.getElementById('content').value;
                    if (nickname.trim() === '' || content.trim() === '') {
                        alert('comment or nickname is empty');
                        return false;
                    }
                    return true; 
                    }
            </script>
            <div class="board__hr"></div>
            <section>
                <?php
                    while($row = $result->fetch_assoc()){
                ?>  
                <div class="card">
                    <div class="card__avatar"></div>
                    <div class="card__body">
                        <div class="card__info">
                            <span class="card__author"><?php echo $row['nickname']; ?></span>
                            <span class="card__time"><?php echo $row['created_at']; ?></span>
                        </div>
                        <p class="card__content"><?php echo $row['content']; ?></p>
                    </div>
                </div>
                <?php } ?>
            </section>
         </main>
    </body>
</html>