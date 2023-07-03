<?php
    session_start();

    if (isset($_POST['login']))
{
    //Kết nối đến database
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'my_database';
    $conn = mysqli_connect($host, $user, $pass, $database);

    //Lấy dữ liệu người dùng nhập vào
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Kiểm tra người dùng đã nhập đủ thông tin chưa, nếu chưa thì nhập lại
    if (!$username || !$password) {
        echo "Please enter full information.";
        echo "<br/>";
        echo "<a href='login.php' title='login'>Try again</a>";
        exit;
    }

    //Thực hiện truy vấn username và password
    $query = mysqli_query($conn, "SELECT username, password FROM user WHERE username='$username'");

    //Kiểm tra xem username có tồn tại không, nếu có thì so sánh mật khẩu
    if (mysqli_num_rows( $query) == 0) {
        echo "Incorrect account or password.";
        echo "<br/>";
        echo "<a href='login.php' title='login'>Try again</a>";
        exit;
    }

    $passwd = mysqli_fetch_array($query);
    if ($password != $passwd['password']) {
        echo "Incorrect account or password.";
        echo "<br/>";
        echo "<a href='login.php' title='login'>Try again</a>";
        exit;
    }

    //Sau khi thỏa điều kiện thì thông báo đăng nhập thành công rồi chuyển hướng sang search.php
    $_SESSION['username'] = $username;
    echo "Login success, hello ". $username ." let's go to the <a href='search.php' title='main page'>main page</a>";
    mysqli_close($conn);
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Doubt</title>
    </head>
    <body>
        <h1>Welcome! Please login.</h1>
        <form action='login.php?do=login' method='POST'>
            Username: <input type="text" name="username" value=""/> <br/>
            Password: <input type="text" name="password" value=""/> <br/>
            <input type="submit" name="login" value="Login"/><br/>
            Don't have an account? <a href='register.php' title='Register'>Register here</a>
        </form>
    </body>
</html>