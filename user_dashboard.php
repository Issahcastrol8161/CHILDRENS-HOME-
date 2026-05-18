<?php include("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .card { margin-bottom: 20px; }
        .navbar-brand{
            align-content: center;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Mother Teresa Children’s Home</span>
    </div>
</nav>
<div class="container mt-4">
    <h2>User Dashboard</h2>

    <div class="card p-3">
        <h4>Children Branches</h4>
        <?php
        $branches = mysqli_query($conn, "SELECT DISTINCT branch FROM children");
        if (mysqli_num_rows($branches) > 0) {
            while ($b = mysqli_fetch_assoc($branches)) {
                echo $b['branch']."<br>";
            }
        } else {
            echo "No branches found.";
        }
        ?>
    </div>

    <div class="card p-3">
        <h4>Total Children</h4>
        <?php
        $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM children");
        $c = mysqli_fetch_assoc($count);
        echo $c ? $c['total'] : "0";
        ?>
    </div>

    <div class="card p-3">
        <h4>Services</h4>
        <?php
        $services = mysqli_query($conn, "SELECT * FROM services");
        while ($s = mysqli_fetch_assoc($services)) {
            echo "<b>".$s['service_name']."</b>: ".$s['description']."<br>";
        }
        ?>
    </div>

    <div class="card p-3">
        <h4>Main Donor</h4>
        <?php
        $donor = mysqli_query($conn, "SELECT * FROM donors LIMIT 1");
        $d = mysqli_fetch_assoc($donor);
        echo $d ? $d['name']." (".$d['contribution'].")" : "No donor found.";
        ?>
    </div>

    <div class="card p-3">
        <h4>Best Students</h4>
        <?php
        $students = mysqli_query($conn, "SELECT * FROM success_stories");
        while ($st = mysqli_fetch_assoc($students)) {
            echo $st['student_name']." - ".$st['achievement']."<br>";
        }
        ?>
    </div>

    <div class="card p-3">
        <h4>Request Form</h4>
        <form>
            <input type="text" name="area" class="form-control mb-2" placeholder="Enter your area">
            <button class="btn btn-primary">Request Access</button>
        </form>
    </div>
</div>
</body>
</html>
