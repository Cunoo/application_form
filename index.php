<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div id = "frm">  
        <h1>Login</h1>  
        <form name="f1" action="" method="POST">  
            <p>
                <label> UserName: </label>  
                <input type = "text" id ="user" name="user"/>  
            </p>  
            <p>  
                <label> Password: </label>  
                <input type = "password" id ="pass" name= "pass"/>  
            </p>
            
            <p>     
                <input type="submit" id="btn" value="Login"/>
                <input type="reset" id="btn" value ="reset"/> 
            </p>
            <?php
                //ini_set('display_errors', true);
                //error_reporting(E_ALL); 
                include('connect.php');
                
                //var_dump(isset($_POST['user']));
                //var_dump(isset($_POST['pass']));

  
                    @$username = $_POST["user"];
                    
                    @$password = $_POST["pass"];

                    if(isset($username) && isset($password)){

                    $username = stripcslashes($username);  
                    $password = stripcslashes($password);  

                    //vyberanie z databazy ci uzivatel existuje
                    $sql = "select * from users where username = '$username' and passwords = '$password'";  
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
                    $succes = mysqli_num_rows($result);  

                
                    if($succes > 0){  
                        //echo "<h1> Prihlasenie uspesne</h1>";
                        mysqli_close($con);
                        header('Location: home.php');
                        exit;
                    }  
                    else{  
                        echo "<p> prihlasovanie zlyhalo zle prihlasove meno alebo heslo.</p>";  
                    }   
                }
            ?>
        </form>


        <a href="register_form.php">
            <button id="rgstr" >register</button>
         </a>  
    </div> 



</body>




</html>