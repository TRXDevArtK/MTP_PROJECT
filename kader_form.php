<?php
    $test1 = $_POST['test1'];
?>

<html>
    <head>
        <!--Metadata-->
        <meta charset="UTF-8">
        <script src="js/jquery.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" /> 
        <link rel="stylesheet" href="css/loading.css" />  
        <script src="js/bootstrap.min.js"></script>  
        <title></title>
    </head>
    <body>
        <div class="container">  
            <div class="page-header text-center">
                <h3>Input Profil Kader</h3>      
            </div>
            
            <form action="kader_form.php" method="post">
                <div class="row">
                    
                    <div class="col-xs-6 form-group">
                        <label>NIM</label>
                        <input type="number" class="form-control" name="nim" placeholder="e.g : 1700018012" 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan NIM Kader')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>
                    
                    <div class="col-xs-6 form-group">
                        <label>Nama</label>
                        <input class="form-control" name='nama' type="text"/>
                    </div>
                    
                    <div class="col-xs-6 form-group">
                        <label>Fakultas</label>
                        <input class="form-control" name='fakultas' type="text"/>
                    </div>
                    
                    <div class="col-xs-6 form-group">
                        <label>Perguruan Tinggi</label>
                        <input class="form-control" name='universitas' type="text"/>
                    </div>
                    
                    <div class="col-xs-6 form-group">
                        <label>Jenis Kelamin</label>
                        <input class="form-control" name='jk' type="text"/>
                    </div>
                    
                    <div class="col-xs-6 form-group">
                        <label>Prodi</label>
                        <input class="form-control" name='Prodi' type="text"/>
                    </div>
                    
                    <div class="col-xs-6 form-group">
                        <label>Periode</label>
                        <input class="form-control" name='Periode' type="text"/>
                    </div>
                    
                </div>
                
                <br>
                <input type="submit" name="submit" class="btn btn-primary center-block" value="Tambahkan / Submit">
            </form>
        </div>
    </body>
</html>

