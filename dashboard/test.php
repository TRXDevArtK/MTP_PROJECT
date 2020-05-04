<?php

session_start();
include('database.php'); 

if (isset($_GET["page"])) { 
    echo "INI GETNYA";
} 
else
{ 
    echo "GETNYA KOK GAK ADA";
}  

$limit = 1;
$sql = "SELECT COUNT(*) FROM nilaimtk";  
$rs_result = mysqli_query($conn2, $sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit); 

echo "total pages = ",$total_pages," |-------| ";
echo "total_records = "; print_r($row); echo"|------|";
echo "limit = ",$limit;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PHP Pagination AJAX</title>
<script src="../scripts/jquery-3.4.1.js"></script>
        <link rel="stylesheet" href="../css/bootstrap337.min.css" />  
        <script src="../scripts/bootstrap.js"></script>  
<head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Employees</b>Add New Employee</span></a>
                        <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons"></i> <span>Delete</span></a>						
                    </div>
                </div>
            </div>
            <div id="target-content">loading...</div>

            
               
            <ul class="pagination">
            <?php 
            if(!empty($total_pages)){ ?>
                
                <li id="back_page">
                    <a href="#" data-id="" class="page-link" id="bp"> < </a>
                </li>
                <?php
                for($i=1; $i<=$total_pages; $i++){ ?>
                    
                    <?php
                    if($i == 1)
                    {
                    ?>
                        <li class="pageitem active" id="<?php echo $i;?>">
                            <a href="#page_no=<?php echo $i;?>" data-id="<?php echo $i;?>" class="page-link active" ><?php echo $i;?></a>
                        </li>
                    <?php 
                    }
                    else
                    {
                    ?>
                        <li class="pageitem" id="<?php echo $i;?>">
                            <a href="#page_no=<?php echo $i;?>" class="page-link active" data-id="<?php echo $i;?>"><?php echo $i;?></a>
                        </li>
                    <?php
                    }
                } ?>
                            
                <li class="next_page">
                    <a href="#" data-id="" class="page-link" id="bp2" > > </a>
                </li>
            <?php
            }
            ?>
            </ul>
  
            
        </div>
        </div>
	<script>
	$(document).ready(function() { 
            
            function call(){
		//$("#target-content").load("test2.php");
                var id = 1;
                $('#bp2').attr('data-id',2);
		$(".page-link").click(function(){
                    id = $(this).attr("data-id");
                    if(id >= <?=$total_pages?>)
                    {
                        id = <?=$total_pages?>;
                    }
                    else if(id <= 1){
                        id = 1;
                    }

                    var id_int = parseInt(id, 10);

                    var id_int_min = id_int - 1;
                    var id_int_plus = id_int + 1;

                    var id_string_min = id_int_min.toString();
                    var id_string_plus = id_int_plus.toString();
                    $('#bp').attr('data-id',id_string_min);
                    $('#bp2').attr('data-id',id_string_plus);

                    $.ajax({
                            url: "test2.php",
                            type: "POST",
                            data: {
                                    page : id
                            },
                            cache: false,
                            success: function(dataResult){
                                    $("#target-content").html(dataResult);
                                    $(".pageitem").removeClass("active");
                                    $("#"+id).addClass("active");
                                    //alert("id = "+id);

                            }
                    });
		});
            }
            
            call();
    });
</script>
</body>
</html>