<!DOCTYPE html>
<html>
    <body>

            <form action='' method='post'>

            <?php
                include("connect.php");
                $s_id = $_GET['id'];
                $query = "SELECT * FROM users WHERE id='$s_id'";
                $result = mysqli_query($con, $query);

                if ($result->num_rows > 0){
                    //ziskanie dat z db
                    $row = $result->fetch_assoc();
                                $ids = $row["id"];
                                $firstname = $row["firstname"];
                                $lastname = $row["lastname"];
                                $gender = $row["gender"];
                                //$birth_date = $row["birth"];
                                $street = $row["street"];
                                $number_house = $row["number_house"];
                                $city = $row["city"];
                                $username = $row["username"];
                                $password = $row["passwords"];
                                $study_year = $row["study_year"];
                        
            ?>

                <input type hidden name="user_id" value="<?php echo $ids ?>">
                Meno:<input type='text' name='firstname_m' placeholder='<?php echo $firstname; ?>'><br>
                Priezvisko: <input type='text' name='lastname_m' placeholder='<?php echo $lastname;?>'><br>
                Pohlavie: <input type='text' name='gender_m' placeholder='<?php echo $gender;?>'><br>

                <!--datum narodenia: <input type='date' name='birth_m' placeholder='$birth_date'><br>-->
                Ilica: <input type='text' name='street_m' placeholder='<?php echo $street; ?>'><br>
                Číslo domu: <input type='number' name='number_house_m' placeholder='<?php echo $number_house; ?>'><br>
                Mesto: <input type='text' name='city_m' placeholder='<?php echo $city; ?>'><br>
                Heslo: <input type='text' name='passwords_m' placeholder='<?php echo $password;?>'><br>
                <fieldset>
                    <legend>Udaje o studiu</legend>
                    prvý <input type="radio" name="study_year_m" value="prvy"/>
                    druhý <input type="radio" name="study_year_m" value="druhy" />
                    tretí <input type="radio" name="study_year_m" value="treti" />
                    <br />
                </fieldset>

                <input type ='submit' value='Submit'>
            </form>
            <?php
                //fix ak je kolonka prazdna pri modifikacii tak nenastav na NULL ale ponechaj
                // zavinace pouzivam preto aby nam nepisalo undefined array key
                @$e_id = $_POST['user_id'];
                if(empty(@$e_firstname = $_POST["firstname_m"])){
                    $e_firstname = $row['firstname'];
                } if(empty(@$e_lastname = $_POST["lastname_m"])){
                    $e_lastname = $row["lastname"];
                } if (empty(@$e_gender = $_POST["gender_m"])){
                    $e_gender = $row["gender"];
                } if (empty(@$e_street = $_POST["street_m"])){
                    $e_street = $row['street'];
                } if(empty(@$e_number_house = $_POST["number_house_m"])){
                    $e_number_house = $row["number_house"];
                } if(empty(@$e_city = $_POST["city_m"])){
                    $e_city = $row["city"];
                } if(empty(@$e_password = $_POST["passwords_m"])){
                    $e_password = $row["passwords"];
                } if(empty(@$e_study_year = $_POST["study_year_m"])){
                    $e_study_year = $row["study_year"];
                }

                
                //update userov v tabulke 
                $sql = "UPDATE users SET firstname='$e_firstname', lastname='$e_lastname', gender='$e_gender',
                                                street='$e_street', number_house='$e_number_house', city='$e_city',
                                                passwords='$e_password', study_year='$e_study_year' WHERE id='$e_id';";

                //var_dump($sql);
                                               // die;
                
                if(mysqli_query($con,$sql) === True){
                    mysqli_close(($con));
                }
                //keby sme chceli hned zaavret databazu
                //mysqli_close($con);

        }

        ?>
        <form method="" action="home.php">
            <button type="submit">tabulka</button>
        </form>

</body>
</html>