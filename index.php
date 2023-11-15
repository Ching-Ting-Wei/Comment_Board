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
            <form class="board__new-comment-form" method="POST" action="handle_add_comment.php">
                <div class="board__nickname">
                    <span>Nickname:</span>
                    <input type="text" name="nickname"/>
                </div>
                <textarea name="content" rows="5"></textarea>
                <input class="board__submit-btn" type="submit"/>
            </form>
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
                        <p class="card__content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam egestas sapien odio, in luctus erat cursus sed. Nam id erat iaculis, tempus sapien id, accumsan arcu. Sed ac libero in mauris imperdiet pellentesque. Sed vulputate, lectus nec luctus euismod, lectus erat iaculis felis, vitae viverra magna nulla vitae justo. In nisi arcu, sagittis id nibh id, viverra consectetur ipsum. Nunc luctus quam sit amet ipsum porta scelerisque. Ut ut pellentesque arcu. Mauris iaculis leo at condimentum pulvinar.
                        </p>
                    </div>
                </div>
                <?php } ?>
            </section>
         </main>
    </body>
</html>