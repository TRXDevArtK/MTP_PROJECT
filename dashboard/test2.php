<?php
session_start();
include('database.php');
$limit = 1;  
if (isset($_POST["page"])) { 
    $page  = $_POST["page"]; 
} 
else
{ 
    $page=1; 
}  

$_SESSION['page_no'] = $page;
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT * FROM nilaimtk ORDER BY nim ASC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn2, $sql);  
?>
<table class="table table-bordered table-striped">  
<thead>  
<tr>  
<th>Name</th>  
<th>Email</th>  
</tr>  
</thead>  
<tbody>  
<?php  
while ($row = mysqli_fetch_array($rs_result)) {  
?>  
            <tr>  
            <td><?php echo $row["nim"]; ?></td>  
            <td><?php echo $row["1122334"]; ?></td>  
            </tr>  
<?php  
};  
?>  
</tbody>  
</table>  