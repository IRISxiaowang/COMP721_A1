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
    <title>Drop Table</title>
</head>

<body>
    <div class="content">
        <div class="top-container">
            <img class="top-cloud" src="imgs/post.png" alt="cloud-img">
            <h3>Status Posting System</h4>
        </div>
        <?php
        //show error on the page
        ini_set('display_errors', true);
        error_reporting(E_ALL);
        require_once('../../conf/settings.php');
        // The @ operator suppresses the display of any error messages
        // mysqli_connect returns false if connection failed, otherwise a connection value
        $conn = @mysqli_connect(
            $sql_host,
            $sql_user,
            $sql_pass,
            $sql_db
        );
        // Checks if connection is successful
        if (!$conn) {
            echo "<p>Database connection failure</p>";
        } else {
            $query = "DROP TABLE $assignTable";
            $result = mysqli_query($conn, $query);
            // Execute query and check is table dropped.
            if ($result) {
                echo "<p>Table $assignTable dropped successfully!</p>";
            } else {
                echo "<p>Error dropping table.</p>";
            }
            mysqli_close($conn);
        }
        ?>
        <div class="bottom-container">
            <a href="index.html">
                <p>Return to Home Page</p>
            </a>
            <p class="name">© Xiao Wang 21129395</p>
        </div>
    </div>
</body>

</html>