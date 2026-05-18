<?php include("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('download.jpeg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
        }
        .form-container {
            max-width: 300px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 20px;
            background: rgba(0,0,0,0.5);
            box-shadow: 0 8px 20px rgba(0,0,0,0.6);
        }
        label {
            font-weight: bold;
            color: grey;
        }
        h2 {
            font-weight: bold;
            color: gold;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.8);
            font-family: wide latin;
        }
        .btn {
            font-weight: bold;
            border-radius: 25px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2 class="text-center">Sign In</h2>
    <form method="post">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="signin" class="btn btn-success w-100">Sign In</button>
    </form>
</div>
</body>
</html>

<?php
if (isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        if ($row['role'] == "admin") {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
    } else {
        echo "<script>alert('Invalid login!');</script>";
    }
}
?>
