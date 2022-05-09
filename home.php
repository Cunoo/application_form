<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <form action="#" method="post"> 
    <?php
    //ukazatel errorov
    //ini_set('display_errors', true);
    //error_reporting(E_ALL);
        include('connect.php');
            //selectovanie z databaze
        $query = "SELECT id,firstname, lastname, gender, birth, street, number_house, city,
                        username, passwords, study_year FROM users";
        $result = mysqli_query($con, $query);
        ?>

        <table cellspacing="0" cellpadding="10">
            <tr>
                <th>#</th>
                <th>id</th>
                <th>Meno</th>
                <th>Priezvisko</th>
                <th>Pohlavie</th>
                <th>Dátum narodenia</th>
                <th>ulica</th>
                <th>Číslo domu</th>
                <th>Mesto </th>
                <th>prihlasovacie meno </th>
                <th>heslo </th>
                <th>Ročník </th>
                <th>upraviť</th>
            </tr>
            <?php
            //vypisanie tabulky stlpcov
            if (mysqli_num_rows($result) > 0) {
                while($data = mysqli_fetch_assoc($result)) {
                $id_u = $data['id'];
            ?>
            
            <tr>
                
                <td><input type="checkbox" name="delete[]" value="<?php echo $id_u; ?>"></td>                
                <td><?php echo $data['id']; ?> </td>
                <td><?php echo $data['firstname']; ?> </td>
                <td><?php echo $data['lastname']; ?> </td>
                <td><?php echo $data['gender']; ?> </td>
                <td><?php echo $data['birth']; ?> </td>
                <td><?php echo $data['street']; ?> </td>
                <td><?php echo $data['number_house']; ?> </td>
                <td><?php echo $data['city']; ?> </td>
                <td><?php echo $data['username']; ?> </td>
                <td><?php echo $data['passwords']; ?> </td>
                <td><?php echo $data['study_year']; ?> </td>
                <td><a href='modyfing.php?id=<?php echo $id_u; ?>'type="button" name="modify[]" style="text-decoration: none;"><?php echo $id_u;?></td>
                <tr>
            <?php
            }
            } else { ?>
                <tr>
                <td colspan="8">Ziadne data sa nenasli !</td>
                </tr>
            <?php } ?>
            <!-- s obrazkovy buttonom mazeme uzivatelov z databazy-->
            <input type="image" src="/images/trash.png" value="Delete" name="but_delete" class="center"> 
            <?php
            
               if(isset($_POST['but_delete'])){
                   //fix pre undefined array key
                    $del_test = $_REQUEST['delete'] ?? NULL;
                    
                    if(isset($del_test)){
                        foreach($_POST['delete'] as $deleteid){
                            //vymaze uzivatela
                            $del_query = "DELETE FROM users WHERE id='$deleteid' ";
                            //echo $del_query;
                            mysqli_query($con, $del_query);
                            header("Location: home.php");
                        }
                    }
                }


                /////////UPDATE////////////

                if(isset($_POST['modify'])){
                    header('Location: modyfing.php');


                }
                

                ?>
        </form>
        </table> 

        <div>
            
            <form action="#" method="post">
            Vyhladanie uzivatelov<input type="text" name="search" placeholder="meno,mesto,priezvisko">
            <input type="image" src="images/magni_glass.jpg" value="Submit" style="width: 3%;"/>

            <?php
            /////?SEARCHING///////
            //hladanie uzivatela
                $search = $_POST['search'] ?? NULL;
                if(isset($search)){
                    $sql_find = "select * from users where firstname or city or lastname like '%$search%' ";
                    $result_find = mysqli_query($con,$sql_find);

                    if($result_find->num_rows > 0){
                        //foreach($result as $result){
                            ///vypis zhody
                        echo "<br><br><table>
                        <tr>
                            <th>id</th>
                            <th>Meno</th>
                            <th>Priezvisko</th>
                            <th>Pohlavie</th>
                            <th>Dátum narodenia</th>
                            <th>ulica</th>
                            <th>Číslo domu</th>
                            <th>Mesto </th>
                            <th>prihlasovacie meno </th>
                            <th>heslo </th>
                            <th>Ročník </th>
                        </tr>";
                        while($row = $result_find->fetch_assoc()){

                            //vypis jednotlych prvkov z databazy
                            echo "<tr>";
                            echo "<td>".$row["id"]."</td>". "<td>".$row["firstname"]."</td>". "<td>".$row["lastname"]."</td>". "<td>" .$row["gender"]."</td>"
                            ."<td>".$row["birth"]."</td> <td>".$row["street"]."</td><td>".$row["number_house"]."</td><td>".$row["city"]
                            ."</td><td>".$row["username"]."</td><td>".$row["passwords"]."</td><td>".$row["study_year"]."</td>";
                            echo "</tr>";
                            
                        }//}
                        
                        echo "</table>";
                    }
            }
            ?>
            </form>
        </div>
    <body>
</html>