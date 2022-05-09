<?php

//prihlasovanie do databazy
            $server_name = "localhost";
            $username_db = "root";
            $password_db = "Mimilumka123";
            $db_name = "php_info";
            $con = mysqli_connect($server_name, $username_db, $password_db, $db_name);
            //if we are connected to db
            if($con->connect_error){
                die("Connection failed". $con->connect_error);
            }

            ?>
