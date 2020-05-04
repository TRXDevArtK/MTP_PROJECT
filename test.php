<?php session_start();
echo $_SESSION['abc'];
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>serialize demo</title>
  <style>
  body, select {
    font-size: 12px;
  }
  form {
    margin: 5px;
  }
  p {
    color: red;
    margin: 5px;
    font-size: 14px;
  }
  b {
    color: blue;
  }
  </style>
  <script src="scripts/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css" />  
    <script src="scripts/bootstrap.js"></script>  
</head>
<body>
    
<form method="post" id="abc">
    Name: <input type="hidden" name="name" value="jahsgdjwd" readonly><br>
    E-mail: <input type="text" name="email" hidden><br>
    <select id="cars" name="select">
        <option value="volvo">Volvo</option>
        <option value="saab">Saab</option>
        <option value="mercedes">Mercedes</option>
        <option value="audi">Audi</option>
    </select>
    <input type="button" id="cde">
</form>
    
<tbody></tbody>
 
<p><tt id="results"></tt></p>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>
 
<script>
  //function showValues() {
      $('#cde').on('click', function(event){
          $.ajax({
            url:"test2.php",
            method:"POST",
            /* Masukkan data yang diperlukan untuk di loaddatanya di loaddata.php*/
            data:{
              'aa':"refaldi"
            },
            success: function(data) {
                alert("operasi sukses");
            }
        });
      })
  //}
  
  //showValues();
</script>
 
</body>
</html>