<?php
$name = $_COOKIE["name"];
?>

<!DOCTYPE HTML>
<html>
	<body class="is-preload">
		<div id="page-wrapper">

            <?php
			include("header.php");
			?>
                <section id="main" class="container">
					<header>
						<h2 style="color: black;">All Accounts</h2>
					</header>
       <table class="fl-table">
           <thead>
           <tr>
               <th>Sr.No.</th>
               <th>Name</th>
               <th>Email</th>
               <th>Number</th>
               <th>Balance</th>
           </tr>
           </thead>
           <tbody>
           
               <?php
               include 'config.php';
               $sql = "select * from users where name = '$name'";
               $result = $db->query($sql);
               if($result->num_rows > 0)
               {
                $row = $result->fetch_assoc();
                $user_id = $row["id"];
                $bal = $row["balance"];
                    echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["email"]."</td>";
                    echo "<td>".$row["mobile"]."</td>";
                    echo "<td>".$row["balance"]."</td>";
                    echo "</tr>";
                }
               ?>
               
           <tbody>
       </table>
       <form method="post" action="">
       
       <label>Choose name of person to transfer the money : </label>
                        <select name="to" id="to" required>
                            <option disabled selected> Select</option>
                        
                        <?php
                        include 'config.php';
                        $query2="SELECT name FROM users";
                        $result2 = $db->query($query2);
                                    if($result2->num_rows >0)
                                    {
                                        while($row = $result2->fetch_assoc())
                                        {
                                            echo "<option value='".$row["name"]."'>".$row["name"]."</option>";                    
                                        }
                                    }
                        
                        ?>
                        </select>
                        <br>
                        <label>Enter Amount : </label>
                        <input type="text" name="amnt" id="amnt" required>
                        <br>
                        <button name = "submit" type="submit">Submit</button>

        </form>


				</section>

			<!-- Footer -->
		<?php
        include("footer.php");
        ?>
	</body>
</html>
<?php
if(isset($_POST["submit"]))
{
    include 'config.php';
    $to_name = $_POST["to"];
    $amount = $_POST["amnt"];
            if($bal<$amount)
            {
                echo "<script>alert('Insufficient balance..!');</script>";
            }
            else
            {
                $bal = $bal - $amount;
                $sql1 = "update users set balance = '$bal' where id = '$user_id'";
                if($db->query($sql1) === TRUE)
                {
                    $sql2 = "select * from users where name = '$to_name'";
                    $result2 = $db->query($sql2);
                    if($result2->num_rows >0)
                    {
                        $row = $result2->fetch_assoc();
                        $user_id = $row["id"];
                        $bal = $row["balance"] + $amount;
                        $sql1 = "update users set balance = '$bal' where id = '$user_id'";
                        if($db->query($sql1) === TRUE)
                        {
                            $dt = date("Y-m-d");
                            $sqli = "insert into transactions(sender,reciever,amout,datetime) values ('$name','$to_name','$amount','$dt')";
                            if($db->query($sqli) === TRUE)
                            {
                                echo "<script>alert('Transfer Successful...!');</script>"; 
                                echo "<script>window.location.href = 'history.php';</script>";
                            }
                        }       
                    }
                }
            }                    
           
}
?>
