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
    <title>Search</title>
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
        // sql info or use include 'file.inc'
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
            // Displays an error message
            echo "<p>Database connection failure</p>";
        } else {
            // Upon successful connection
            // Check assignTable is exist, create one if it is not exist
            if (!mysqli_query($conn, "select 1 from $assignTable LIMIT 1")) {
                echo ("<p>No status found in the system. Please go to the post status page to post one.</p>");
            } else {

                $search = mysqli_escape_string($conn, $_GET["search"]);
                // Search data from $assignTable
                $query = "select * from $assignTable where poststatus like '%$search%'";
                $result = mysqli_query($conn, $query);
                // checks if the execution was successful
                if (!$result) {
                    echo "<p>Something is wrong with ", $query, "</p>";
                } else {
                    if (mysqli_num_rows($result) == 0) {
                        echo "<p>Status not found. Please try a different keyword.</p>";
                    } else {
                        // Print out the search result
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "Status: " . $row["poststatus"] . "<br><br>";
                            echo "Status Code: " . $row["statuscode"] . "<br><br>";
                            echo "Share: " . $row["privacy"] . "<br><br>";
                            echo "Date Posted: " . $row["datetoday"] . "<br><br>";
                            $allowLike = $row["allowlike"] == 1 ? 'Allow Like ' : '';
                            $allowComment = $row["allowcomment"] == 1 ? 'Allow Comments ' : '';
                            $allowShare = $row["allowshare"] == 1 ? 'Allow Share ' : '';
                            echo "Permission: " . $allowLike . $allowComment . $allowShare . "<br><br>";
                            echo "<br><br>";
                        }
                    }
                    mysqli_free_result($result);
                }
            }
            mysqli_close($conn);
        }
        ?>
        <div class="bottom-container">
            <a href="searchstatusform.html">
                <p>Search for another status</p>
            </a>
            <a href="index.html">
                <p>Return to Home Page</p>
            </a>
            <p class="name">© Xiao Wang 21129395</p>
        </div>
    </div>
</body>

</html>