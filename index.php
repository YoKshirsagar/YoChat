<?php
    session_start();
    if(!isset($_SESSION["username"])){
         header("Location: login.php");
         exit();
    }
    $username = $_SESSION["username"];
    include "db_connect.php";
    $query = "SELECT * FROM users WHERE username='".$_SESSION["username"]."'";
    $result = mysqli_query($conn, $query);
    $row = $result->fetch_assoc();  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
</head>

<body>
    <section class="msger">
        <header class="msger-header">
            <div class="msger-header-title">
                <i class="fas fa-comment-alt"></i> Secret Chat - <?php echo $row["name"] ;?>
            </div>
            <div class="msger-header-options">
                <span><i class="fas fa-cog"></i></span>
            </div>
        </header>

        <main class="msger-chat">
            <div class="msg left-msg">
                <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)">
                </div>

                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">BOT</div>
                        <div class="msg-info-time">12:45</div>
                    </div>

                    <div class="msg-text">
                        Hi, welcome to SimpleChat! Go ahead and send me a message. 😄
                    </div>
                </div>
            </div>

            <div class="msg right-msg">
                <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)">
                </div>
                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">Sajad</div>
                        <div class="msg-info-time">12:46</div>
                    </div>

                    <div class="msg-text">
                        You can change your name in JS section!
                    </div>
                </div>
            </div>
        </main>

        <form class="msger-inputarea">
            <input type="text" class="msger-input" placeholder="Enter your message...">
            <button type="submit" class="msger-send-btn">Send</button>
        </form>
    </section>
</body>

</html>