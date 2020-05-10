<?php
    session_start();
    include('database.php');
    
    if(isset($_SESSION['nim'])){
        $nim = $_SESSION['nim'];
        unset($_SESSION['nim']);
    }
    else if(isset($_POST['nim'])){
        $nim = $_POST['nim'];
    }
    else{
        header('Location:peserta.php');
    }
    
    $query = "SELECT *FROM `peserta` where `peserta`.`nim` = $nim";
    $sql_run = mysqli_query($conn2, $query);
    $row = mysqli_fetch_assoc($sql_run);
    
    $nim = $row['nim'];
    $namafull = $row['namafull'];
    $namapanggil = $row['namapanggil'];
    $notelp = $row['notelp'];
    $tempat = $row['tempat'];
    $tanggal = $row['tanggal'];
    $jk = $row['jk'];
    
    if($jk == "P"){
        $jk = "Perempuan";
    }
    else if($jk == "L"){
        $jk = "Laki-laki";
    }
    
    $fakultas = $row['fakultas'];
    $universitas = $row['universitas'];
    $alamat = $row['alamat'];
    
    
?>

<html>
    <head>
         <!--Metadata-->
        <meta charset="UTF-8">
        <script src="../scripts/jquery-3.4.1.js"></script>
        <link rel="stylesheet" href="../css/bootstrap337.min.css" />  
        <script src="../scripts/bootstrap.js"></script>  
        <title></title>
    </head>
    <body>
        <div class="container">
            <div class="page-header text-center">
                <h3>Data Peserta</h3>      
            </div>
            <form action="peserta_edit.php" method="post">
                
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <input type="submit" name="edit" class="btn btn-primary" value="Edit Data Peserta"><br>
                            <br>
                            <a class="list-group-item">Nama : <?php echo $namafull ?></a><input type="hidden" name="namafull" value="<?php echo $namafull ?>" readonly>
                            <a class="list-group-item">NIM : <?php echo $nim ?></a><input type="hidden" name="nim" value="<?php echo $nim ?>" readonly>
                            <br>
                            <button data-toggle="collapse" href="#collapse1" type="button" class="btn btn-info">Data Lebih Lanjut + </button>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <a class="list-group-item">Nama Panggilan : <?php echo $namapanggil ?></a><input type="hidden" name="namapanggil" value="<?php echo $namapanggil ?>" readonly>
                        <a class="list-group-item">Nomor Telepon : <?php echo $notelp ?></a><input type="hidden" name="notelp" value="<?php echo $notelp ?>" readonly>
                        <a class="list-group-item">Tempat Lahir : <?php echo $tempat ?></a><input type="hidden" name="tempat" value="<?php echo $tempat ?>" readonly>
                        <a class="list-group-item">Tanggal Lahir : <?php echo $tanggal ?></a><input type="hidden" name="tanggal" value="<?php echo $tanggal ?>" readonly>
                        <a class="list-group-item">Jenis Kelamin : <?php echo $jk ?></a><input type="hidden" name="jk" value="<?php echo $jk ?>" readonly>
                        <a class="list-group-item">Fakultas : <?php echo $fakultas ?></a><input type="hidden" name="fakultas" value="<?php echo $fakultas ?>" readonly>
                        <a class="list-group-item">Universitas : <?php echo $universitas ?></a><input type="hidden" name="universitas" value="<?php echo $universitas ?>" readonly>
                        <a class="list-group-item">Alamat : <?php echo $alamat ?></a><input type="hidden" name="alamat" value="<?php echo $alamat ?>" readonly>
                    </div>
                </div>
            </div>
            </form>
            
            <hr style="color:black">
            <div class="page-header text-center">
                <h3>List Matkul dan Nilai</h3>      
            </div>
            <br />
            <form action="pes_mtk_add.php" method="post">
                <input type="hidden" name="nim" value="<?= $nim ?>"/>
                <input type="submit" name="add_mtk" id="add" class="btn btn-success" value="Tambah Mata Kuliah" />
            </form>
            <form method="post" id="form_data">
                <span style="display: inline;">
                    <input type="button" name="multiple_update" id="update" class="btn btn-primary" value="Update Data Yang Dipilih" />
                    <input type="button" name="multiple_delete" id="delete" class="btn btn-danger" value="Delete Data Yang Dipilih" />
                </span>
                <br><br/>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th width="5%">Pilih</th>
                            <th width="5%">No</th>
                            <th width="10%">Nama Matkul</th>
                            <th width="10%">Tanggal Nilai</th>
                            <th width="5%">Nilai</th>
                            <th width="10%">Deskripsi Nilai</th>
                        </thead>
                        <tbody id="tbody"></tbody>
                    </table>
                </div>
            </form>
	</div>
    </body>
</html>

<script>
$(document).ready(function(){
    
    //AMBIL DATA NILAI MATA KULIAH DARI DATABASE (loaddata.php)
    function fetch_data_perpeserta()
    {
        //REFRESH PAGE
        var calc_nilai = 0;
        var calc_sks = 0;
        $.ajax({
            url:"peserta_data_opr.php",
            method:"POST",
            data:{
                'nim':'<?=$nim?>',
                'key':'load'
            },
            dataType:"json",
            error: function (xhr, status) {
                //set tidak ada isi jika error ATAU DATA = 0 (NULL) atau data tidak terbaca
                var html = '';
                $('tbody').html(html);
            },
            success:function(data)
            {
                var html = '';
                var count = 0;
                var desc_nilai = '';
                var nilai = 0;
                for(count; count < data.length; count++){
                    
                    if(data[count].nilai == 'A'){
                        desc_nilai = data[count].A;
                        nilai = 4;
                    }
                    else if(data[count].nilai == 'B'){
                        desc_nilai = data[count].B;
                        nilai = 3;
                    }
                    else if(data[count].nilai == 'C'){
                        desc_nilai = data[count].C;
                        nilai = 2;
                    }
                    else if(data[count].nilai == 'D'){
                        desc_nilai = data[count].D;
                        nilai = 1;
                    }
                    else if(data[count].nilai == ''){
                        desc_nilai = '';
                        nilai = 0;
                    }
                    
                    html += '<tr>';
                    html += '<td><input type="checkbox" no="'+(count+1)+'" nama="'+data[count].nama+'" \n\
                            tanggal_nilai="'+data[count].tanggal_nilai+'" nilai="'+data[count].nilai+'" desc_nilai="'+desc_nilai+'"\n\
                            id="'+data[count].id+'"class="check_box"  /></td>';
                    html += '<td>'+(count+1)+'</td>';
                    html += '<td>'+data[count].nama+'</td>';
                    html += '<td>'+data[count].tanggal_nilai+'</td>';
                    html += '<td>'+data[count].nilai+'</td>';
                    html += '<td>'+desc_nilai+'</td>';
                    html += '</tr>';
                    
                    calc_nilai += nilai;
                    
                    //alert(data[count].A + data[count].B + data[count].C + data[count].D);
                    //console.log(data[count].id);
                    
                }
                
                nilai_akhir = calc_nilai / count;
                nilai_huruf = '';
                
                if((nilai_akhir > 3) && (nilai_akhir <= 4)){
                    nilai_huruf = '(A)';
                }
                else if(nilai_akhir > 2 && nilai_akhir <= 3){
                    nilai_huruf = '(B)';
                }
                else if(nilai_akhir > 1 && nilai_akhir <= 2){
                    nilai_huruf = '(C)';
                }
                else if(nilai_akhir > 0 && nilai_akhir <= 1){
                    nilai_huruf = '(D)';
                }
                else if(nilai_akhir == 0){
                    nilai_huruf = 'NOL (KOSONG)';
                }
                
                html += '<tr>';
                html += '<td colspan="4" class="text-right">Total Keseluruhan Nilai : </td>';
                html += '<td colspan="2">'+nilai_akhir+' '+nilai_huruf+'</td>';
                html += '</tr>';
                
                //Masukkan koda tadi ke <tbody> yang ada di html
                $('#tbody').html(html);
                
            }
        });
    }
    
    fetch_data_perpeserta();
    
    $(document).on('click', '.check_box', function(){
        var html = '';
        if(this.checked)
        {
            html = '<td><input type="checkbox" no="'+$(this).attr('no')+'" nama="'+$(this).attr('nama')+'" tanggal_nilai="'+$(this).attr('tanggal_nilai')+'"\n\
                    nilai="'+$(this).attr('nilai')+'" desc_nilai="'+$(this).attr('desc_nilai')+'" id="'+$(this).attr('id')+'" class="check_box" checked /></td>';
            html += '<input type="hidden" name="id[]" class="form-control" value="'+$(this).attr("id")+'" readonly/>';
            html += '<td>'+$(this).attr("no")+'</td>';
            html += '<td>'+$(this).attr("nama")+'</td>';
            html += '<td>'+$(this).attr("tanggal_nilai")+'</td>';
            html += '<td><select name="nilai[]" class="form-control" id="options'+$(this).attr('no')+'">\n\
                    <option value="A">A</option>\n\
                    <option value="B">B</option>\n\
                    <option value="C">C</option>\n\
                    <option value="D">D</option>\n\
                    <option value="">KOSONGKAN</option>\n\</select></td>';
        }
        else
        {
            html = '<td><input type="checkbox" no="'+$(this).attr('no')+'" nama="'+$(this).attr('nama')+'" tanggal_nilai="'+$(this).attr('tanggal_nilai')+'"\n\
                    nilai="'+$(this).attr('nilai')+'" desc_nilai="'+$(this).attr('desc_nilai')+'" id="'+$(this).attr('id')+'" class="check_box" /></td>';
            html += '<td>'+$(this).attr("no")+'</td>';
            html += '<td>'+$(this).attr("nama")+'</td>';
            html += '<td>'+$(this).attr("tanggal_nilai")+'</td>';
            html += '<td>'+$(this).attr("nilai")+'</td>';
            html += '<td>'+$(this).attr("desc_nilai")+'</td>';
        }
        
        $(this).closest('tr').html(html);
        
        //SET option sesuai dengan database awal
        $("#options"+$(this).attr('no')).val($(this).attr('nilai'));
    });
    
    //UPDATE
    $('#update').on('click', function(event){
        event.preventDefault();
        
        //gunakan fungsi serializearray untuk auto add dengan push
        var serialize = $("#form_data").serializeArray();
        serialize.push({name: 'nim', value: '<?=$nim?>'});
        serialize.push({name: 'key', value: 'update'});
        
        if($('.check_box:checked').length > 0)
        {
            $.ajax({
                url:"peserta_data_opr.php",
                method:"POST",
                data:$.param(serialize),
                success:function(data)
                {
                    fetch_data_perpeserta();
                }
             })
        }
    });
    
    //DELETE
    $('#delete').on('click', function(event){
        event.preventDefault();
        
        //gunakan fungsi serializearray untuk auto add dengan push
        var serialize = $("#form_data").serializeArray();
        serialize.push({name: 'nim', value: '<?=$nim?>'});
        serialize.push({name: 'key', value: 'delete'});
        
        if($('.check_box:checked').length > 0)
        {
            $.ajax({
                url:"peserta_data_opr.php",
                method:"POST",
                data:$.param(serialize),
                success:function(data)
                {
                    fetch_data_perpeserta();
                }
             })
        }
    });
    
})
</script>