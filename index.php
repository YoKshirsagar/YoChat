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
    $user = $row["name"];
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
            <?php
                $query = "SELECT * FROM `chat`";
                $result = mysqli_query($conn, $query);
                while($row = $result->fetch_assoc()): 
            ?>
                <?php if (!($row["user"] === $user)): ?>
                    <div class="msg left-msg">
                        <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)">
                        </div>

                        <div class="msg-bubble">
                            <div class="msg-info">
                                <div class="msg-info-name"><?php echo $row["user"]?></div>
                                <div class="msg-info-time"><?php echo $row["ctime"]?></div>
                            </div>

                            <div class="msg-text">
                                <?php echo $row["msg"]?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($row["user"] == $user): ?>
                    <div class="msg right-msg">
                        <div class="msg-img" style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)">
                        </div>
                        <div class="msg-bubble">
                            <div class="msg-info">
                                <div class="msg-info-name"><?php echo $row["user"]?></div>
                                <div class="msg-info-time"><?php echo $row["ctime"]?></div>
                            </div>

                            <div class="msg-text">
                                <?php echo $row["msg"]?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </main>

        <form class="msger-inputarea">
            <input type="text" class="msger-input" placeholder="Enter your message...">
            <button type="submit" class="msger-send-btn">Send</button>
        </form>
    </section>
</body>

</html>