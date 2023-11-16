<?php
    session_start();
    require_once("conn.php");
    require_once("utils.php");
    $username = NULL;
    $user = NULL;
    if(!empty($_SESSION["username"])){
        $username = $_SESSION["username"];
        $user = getUserFromUsername($username);
    }
    $page = 1;
    if(!empty($_GET["page"])){
        $page = $_GET["page"];  
    }
    $item_per_page = 5;
    $offset = ($page - 1) * $item_per_page;
    $stmt = $conn->prepare('SELECT C.id as id, C.content as content, C.created_at as created_at, U.nickname as nickname, U.username as username'.
    ' FROM comments as C LEFT JOIN users as U on C.username = U.username ORDER BY C.id DESC limit ? offset ?');
    $stmt->bind_param('ii', $item_per_page, $offset);
    $result = $stmt->execute();
    if(!$result){
        die('Error' . $conn->error);
    }
    $result = $stmt->get_result();
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
            <div>
                <?php if(!$username){ ?>
                    <a class="board__btn" href="register.php">sign up</a>
                    <a class="board__btn" href="login.php">log in</a>
                <?php }else{ ?>
                    <a class="board__btn" href="logout.php">log out</a>
                    <span class="update-nickname board__btn">Update nickname</span> </h3> 
                    <form class="board__new-comment-form hide board__nickname-form" method="POST" action="update_user.php">
                        <div class="board__nickname">
                            <span>New nickname: </span>
                            <input type="text" name="nickname" />
                        </div>
                        <input class="board__submit-btn" type="submit"/>
                    </form>
                    <h3>Hello <?php echo $user['nickname']; ?> 
                <?php } ?>
            </div>
            <h1 class="board__title">Comments</h1>
            <form class="board__new-comment-form" method="POST" action="handle_add_comment.php" onsubmit="return validateForm()">
                <textarea name="content" rows="5" id="content"></textarea>
                <?php if($username){ ?>
                    <input class="board__submit-btn" type="submit" />
                <?php }else{?>
                    <h3>Please log in</h3>
                 <?php }?>    
            </form>
           
            <script>
                function validateForm() {
                    var content = document.getElementById('content').value;
                    if (content.trim() === '') {
                        alert('comment  is empty');
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
                            <span class="card__author"><?php echo escape($row['nickname']); ?>
                            (@<?php echo escape($row['username']);?>)</span>
                            <span class="card__time"><?php echo $row['created_at']; ?></span>
                            <?php if($row['username']===$username){?>
                                <a href="update_comment.php?id=<?php echo $row['id'] ?>">Update comment</a>
                                <a href="delete_comment.php?id=<?php echo $row['id'] ?>">Delete comment</a>
                            <?php }?>
                        </div>
                        <p class="card__content"><?php echo escape($row['content']); ?></p>
                    </div>
                </div>
                <?php } ?>
            </section>
            <div class="board__hr"></div>
            <?php
                 $stmt = $conn->prepare('SELECT count(id) as count from comments');
                 $result = $stmt->execute();
                 $result = $stmt->get_result();
                 $row = $result->fetch_assoc();
                 $count = $row['count'];
                 $total_page = ceil($count / $item_per_page);
            ?>
            <div class = "page-info">
                 <span> It has <?php echo $count;?> comments, page </span> 
                 <span> <?php echo $page?> / <?php echo $total_page?> </span>
            </div>
            <div class="paginator">
                <?php if($page != 1){?>
                    <a href="index.php?page=1">First page</a>
                    <a href="index.php?page=<?php echo $page - 1 ?>"> Previous page</a>
                <?php }?>
                <?php if($page != $total_page){?>
                    <a href="index.php?page=<?php echo $page + 1 ?>">Next page</a>
                    <a href="index.php?page=<?php echo $total_page?>">Last page</a>
                <?php }?>
            </div>
         </main>
         <script>
            var btn = document.querySelector('.update-nickname')
            btn.addEventListener('click', function(){
                var form = document.querySelector('.board__nickname-form')
                form.classList.toggle('hide')
            })
        </script>
    </body>
</html>