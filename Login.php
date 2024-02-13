<?php
$conn = mysqli_connect("localhost:3369", "root", "", "rto");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<html>
<head>
    <title>Login</title>
</head>
<body bgcolor="#FCDDFC" vlink="blue">
<br>
<br>
<center>
    <img src="RTO.jpg" alt="RTO"><br>
    <font size="25">Regional Transport Office</font>
    <br><br>
    <form action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Admin</legend>
            <table align="center" bgcolor="#daffb3" border="1" cellpadding="8" cellspacing="5">
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><input type="text" name="username"/></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="password"/></td>
                </tr>
            </table>
            <br>
            <table cellpadding="8" cellspacing="5">
                <tr>
                    <td colspan="3" align="center"><input type="submit" value="Login" name="save"/></td>
                </tr>
            </table>
        </fieldset>
    </form>
    <br><br>
</center>
</body>

<?php
if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Redirect to home page after successful login
        header('Location: Home.php');
        exit();
    } else {
        echo "<center><h2>Error :</h2>Wrong Credentials!<br>Enter valid Credentials.<br></center>";
    }
    $stmt->close();
}
?>

</html>

<?php mysqli_close($conn); ?>
