<!DOCTYPE HTML>
<html>
	<body class="is-preload">
		<div id="page-wrapper">

        <?php
			include("header.php");
			?>


			<!-- Main -->
				<section id="main" class="container">
					<header>
						<h2 style="color: black;">Transactions</h2>
						<p>Happy Banking.</p>
					</header>
					<div class="box">
					<form action="" method="post">
                    <ul>
                        <li>
                        <label>Enter your name : </label>
                        <input type="text" name="name" id="name" required>
                        </li>
                        <li>
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
                        </li>
                        <li>
                        <label>Enter Amount : </label>
                        <input type="text" name="amnt" id="amnt" required>
                        </li>
                </ul>    
                <button name = "submit" type="submit">Submit</button>
                    </form>
                    
                
					</div>
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
    $name = strtolower($_POST["name"]);
    $to_name = $_POST["to"];
    $amount = $_POST["amnt"];
    
    $sql = "select * from users where name = '$name'";
    $result = $db->query($sql);
    if($result->num_rows >0)
    {
        $row = $result->fetch_assoc();
        $user_id = $row["id"];
        $bal = $row["balance"];
            if($bal<$amount)
            {
                echo "<script>alert('Insufficient balance..!');</script>";
            }
            else
            {
                $bal = $row["balance"] - $amount;
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
    else{
        echo "<script>alert('".$name." not found...!');</script>"; 
    }
                          
}
?>