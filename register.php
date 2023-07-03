<?php
    if (isset($_POST['register']))
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
    $email = $_POST['email'];

    //Kiểm tra người dùng đã nhập đủ thông tin chưa, nếu chưa thì nhập lại
    if (!$username || !$password || !$email) {
        echo "Please enter full information.";
        echo "<br/>";
        echo "<a href='register.php' title='login'>Try again</a>";
        exit;
    }
    
    //Kiểm tra tên đăng nhập đã tồn tại chưa
    if (mysqli_num_rows(mysqli_query($conn, "SELECT username FROM user WHERE username='$username'")) > 0) {
        echo "Username is already taken";
        echo "<br/>";
        echo "<a href='register.php' title='login'>Try again</a>";
        exit;
    }

    //Kiểm tra email có đúng định dạng abc@example.com không
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        echo "Invalid email.";
        echo "<br/>";
        echo "<a href='register.php' title='login'>Try again</a>";
        exit;
    }

    //Kiểm tra email đã có người dùng chưa
    if (mysqli_num_rows(mysqli_query($conn, "SELECT email FROM user WHERE email='$email'")) > 0)
    {
        echo "Email is already taken.";
        echo "<br/>";
        echo "<a href='register.php' title='login'>Try again</a>";
        exit;
    }

    //Sau khi thỏa tất cả điều kiện thì lưu thông tin vào database 
    @$addmember = mysqli_query($conn,"
    INSERT INTO USER (
        username,
        password,
        email
    )
    VALUE (
        '{$username}',
        '{$password}',
        '{$email}'
    )
");
    //Thông báo quá trình đăng ký vào chuyển về trang đăng nhập
    if ($addmember){
        mysqli_close($conn);
        echo "Registration has been completed.";
        echo "<br/>";
        echo "<a href='login.php' title='login'>Go to login page</a>";
        exit; }
    else
        echo "Something happened and we were unable to complete the registration process for you, please try again";
        echo "<br/>";
        echo "<a href='register.php' title='login'>Try again</a>";
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
        <h1>Welcome to register page! Please enter your information.</h1>
        <form action='register.php?do=register' method='POST'>
            Username: <input type="text" name="username" value=""/> <br/>
            Password: <input type="text" name="password" value=""/> <br/>
            Email: <input type="text" name="email" value=""/> <br/>
            <input type="submit" name="register" value="Register"/><br/>
            Already had an account? <a href='login.php' title='Login'>Login here</a>
        </form>
    </body>
</html>