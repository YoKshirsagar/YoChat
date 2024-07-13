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
                <i class="fas fa-comment-alt"></i> Secret Chat - <?php echo $user ;?>
            </div>
            <div class="msger-header-options">
                <span><i class="fas fa-cog"></i><a href="logout.php">LogOut</a></span>
            </div>
        </header>

        <main id="scrollid" class="msger-chat">
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
            <input type="text" name="textmsgsent" id="textmsgsent" class="msger-input"
                placeholder="Enter your message...">
            <button type="submit" name="submit" id="submit" class="msger-send-btn">Send</button>
        </form>
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$("#submit").click(function() {
    let textmsgsent = $("#textmsgsent").val();
    $.post("postmsg.php", {
            text: textmsgsent,
            user: '<?php echo $user; ?>',
            ip: '<?php echo $_SERVER["REMOTE_ADDR"]?>'
        },
        function(data, status) {
            document.getElementByClassName('msg right-msg')[0].innerHTML = data;
        });
});
</script>
<script>
    let scrollableDiv = document.getElementById('scrollid');
    scrollableDiv.scrollTop = scrollableDiv.scrollHeight;
</script>
</html>