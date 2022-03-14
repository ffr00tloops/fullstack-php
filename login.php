<?php  

session_start();   // session starts with the help of this function 


if(isset($_SESSION['use']))   // Checking whether the session is already there or not if 
                              // true then header redirect it to the home page directly 
 {
    header("Location:home.php"); 
 }

if(isset($_POST['login']))   // it checks whether the user clicked login button or not 
{
     $user = $_POST['user'];
     $pass = $_POST['pass'];


     $servername = "localhost";
     $dbusername = "root";
     $dbpassword = "";
     $dbname = "registrationdb";
     
     $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
     echo "<script>alert('Connection Success')</script";

     $sql = "SELECT * FROM users WHERE username = '$user' and password = '$pass'";
     $res = mysqli_query($conn,$sql);
     $result = mysqli_fetch_array($res, MYSQLI_NUM);

     if($result)
     {
         
         $_SESSION["login"]="1";
         $_SESSION["user"] = $user;
         $_SESSION["lastname"] = $result[1];
         $_SESSION["firstname"] = $result[2];
         $_SESSION["gender"] = $result[3];
         $_SESSION["birth"] = $result[4];
         $_SESSION["username"] = $result[5];


         header("location:home.php");

         mysqli_close($con);
     }
     else	
     {
        header("location:login.php?err=1");
         

        mysqli_close($con);
         
         
     }
}


        function redirectForm() {
            header("Location: http://localhost/php-projects/personal-projects/fullstack-php/registration.php");
            exit();
        }

        if(isset($_POST['register'])) {
            redirectForm();
        }

 ?>
<html>
<head>

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

</head>

<body>

<form action="" method="post">
        <div id="form-cont" class="text-center border-4 rounded">
            <h1 class="font-bold text-3xl bg-emerald-600 p-3 text-white rounded ">Login Form</h1>
            <div class="m-5 ">
                <label for="username">Username:</label>
                <input class="border-4 rounded" type="text" id="user" name="user"/>
            </div>
            <div class="m-5">
                <label for="passwored">Password:</label>
                <input class="border-4 rounded" type="password" id="pass" name="pass"/>
            </div>
            <div class="m-5">
                <label for="vehicle3">Remember me</label>
                <input type="checkbox" id="remember" name="remember" value="check"/>
            </div>

            <button type="submit" name="login" value="LOGIN" class="btn p-3 m-3 rounded-lg text-white btn-primary bg-emerald-600">Login</button>

            <button type="submit" name="register" value="LOGIN" class="btn p-3 m-3 rounded-lg text-white btn-primary bg-black">Register?</button>

        </div>
    </form>

</body>
</html>