<?php   
session_start();  

?>
<html>
  <head>
        <script src="https://cdn.tailwindcss.com"></script>
       <title> Home </title>
  </head>
  <body>
    <?php
    if(!isset($_SESSION['login'])) // If session is not set then redirect to Login Page
    {
     header("Location:Login.php");  
    }

    function logout() {

      session_destroy();

      header("Location:login.php"); 
    }

    if(isset($_POST['logout'])) {
      logout();
    }

    

    function changepass() {
      $current_pass = $_POST['currentpass'];
      $new_pass = $_POST['newpass'];
      $confirm = $_POST['confirm'];

      if ($new_pass == $confirm) {

        $user = $_SESSION['username'];

        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "registrationdb";
        
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
   
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "<script>alert('Connection Success')</script";
   
        $sql = "SELECT * FROM users WHERE username = '$user' and password = '$current_pass'";
        $res = mysqli_query($conn,$sql);
        $result = mysqli_fetch_array($res, MYSQLI_NUM);
   

        if($result) {

          if ($current_pass == $result[6]) {

              $sql = "UPDATE users SET password = '$new_pass' WHERE username = '$user'";

              if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Password modifed')</script";
              } else {
                  echo "Error: " . $sql . "<br>" . $conn->error;
              }

              mysqli_close($conn);
          }

        }
        else {
          echo "<script>alert('Wrong Password')</script";

          header("Location:Login.php");  


          mysqli_close($conn);
        }


      } else {
        echo "<script>alert('Password not the same with confirm password')</script>";
      }

    }

    if(isset($_POST['changepass'])) {
      changepass();
    }




    ?>

    <form method="post">
    <div class="border-8 my-52 lg:mx-64 p-5 ">
      <h1 class="text-white text-lg font-bold p-5 bg-emerald-600">User Information Form</h1>
      <div class="bg-white m-5 p-5">
        <h1><b>Welcome </b> <?php echo $_SESSION['firstname']?> <?php echo $_SESSION['lastname']?></h1>
        <h1><b>Birthday: </b><?php echo $_SESSION['birth'] ?></h1>
        <h1><b>Gender: </b><?php echo $_SESSION['gender'] ?></h1>
      </div>
      <div class="text-center">
        <h1 class="font-bold">Reset Password</h1>
        <div class="m-5 ">
          <label for="username">Enter Current Password: </label>
          <input class="border-4 rounded" type="password" id="currentpass" name="currentpass"/>
        </div>
        <div class="m-5">
          <label for="password">Enter New Password: </label>
          <input class="border-4 rounded" type="password" id="newpass" name="newpass"/>
        </div>
        <div class="m-5">
          <label for="password">Re-Enter New Password: </label>
          <input class="border-4 rounded" type="password" id="confirm" name="confirm"/>
        </div>

        <button type="submit" name="changepass" value="changepass" class=" btn p-3 m-3 rounded-lg text-white btn-primary bg-black">Change Password</button>

        <button type="submit" name="logout" value="logout" class=" btn p-3 m-3 rounded-lg text-white btn-primary bg-emerald-600">Logout</button>
      </div>
    </div>
  </form>



  </body>
</html>