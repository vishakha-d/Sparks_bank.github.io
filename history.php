<!DOCTYPE HTML>
<html>
	<body class="is-preload">
		<div id="page-wrapper">

            <?php
			include("header.php");
			?>
                <section id="main" class="container">
					<header>
						<h2 style="color: black;">Transaction Hisory</h2>
					</header>
				  
                    <form method="post" action="transaction_user.php">
       <table class="fl-table">
           <thead>
           <tr>
               <th>Sr.No.</th>
               <th>Sender</th>
               <th>Reciever</th>
               <th>Amount</th>
               <th>Date</th>
           </tr>
           </thead>
           <tbody>
           
               <?php
               include 'config.php';
               $sql = "select * from transactions";
               $result = $db->query($sql);
               if($result->num_rows > 0)
               {
                while($row = $result->fetch_assoc())
                {
                    echo "<tr>";
                    echo "<td>".$row["tid"]."</td>";
                    echo "<td>".$row["sender"]."</td>";
                    echo "<td>".$row["reciever"]."</td>";
                    echo "<td>".$row["amout"]."</td>";
                    echo "<td>".$row["datetime"]."</td>";
                     echo "</tr>";
                }
               }
               ?>
               
           <tbody>
       </table>
            </form>
				</section>

			<!-- Footer -->
		<?php
        include("footer.php");
        ?>
	</body>
</html>