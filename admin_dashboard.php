<?php include("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        .navbar {
            background-color: #007bff !important;
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2, h4 {
            font-weight: bold;
            color: #007bff;
            font-size: 1.1rem;
        }
        .btn {
            border-radius: 15px;
            font-weight: bold;
            font-size: 0.9rem;
        }
        .metric-icon {
            font-size: 0.9rem;
            margin-right: 6px;
            color: #007bff;
        }
        .metric-value {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Admin Dashboard</span>
    </div>
</nav>

<div class="container mt-3">

    <!-- Metrics in pairs -->
    <div class="row">
        <div class="col-md-6">
            <div class="card text-center">
                <span class="metric-icon">👶</span>
                <div class="metric-value">
                    <?php $c=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM children")); echo $c?$c['total']:"0"; ?>
                </div>
                <h4>Students</h4>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center">
                <span class="metric-icon">👷</span>
                <div class="metric-value">
                    <?php $c=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM employees")); echo $c?$c['total']:"0"; ?>
                </div>
                <h4>Workers</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card text-center">
                <span class="metric-icon">❌</span>
                <div class="metric-value">
                    <?php $c=mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM deleted_workers")); echo $c?$c['total']:"0"; ?>
                </div>
                <h4>Deleted</h4>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center">
                <span class="metric-icon">📊</span>
                <div class="metric-value">Analytics</div>
                <h4>Overview</h4>
            </div>
        </div>
    </div>

    <!-- Forms in pairs -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <h2>Add Child</h2>
                <form method="post">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
                    <input type="number" name="age" class="form-control mb-2" placeholder="Age" required>
                    <input type="text" name="branch" class="form-control mb-2" placeholder="Branch" required>
                    <button type="submit" name="add_child" class="btn btn-success w-100">Add</button>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h2>Add Worker</h2>
                <form method="post">
                    <input type="text" name="emp_name" class="form-control mb-2" placeholder="Name" required>
                    <input type="text" name="emp_no" class="form-control mb-2" placeholder="Number" required>
                    <input type="text" name="skills" class="form-control mb-2" placeholder="Skills" required>
                    <button type="submit" name="add_emp" class="btn btn-primary w-100">Add</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Remove + Analytics buttons side by side -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <h2>Remove Worker</h2>
                <form method="post">
                    <input type="text" name="remove_emp_no" class="form-control mb-2" placeholder="Employee Number" required>
                    <button type="submit" name="remove_emp" class="btn btn-danger w-100">Remove</button>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h2>Analytics</h2>
                <button class="btn btn-outline-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#studentList">Students List</button>
                <div class="collapse" id="studentList">
                    <?php $students=mysqli_query($conn,"SELECT * FROM children"); while($s=mysqli_fetch_assoc($students)){ echo "👶 ".$s['name']." (Age: ".$s['age'].", Branch: ".$s['branch'].")<br>"; } ?>
                </div>

                <button class="btn btn-outline-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#workerList">Workers List</button>
                <div class="collapse" id="workerList">
                    <?php $workers=mysqli_query($conn,"SELECT * FROM employees"); while($w=mysqli_fetch_assoc($workers)){ echo "👷 ".$w['name']." (No: ".$w['employee_number'].", Skills: ".$w['skills'].")<br>"; } ?>
                </div>

                <button class="btn btn-outline-primary mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#deletedList">Deleted Workers</button>
                <div class="collapse" id="deletedList">
                    <?php $deleted=mysqli_query($conn,"SELECT * FROM deleted_workers"); while($d=mysqli_fetch_assoc($deleted)){ echo "❌ ".$d['name']." (No: ".$d['employee_number'].")<br>"; } ?>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>

<?php
// Add Child
if (isset($_POST['add_child'])) {
    $sql="INSERT INTO children (name, age, branch) VALUES ('".$_POST['name']."','".$_POST['age']."','".$_POST['branch']."')";
    if(mysqli_query($conn,$sql)){ echo "<div class='alert alert-success text-center'>Student added successfully!</div>"; }
}
// Add Employee
if (isset($_POST['add_emp'])) {
    $sql="INSERT INTO employees (name, employee_number, skills) VALUES ('".$_POST['emp_name']."','".$_POST['emp_no']."','".$_POST['skills']."')";
    if(mysqli_query($conn,$sql)){ echo "<div class='alert alert-success text-center'>Worker added successfully!</div>"; }
}
// Remove Employee
if (isset($_POST['remove_emp'])) {
    $emp_no=$_POST['remove_emp_no'];
    $worker=mysqli_query($conn,"SELECT * FROM employees WHERE employee_number='$emp_no'");
    $w=mysqli_fetch_assoc($worker);
    if($w){
        mysqli_query($conn,"INSERT INTO deleted_workers (name, employee_number) VALUES ('".$w['name']."','".$w['employee_number']."')");
        mysqli_query($conn,"DELETE FROM employees WHERE employee_number='$emp_no'");
        echo "<div class='alert alert-warning text-center'>Worker removed successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Worker not found!</div>";
    }
}
?>
