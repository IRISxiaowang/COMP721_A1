<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="imgs/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Montserrat&family=Sacramento&display=swap"
        rel="stylesheet">
    <title>Post status </title>
</head>

<body>
    <div class="top-container">
        <img class="top-cloud" src="imgs/post.png" alt="post-img">
        <h3>Status Posting System</h4>
    </div>
    <div class="middle-container">
        <form method="post" action="poststatusprocess.php">
            <p> <label for="code">Status Code: </label>
                <input type="text" name="statuscode" required pattern="S\d{4}" maxlength="5"
                    oninvalid="this.setCustomValidity('Wrong format! The status code must start with an \'S\' followed by four digits, like \'S0001\'.')"
                    oninput="this.setCustomValidity('')">
            </p>
            <p><label for="status">Status: </label>
                <input type="text" name="status" required pattern="[A-Za-z0-9. ,!\?]+(?:[,.!?][A-Za-z0-9]+)*"
                    oninvalid="this.setCustomValidity('Your status is in a wrong format! The status can only contain alphanumericals and spaces, comma, period, exclamation point and question mark and cannot be blank!')"
                    oninput="this.setCustomValidity('')">
            </p>
            <p><label for="share">Share: </label>
                <label>
                    <input type="radio" name="privacy" value="Public" required>
                    Public
                </label>
                <label>
                    <input type="radio" name="privacy" value="Friends">
                    Friends
                </label>
                <label>
                    <input type="radio" name="privacy" value="Only Me">
                    Only Me
                </label>
            </p>
            <p><label for="date">Date:</label>
                <input type="date" id="theDate" name="date" value="<?php echo date('Y-m-d'); ?>" required>
            </p>
            <p><label for="">Permission:</label>
                <input type="checkbox" id="like" name="like" value="0">
                <label for="like">Allow Like&nbsp&nbsp</label>

                <input type="checkbox" id="comment" name="comment" value="0">
                <label for="comment">Allow Comments&nbsp&nbsp</label>

                <input type="checkbox" id="share" name="share" value="0">
                <label for="share">Allow Share&nbsp&nbsp</label>
            </p>
            <p> <input type="submit" value="Post" /></p>
        </form>
    </div>
    <div class="bottom-container">
        <a href="index.html">
            <p>Return to Home Page</p>
        </a>
        <p class="name">© Xiao Wang 21129395</p>
    </div>
</body>

</html>