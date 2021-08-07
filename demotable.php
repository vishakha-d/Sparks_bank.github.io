<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css"/>  

<style>
  
</style>
</head>
<body>


   <div class="table-wrapper">
       <form method="post" action="transaction_user.php">
       <table class="fl-table">
           <thead>
           <tr>
               <th>Sr.No.</th>
               <th>Name</th>
               <th>Email</th>
               <th>Number</th>
               <th>Balance</th>
               <th>Action</th>
           </tr>
           </thead>
           <tbody>
           
               <?php
               include 'config.php';
               $sql = "select * from users";
               $result = $db->query($sql);
               if($result->num_rows > 0)
               {
                while($row = $result->fetch_assoc())
                {
                    echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["email"]."</td>";
                    echo "<td>".$row["mobile"]."</td>";
                    echo "<td>".$row["balance"]."</td>";
                    echo "<td><input type='submit' id='".$row["name"]."' name='btn1' value='Transfer' onClick='GFG_click(this.id)'></td>";
                    echo "</tr>";
                }
               }
               ?>
               
           <tbody>
       </table>
            </form>
   </div>
   <script>
			function GFG_click(clicked){
				document.cookie = "name = "+clicked;
		        }
			</script>
</body>
</html>
