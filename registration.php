<?php


function submitForm() {
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if ($password == $confirmpassword) {

        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "registrationdb";
        
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "<script>alert('Success')</script";

        $lastname = $_POST['lastName'];
        $firstname = $_POST['firstName'];
        $gender = $_POST['gender'];
        $birth = $_POST['birth'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];


        $sql = "INSERT INTO users (lastname, firstname, gender, birth ,username, password)
        VALUES ( '$lastname', '$firstname', '$gender','$birth','$username','$password')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        header("Location: http://localhost/php-projects/personal-projects/fullstack-php/login.php");
        exit();
  

    }
    else
    {
        echo "<script>alert('Password not the same with confirm password')</script>";
    }
}

if(isset($_POST['submit'])) {
    submitForm();
}


function redirectForm() {
    header("Location: http://localhost/php-projects/personal-projects/fullstack-php/login.php");
    exit();
}

if(isset($_POST['login'])) {
    redirectForm();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Registration Module </title>
    <style>
        #form-cont {
            position: relative;
            margin-top: 100px;
            margin-right: 400px;
            margin-left: 400px;
            padding: 30px;
        }

        #php-code h1 {
            text-align: center;
        }

        @media only screen and (max-width: 1000px)  {
            #form-cont {
                position: relative;
                margin-top: 100px;
                margin-right: 0px;
                margin-left: 0px;
                padding: 30px;
            }
        }
    </style>
</head>
<body>


    <form  method="post">
        <div id="form-cont" class="text-center border-4 rounded">
            <h1 class="font-bold text-3xl bg-emerald-600 p-3 text-white rounded ">Register Form</h1>
            <div class="m-5 ">
                <label for="lastName">Last Name:</label>
                <input class="border-4 rounded" type="text" id="lastName" name="lastName"/>
            </div>
            <div class="m-5">
                <label for="firstName">First Name:</label>
                <input class="border-4 rounded" type="text" id="firstName" name="firstName"/>
            </div>
            <div class="m-5">
                <label for="gender">Gender:</label>
                <select name="gender" id="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="m-5">
                <label for="birth">Date of birth:</label>
                <input class="border-4 rounded" type="date" id="birth" name="birth"/>
            </div>
            <div class="m-5">
                <label for="username">Username:</label>
                <input class="border-4 rounded" type="text" id="username" name="username"/>
            </div>
            <div class="m-5">
                <label for="password">Password:</label>
                <input class="border-4 rounded" type="password" id="password" name="password"/>
            </div>
            <div class="m-5">
                <label for="password">Confirm Password:</label>
                <input class="border-4 rounded" type="password" id="confirmpassword" name="confirmpassword"/>
            </div>

            <button type="submit" name="submit" value="click" class="btn p-3 m-3 rounded-lg text-white btn-primary bg-emerald-600">Send Data</button>

            <button type="submit" name="login" class="btn p-3 m-3 rounded-lg text-white btn-primary bg-black">Login?</button>

        </div>
    </form>

</body>
</html>