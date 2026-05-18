<?php include("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
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
            border-radius: 20px; /* rounded box */
            background: rgba(0,0,0,0.5); /* subtle dark overlay */
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
            font-family: Wide Latin;
        }
        .btn {
            font-weight: bold;
            border-radius: 25px;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2 class="text-center">User Sign Up</h2>
    <form method="post">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" name="signup" class="btn btn-primary w-100">Sign Up</button>
    </form>
</div>
</body>
</html>

<?php
if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username','$password','$role')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('User registered successfully!'); window.location='signin.php';</script>";
    }
}
?>
