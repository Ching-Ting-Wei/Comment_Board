<?php
    session_start();
    require_once("conn.php");
    require_once("utils.php");
    $username = NULL;
    $user = NULL;
    $id = $_GET['id'];

    if(!empty($_SESSION["username"])){
        $username = $_SESSION["username"];
        $user = getUserFromUsername($username);
    }
    $stmt = $conn->prepare('SELECT * FROM comments where id = ?');
    $stmt->bind_param('i', $id);
    $result = $stmt->execute();
    if(!$result){
        die('Error' . $conn->error);
    }
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
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
            
            <h1 class="board__title">Update comment</h1>
            <form class="board__new-comment-form" method="POST" action="handle_update_comment.php" onsubmit="return validateForm()">
                <textarea name="content" rows="5" id="content"><?php echo $row['content']; ?></textarea>    
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <input class="board__submit-btn" type="submit" />               
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