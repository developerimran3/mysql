<?php

if (file_exists(__DIR__ . "/autoload.php")) {
    require_once(__DIR__ . "/autoload.php");
} else {
    echo "autoload.php not found";
} ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Database</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<?php

$connection = new PDO("mysql:host=localhost;dbname=students", "imran", "27432afnanimu@");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $gender = $_POST['gender'];

    if (empty($name) || empty($email) || empty($phone) || empty($location) || empty($gender)) {
        $msg = createAlert('All Fields Are Requerd');
    } else {
        $sql = "INSERT INTO allStudents (name, email, phone, location, gender) VALUES ('$name', '$email', '$phone', '$location', '$gender')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $msg = createAlert('Data Submited', 'success');
    };
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container my-5">
        <div class="row ">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <!-- Form Control -->
                    <div class="card-head">
                        <h2>Create New Developer</h2>
                    </div>
                    <div class="card-body">
                        <div class="msg">
                            <?php echo $msg ?? '' ?>
                        </div>

                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="my-3">
                                <label for="">Name</label>
                                <input class="form-control" name="name" type="text">
                            </div>
                            <div class="my-3">
                                <label for="">Email</label>
                                <input class="form-control" name="email" type="text">
                            </div>
                            <div class="my-3">
                                <label for="">Phone</label>
                                <input class="form-control" name="phone" type="text">
                            </div>
                            <div class="my-3">
                                <label for="">Location</label>
                                <select class="form-control" name="location" id="">
                                    <option value="">Select Location</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Barishal">Barishal</option>
                                    <option value="Chittagong">Chittagong</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                </select>
                            </div>
                            <div class="my-3">
                                <label>Gender</label>
                                <br />
                                <label>
                                    <input type="radio" name="gender" value="Male" checked> Male
                                </label>
                                <label>
                                    <input type="radio" name="gender" value="Female"> Female
                                </label>
                            </div>
                            <div class="my-3">
                                <input type="submit" name="submit" value="create" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- All Developer Show -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>Gender</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM allStudents ";
                                $statement = $connection->prepare($sql);
                                $statement->execute();
                                $data = $statement->fetchAll(PDO::FETCH_OBJ);

                                foreach ($data as $item):
                                ?>
                                    <tr>
                                        <td><?php echo $item->id; ?> </td>
                                        <td><?php echo $item->name; ?> </td>
                                        <td><?php echo $item->email; ?> </td>
                                        <td><?php echo $item->phone; ?> </td>
                                        <td><?php echo $item->location; ?> </td>
                                        <td><?php echo $item->gender; ?> </td>
                                        <!-- <td><?php echo $item->action; ?> </td> -->
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>