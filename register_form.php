<!DOCTYPE html>
<html>
    <head>
        <style type="text/css"> 
            .error {color : #FF0000;}
        </style>
    </head>
    <body>

        <?php
            //$con = mysqli_connect("localhost", "root", "xxx", "php_info");     
        
        
        
        ?>

        <form action="" method="POST"> 
            <fieldset>
                <legend>Osobné údaje</legend>
                Meno: <input type="text" name="firstname" placeholder="meno" required /><br /> 
                Priezvisko: <input type="text" name="lastname" placeholder="priezvisko" required /><br />
                <input type="radio" name="gender" value="M" />žena<br />
                <input type="radio" name="gender" value="F" />muž<br /><br />
                Dátum narodenia: <input type="date" name="birth_date" placeholder="mm/dd/yyyy" required>
                <!--Datum narodenia: <input type="text" name="birth_date" placeholder="mm/dd/yyyy" required />-->
            </fieldset> 

            <fieldset>
                <legend>Adresa</legend>
                Ulica <input type="text" name="street" placeholder="ulica" required /><br />
                Číslo <input type="number" name="number_house" placeholder="číslo domu" required /><br />
                Mesto <input type="text" name="city" placeholder="mesto" required /><br />
            </fieldset>

            <fieldset>
                <legend>Prihlasovacie meno</legend>
                Prihlasovacie meno <input type="text" name="username" placeholder="Prihlasovacie meno" required /><br />
                Heslo <input type="password" name="password" placeholder="heslo" required /><br />
            </fieldset>

            <fieldset>
                <legend>Údaje o štúdiu</legend>
                prvý <input type="radio" name="study_year" value="prvy" required/>
                druhý <input type="radio" name="study_year" value="druhy" />
                tretí <input type="radio" name="study_year" value="treti" />
                <br />

                <!--<label for="group">Ukoncene predmety</label>
                <select name="subject" required multiple>
                    <optgroup label="Matematika">
                    <option value="matematika">matematika</option>
                    <option value="matematicka_analyza">matematicka analyza</option>
                    </optgroup>

                    <optgroup label="Informatika">
                    <option value="programovanie">programovanie</option>
                    <option value="int_tech">Internetove technologie</option>
                    </optgroup>
                </select>-->
            </fieldset>
            <br /><input type="submit" value="Submit" /><input type="reset" /><br />
        </form>
        <?php
    

            include('connect.php');          
        
            //premenne pre form request je pouzite pretoze mam v jednom subore vypis z formularu
            // ked chceme len do DB mozme pouzit aj POST
            $firstname = $_REQUEST["firstname"] ?? NULL;
            $lastname = $_REQUEST["lastname"] ?? NULL;
            $gender = $_REQUEST["gender"] ?? NULL;
            $birth_date = $_REQUEST["birth_date"] ?? NULL;
            $street = $_REQUEST["street"] ?? NULL;
            $number_house = $_REQUEST["number_house"] ?? NULL;
            $city = $_REQUEST["city"] ?? NULL;
            $username = $_REQUEST["username"] ?? NULL;
            $password = $_REQUEST["password"] ?? NULL;
            $study_year = $_REQUEST["study_year"] ?? NULL;

            //fix pre undefined array key
            if(isset($firstname) && isset($lastname) && isset($gender) && isset($birth_date) &&isset($street)
            && isset($number_house) && isset($city) && isset($username)&& isset($password) &&
            isset($study_year)) {

                    // fix pre ukladanie datumu narodenia do db
                    $date=date("Y-m-d H:i:s",strtotime($birth_date));

                    
                    //osetrenie pre uzivatela ktory eexistuje
                    $select = mysqli_query($con, "SELECT * FROM users WHERE username = '".$_REQUEST['username']."'");
                    if(mysqli_num_rows($select)) {
                        exit('Tento uzivatel uz existuje!');
                    }
                    
                    //query ktore vkladame do db
                    $sql = "INSERT INTO users ( firstname, lastname, gender, birth, 
                                                street, number_house, city, username, passwords, study_year)
                                                VALUES ('$firstname', '$lastname', '$gender', '$date', '$street',
                                                '$number_house', '$city', '$username', '$password', '$study_year')";
                    $sql_query = mysqli_query($con, $sql);
                    echo "vypis udajov z formularu <br>";
                    echo "  Krstné meno: $firstname <br>
                            Priezvisko: $lastname <br>
                            Pohlavie: $gender <br>
                            Dátum narodenia: $birth_date <br>
                            Ulica: $street <br>
                            Číslo domu: $number_house <br>
                            Mesto: $city <br>
                            prihlasovacie meno: $username <br>
                            heslo: $password <br>
                            ročník: $study_year <br>
                            
                            ";    
                }
            mysqli_close($con);

?>
        <form method="get" action="index.php">
            <button type="submit">login_page</button>
        </form>




    </body>
</html>
