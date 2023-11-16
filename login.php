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
            <a class="board__btn" href="index.php">Back to comments</a>
            <a class="board__btn" href="register.php">Sign up</a>
            <h1 class="board__title">Log in</h1>
            <?php 
                if(!empty($_GET['errCode'])){
                    $code = $_GET['errCode'];
                    $msg = 'error';
                    if($code === '2'){
                        $msg = "username or password is wrong";
                    }
                    echo '<h2 class="error"> error: ' . $msg . '</h2>';
                }
             ?>
            <form class="board__new-comment-form" method="POST" action="handle_login.php" onsubmit="return validateForm()">
                <div class="board__nickname">
                    <span>username:</span>
                    <input type="text" name="username" id="username"/>
                </div>
                <div class="board__nickname">
                    <span>password:</span>
                    <input type="password" name="password" id="password"/>
                </div>
                <input class="board__submit-btn" type="submit" />
            </form>
            <script>
                function validateForm() {
                    var username = document.getElementById('username').value;
                    var password = document.getElementById('password').value;
                    if (username.trim() === '' || password.trim() === '') {
                        alert('Empty input');
                        return false;
                    }
                    return true; 
                    }
            </script>
         </main>
    </body>
</html>