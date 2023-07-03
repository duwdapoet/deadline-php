<?php
    session_start();
    if (isset($_SESSION['username'])){
        echo "Welcome back, my friend! Let's find another users using ID.";
        echo "<br/>";
        echo "Or <a href='login.php'>Go back to login page</a>";
        echo "<br/>";
    }
    else {
        header("Location: login.php");
        die();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Doubt</title>
    </head>
    <body>
        <form action='search.php' method='GET'>
            <br/>
            <input type="text" name="id" />
            <input type="submit" name="search" value="Search" />
        </form>
    </body>
    <?php
        if (isset($_REQUEST['search']))
    {   
        $id = $_REQUEST['id'];
        //Kiểm tra xem người dùng có nhập thông tin hay không
        if (empty($id)) {
            echo "Please enter the ID.";
        }
        else
        {
            $query = "SELECT * FROM user WHERE ID like '%$id%'";

            //Kết nối đến database
            $host = 'localhost';
            $user = 'root';
            $pass = '';
            $database = 'my_database';
            $conn = mysqli_connect($host, $user, $pass, $database);

            //Kiểm tra xem có tồn tại user trong database hay không, nếu có thì hiển thị
            if (mysqli_num_rows(mysqli_query($conn, $query)) > 0) {
                $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
                echo "Yes, we found the user. Here is his/her information:";
                echo "<br/>";
                echo "ID: " . $id;
                echo "<br/>";
                echo "Username: " . $row['username'];
                echo "<br/>";
                echo "Email: " . $row['email'];
            }
            else {
                echo "Sorry, we didn't find that user. Maybe you can try another ID.";
            }

        }
    }
    ?>
</html>

        