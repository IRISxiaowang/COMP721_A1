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
    <title>Post status Databases</title>
</head>

<body>

    <div class="content">
        <div class="top-container">
            <img class="top-cloud" src="imgs/post.png" alt="cloud-img">
            <h3>Status Posting System</h4>
        </div>
        <?php
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

        function insertQuery($conn, $assignTable, $statuscode, $poststatus, $privacy, $datetoday, $allowLike, $allowComments, $allowShare)
        {
            // Set up the SQL command to add the data into the table
            $query = "insert into $assignTable"
                . "(id, statuscode, poststatus, privacy, datetoday, allowlike, allowcomment, allowshare)"
                . "values"
                . "('null','$statuscode','$poststatus','$privacy','$datetoday','$allowLike','$allowComments','$allowShare')";
            // executes the query
            $result = mysqli_query($conn, $query);
            // checks if the execution was successful
            if (!$result) {
                echo "<p>Something is wrong with ", $query, "</p>";
            } else {
                // display an operation successful message
                echo "<p>Congratulations! The status has been posted!</p>";
            }
        }
        // Checks if connection is successful
        if (!$conn) {
            // Displays an error message
            echo "<p>Database connection failure</p>";
        } else {
            // Upon successful connection
            // Check $assignTable is exist
            if (!mysqli_query($conn, "select 1 from $assignTable LIMIT 1")) {
                //Check database is exist, if table is not exist create one 
                if (mysqli_select_db($conn, $sql_db)) {
                    $sqlString = "CREATE TABLE $assignTable(id INT AUTO_INCREMENT PRIMARY KEY, statuscode VARCHAR(40),
            poststatus VARCHAR(40), privacy VARCHAR(20), datetoday Date, allowlike int, allowcomment int, allowshare int)";
                    $createTable = mysqli_query($conn, $sqlString);
                } else {
                    echo ("<p>Database is not exist.</p>");
                    return;
                }
            }
            $statuscode = mysqli_escape_string($conn, $_POST['statuscode']);
            // Check if status code already exists in table
            $check_query = "SELECT * FROM $assignTable WHERE statuscode = '$statuscode'";
            $result = mysqli_query($conn, $check_query);

            if (mysqli_num_rows($result) > 0) {
                // Status code already exists in table, display error message
                echo "<p>Error: Status code '$statuscode' already exists, Please try another one!</p>";
            } else {
                $date = DateTime::createFromFormat('Y-m-d', $_POST["date"]);
                $day = (int) $date->format('d');
                $month = (int) $date->format('m');
                $year = (int) $date->format('Y');
                if (checkdate($month, $day, $year)) {
                    $status = $_POST["status"];
                    // Remove spaces from $status
                    $trimstatus = trim($status);
                    // Check if $status is empty or not
                    if (empty($trimstatus)) {
                        // Show error message here
                        echo "<p>Error: Status cannot be empty</p>";
                    } else {
                        $allowLike = isset($_POST['like']) ? 1 : 0;
                        $allowComments = isset($_POST['comment']) ? 1 : 0;
                        $allowShare = isset($_POST['share']) ? 1 : 0;
                        insertQuery($conn, $assignTable, mysqli_escape_string($conn, $_POST["statuscode"]), mysqli_escape_string($conn, $_POST["status"]), mysqli_escape_string($conn, $_POST["privacy"]), mysqli_escape_string($conn, $_POST["date"]), $allowLike, $allowComments, $allowShare);
                    }

                } else {
                    echo "<p>Error: Date '$date'</p>";
                }
            }
            mysqli_close($conn);
        }
        ?>
        <div class="bottom-container">
            <a href="poststatusform.php">
                <p>Return to Post Status Page</p>
            </a>
            <a href="index.html">
                <p>Return to Home Page</p>
            </a>
            <p class="name">© Xiao Wang 21129395</p>
        </div>
    </div>
</body>

</html>