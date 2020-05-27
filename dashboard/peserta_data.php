<?php
    ob_start();
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
        exit();
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
    $fakultas = $row['fakultas'];
    $universitas = $row['universitas'];
    $alamat = $row['alamat'];
    $nama_ayah = $row['nama_ayah'];
    $nama_ibu = $row['nama_ibu'];
    $kerja_ayah = $row['kerja_ayah'];
    $kerja_ibu = $row['kerja_ibu'];
    $essai = $row['essai'];
    $periode = $row['periode'];
    
    if($jk == "P"){
        $jk = "Perempuan";
    }
    else if($jk == "L"){
        $jk = "Laki-laki";
    }
    
?>

<html>
    <head>
        <!--Metadata-->
        <meta charset="UTF-8">
        <script src="../js/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />  
        <link rel="stylesheet" href="../css/loading.css" />  
        <script src="../js/bootstrap.min.js"></script>  
        <title></title>
    </head>
    <body>
        <?php include("nav.html"); ?>
        
        <div class="container">
            <div class="page-header text-center">
                <h3>Data Peserta</h3>      
            </div>
            
            <!-- Modal -->
            <div id="presensi_modal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center">Data Presensi</h4>
                    </div>
                    <div class="modal-body">
                        <form id="presensi">
                            <div class="form-group">
                                <label>Sakit :</label>
                                <input type="number" class="form-control" name="sakit" id="sakit_in" placeholder="Contoh : 1" value="">
                            </div>
                            
                            <div class="form-group">
                                <label>Izin :</label>
                                <input type="number" class="form-control" name="izin" id="izin_in" placeholder="Contoh : 2" value="">
                            </div>
                            
                            <div class="form-group">
                                <label>Tanpa Keterangan :</label>
                                <input type="number" class="form-control" name="tanpa_ket" id="tanpa_ket_in" placeholder="Contoh : 3" value="">
                            </div>
                            
                            <input type="button" name="presensi_edit" id="presensi_edit"class="btn btn-primary center-block" value="Update / Submit">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

              </div>
            </div>
            
            <!-- Modal -->
            <div id="catatan_modal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center">Data Presensi</h4>
                    </div>
                    <div class="modal-body">
                        <form id="catatan">
                            <div class="form-group">
                                <label>Catatan Peserta</label>
                                <textarea type="text" class="form-control" name="catatan" id="catatan_in" ></textarea>
                            </div>
                            
                            <input type="button" name="catatan_edit" id="catatan_edit"class="btn btn-primary center-block" value="Update / Submit">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

              </div>
            </div>
            
            <form action="peserta_edit.php" method="post">
                
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <input type="submit" name="edit" class="btn btn-primary pull-left" style="margin-right:10px;"value="Edit Data">
                            <input type="button" data-toggle="modal" data-target="#presensi_modal" id="edit_presensi" name="edit_presensi" class="btn btn-primary pull-left" style="margin-right:10px;" value="Edit Data Presensi">
                            <input type="button" data-toggle="modal" data-target="#catatan_modal" id="edit_catatan" name="edit_catatan" class="btn btn-primary pull-left" value="Edit Data Catatan">
                            <br><br><br>
                            <a class="list-group-item">Nama : <?php echo $namafull ?></a><input type="hidden" name="namafull" value="<?php echo $namafull ?>" readonly>
                            <a class="list-group-item">NIM : <?php echo $nim ?></a><input type="hidden" name="nim" value="<?php echo $nim ?>" readonly>
                            <a class="list-group-item">Judul Essai : <?php echo $essai ?></a><input type="hidden" name="essai" value="<?php echo $essai ?>" readonly>
                            <a class="list-group-item">Periode : <?php echo $periode ?></a><input type="hidden" name="periode" value="<?php echo $periode ?>" readonly>
                            <br>
                            <button data-toggle="collapse" href="#collapse1" type="button" class="btn btn-info">Data Peserta + </button>
                            <button data-toggle="collapse" href="#collapse2" type="button" class="btn btn-info">Data Orang Tua + </button>
                            <button data-toggle="collapse" href="#collapse3" type="button" class="btn btn-info">Data Presensi + </button>
                            <button data-toggle="collapse" href="#collapse4" type="button" class="btn btn-info">Data Catatan + </button>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info text-center">Data Peserta Tambahan</li>
                            <li class="list-group-item">Nama Panggilan : <?php echo $namapanggil ?><input type="hidden" name="namapanggil" value="<?php echo $namapanggil ?>" readonly>
                            <li class="list-group-item">Nomor Telepon : <?php echo $notelp ?><input type="hidden" name="notelp" value="<?php echo $notelp ?>" readonly>
                            <li class="list-group-item">Tempat Lahir : <?php echo $tempat ?><input type="hidden" name="tempat" value="<?php echo $tempat ?>" readonly>
                            <li class="list-group-item">Tanggal Lahir : <?php echo $tanggal ?><input type="hidden" name="tanggal" value="<?php echo $tanggal ?>" readonly>
                            <li class="list-group-item">Jenis Kelamin : <?php echo $jk ?><input type="hidden" name="jk" value="<?php echo $jk ?>" readonly>
                            <li class="list-group-item">Fakultas : <?php echo $fakultas ?><input type="hidden" name="fakultas" value="<?php echo $fakultas ?>" readonly>
                            <li class="list-group-item">Universitas : <?php echo $universitas ?><input type="hidden" name="universitas" value="<?php echo $universitas ?>" readonly>
                            <li class="list-group-item">Alamat : <?php echo $alamat ?><input type="hidden" name="alamat" value="<?php echo $alamat ?>" readonly>
                        </ul>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info text-center">Data Orang Tua Peserta</li>
                            <li class="list-group-item">Nama Ayah : <?php echo $nama_ayah ?><input type="hidden" name="nama_ayah" value="<?php echo $nama_ayah ?>" readonly>
                            <li class="list-group-item">Nama Ibu : <?php echo $nama_ibu ?><input type="hidden" name="nama_ibu" value="<?php echo $nama_ibu ?>" readonly>
                            <li class="list-group-item">Kerja Ayah : <?php echo $kerja_ayah ?><input type="hidden" name="kerja_ayah" value="<?php echo $kerja_ayah ?>" readonly>
                            <li class="list-group-item">Kerja Ibu : <?php echo $kerja_ibu ?><input type="hidden" name="kerja_ibu" value="<?php echo $kerja_ibu ?>" readonly>
                        </ul>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                        <!-- Data ada di script -->
                        <ul class="list-group" id="presensi_out">
                        </ul>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                        <!-- Data ada di script -->
                        <ul class="list-group" id="catatan_out">
                        </ul>
                    </div>
                </div>
            </div>
            </form>
            
            <!-- Data nilai sikap peserta -->
            <hr style="color:black">
            <form action="pes_mtk_add.php" method="post">
                <input type="hidden" name="nim" value="<?= $nim ?>"/>
                <input type="hidden" name="mtk" value="skp"/>
                <input type="submit" name="add_mtk_skp" id="add_mtk_skp" hidden/>
            </form>
            <form method="post" id="form_data_2">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <li class="list-group-item text-center list-group-item-info"><h3 style="color:black">Nilai Matkul Sikap</h3>
                                <span style="display: inline;">
                                    <label for="add_mtk_skp" tabindex="0" class="btn btn-success">Tambah Mata Kuliah</label>
                                    <input type="button" name="multiple_update" id="update_skp" class="btn btn-primary" value="Update Data Yang Dipilih" />
                                    <input type="button" name="multiple_delete" id="delete_skp" class="btn btn-danger" value="Delete Data Yang Dipilih" />
                                </span>
                            </li>
                        </tr>
                        <thead>
                            <th width="1%">Pilih</th>
                            <th width="5%">No</th>
                            <th width="15%">Nama Matkul</th>
                            <th width="15%">Tanggal Nilai</th>
                            <th width="10%">Nilai</th>
                            <th width="30%">Deskripsi Nilai</th>
                        </thead>
                        <tbody id="tbody_skp"></tbody>
                    </table>
                </div>
            </form>
            
            <!-- Data nilai peserta -->
            <hr style="color:black">
            <form action="pes_mtk_add.php" method="post">
                <input type="hidden" name="nim" value="<?= $nim ?>"/>
                <input type="hidden" name="mtk" value="mtk"/>
                <input type="submit" name="add_mtk" id="add_mtk" hidden/>
            </form>
            <form method="post" id="form_data">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <li class="list-group-item text-center list-group-item-info"><h3 style="color:black">Nilai Matkul</h3>
                                <span style="display: inline;">
                                    <label for="add_mtk" tabindex="0" class="btn btn-success">Tambah Mata Kuliah</label>
                                    <input type="button" name="multiple_update" id="update" class="btn btn-primary" value="Update Data Yang Dipilih" />
                                    <input type="button" name="multiple_delete" id="delete" class="btn btn-danger" value="Delete Data Yang Dipilih" />
                                </span>
                            </li>
                        </tr>
                        <thead>
                            <th width="1%">Pilih</th>
                            <th width="5%">No</th>
                            <th width="15%">Nama Matkul</th>
                            <th width="15%">Tanggal Nilai</th>
                            <th width="10%">Nilai</th>
                            <th width="30%">Deskripsi Nilai</th>
                        </thead>
                        <tbody id="tbody"></tbody>
                    </table>
                </div>
            </form>
            
            <form method="post" id="download_xls" action="download_xls.php">
                <input type="hidden" name="nim" value="<?php echo $nim ?>" readonly>
                <input type="submit" id="btn_xls" hidden>
            </form>
            <form method="post" id="download_pdf" action="download_pdf.php">
                <input type="hidden" name="nim" value="<?php echo $nim ?>" readonly>
                <input type="submit" id="btn_pdf" hidden>
            </form>
            <form method="post" id="download_print" action="download_print.php" target="_blank">
                <input type="hidden" name="nim" value="<?php echo $nim ?>" readonly>
                <input type="submit" id="btn_print" hidden>
            </form>
            
            <div class="panel panel-primary" style="text-align: center">
                <div class="panel-body">
                    <h4> Download Laporan : </h4>
                    <label for="btn_xls" tabindex="0" class="btn btn-danger">XLS</label>
                    <label for="btn_pdf" tabindex="0" class="btn btn-danger">PDF</label>
                    <label for="btn_print" tabindex="0" class="btn btn-danger">PRINT</label>
                </div>
            </div>
	</div>
        
        <div class="ajaxload"><!-- ini loading ajax --></div>
    </body>
</html>

<script type="text/javascript"> //MATKUL SIKAP & ETC
$(document).ready(function(){
    
    $body = $("body");
    
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }    
    });
    
    //AMBIL DATA NILAI MATA KULIAH DARI DATABASE (loaddata.php)
    function fetch_data_sikap_perpeserta()
    {
        var calc_nilai = 0;
        var calc_sks = 0;
        $.ajax({
            url:"peserta_data_opr.php",
            method:"POST",
            data:{
                'nim':'<?=$nim?>',
                'key':'load',
                'mtk':'skp'
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
                            id="'+data[count].id+'"class="check_box_2"  /></td>';
                    html += '<td>'+(count+1)+'</td>';
                    html += '<td>'+data[count].nama+'</td>';
                    html += '<td>'+data[count].tanggal_nilai+'</td>';
                    html += '<td>'+data[count].nilai+'</td>';
                    html += '<td style="overflow:auto;">'+desc_nilai+'</td>';
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
                $('#tbody_skp').html(html);
                
            }
        });
    }
    
    fetch_data_sikap_perpeserta();
    
    $(document).on('click', '.check_box_2', function(){
        var html = '';
        if(this.checked)
        {
            html = '<td><input type="checkbox" no="'+$(this).attr('no')+'" nama="'+$(this).attr('nama')+'" tanggal_nilai="'+$(this).attr('tanggal_nilai')+'"\n\
                    nilai="'+$(this).attr('nilai')+'" desc_nilai="'+$(this).attr('desc_nilai')+'" id="'+$(this).attr('id')+'" class="check_box_2" checked /></td>';
            html += '<input type="hidden" name="id[]" class="form-control" value="'+$(this).attr("id")+'" readonly/>';
            html += '<td>'+$(this).attr("no")+'</td>';
            html += '<td>'+$(this).attr("nama")+'</td>';
            html += '<td>'+$(this).attr("tanggal_nilai")+'</td>';
            html += '<td><select name="nilai[]" class="form-control" id="options2'+$(this).attr('no')+'">\n\
                    <option value="A">A</option>\n\
                    <option value="B">B</option>\n\
                    <option value="C">C</option>\n\
                    <option value="D">D</option>\n\
                    <option value="">KOSONGKAN</option>\n\</select></td>';
        }
        else
        {
            html = '<td><input type="checkbox" no="'+$(this).attr('no')+'" nama="'+$(this).attr('nama')+'" tanggal_nilai="'+$(this).attr('tanggal_nilai')+'"\n\
                    nilai="'+$(this).attr('nilai')+'" desc_nilai="'+$(this).attr('desc_nilai')+'" id="'+$(this).attr('id')+'" class="check_box_2" /></td>';
            html += '<td>'+$(this).attr("no")+'</td>';
            html += '<td>'+$(this).attr("nama")+'</td>';
            html += '<td>'+$(this).attr("tanggal_nilai")+'</td>';
            html += '<td>'+$(this).attr("nilai")+'</td>';
            html += '<td>'+$(this).attr("desc_nilai")+'</td>';
        }
        
        $(this).closest('tr').html(html);
        
        //SET option sesuai dengan database awal
        $("#options2"+$(this).attr('no')).val($(this).attr('nilai'));
    });
    
    //UPDATE
    $('#update_skp').on('click', function(event){
        event.preventDefault();
        
        //gunakan fungsi serializearray untuk auto add dengan push
        var serialize = $("#form_data_2").serializeArray();
        serialize.push({name: 'nim', value: '<?=$nim?>'});
        serialize.push({name: 'key', value: 'update'});
        serialize.push({name: 'mtk', value: 'skp'});
        
        if($('.check_box_2:checked').length > 0)
        {
            $.ajax({
                url:"peserta_data_opr.php",
                method:"POST",
                data:$.param(serialize),
                success:function(data)
                {
                    fetch_data_sikap_perpeserta();
                }
             })
        }
    });
    
    //DELETE
    $('#delete_skp').on('click', function(event){
        event.preventDefault();
        
        //gunakan fungsi serializearray untuk auto add dengan push
        var serialize = $("#form_data_2").serializeArray();
        serialize.push({name: 'nim', value: '<?=$nim?>'});
        serialize.push({name: 'key', value: 'delete'});
        serialize.push({name: 'mtk', value: 'skp'});
        
        if($('.check_box_2:checked').length > 0)
        {
            $.ajax({
                url:"peserta_data_opr.php",
                method:"POST",
                data:$.param(serialize),
                success:function(data)
                {
                    fetch_data_sikap_perpeserta();
                }
             })
        }
    });
    
    //EDIT PRESENSI
    $('#presensi_edit').on('click', function(event){
        event.preventDefault();
        
        //gunakan fungsi serializearray untuk auto add dengan push
        
        var serialize = $("#presensi").serializeArray();
        serialize.push({name: 'nim', value: '<?=$nim?>'});
        serialize.push({name: 'key', value: 'presensi_edit'});
        $.ajax({
            url:"peserta_data_opr.php",
            method:"POST",
            data:$.param(serialize),
            success:function(data)
            {
                fetch_data_presensi();
                $('#presensi_modal').modal('toggle');
            }
        })
    });
    
    //LOAD DATA PRESENSI
    function fetch_data_presensi(){
        //alert("asdd");
        $.ajax({
            url:"peserta_data_opr.php",
            method:"POST",
            dataType:"json",
            data:{
                'nim':'<?=$nim?>',
                'key':'presensi_load'
            },    
            success:function(data)
            {
                var html = '';
                html += '<li class="list-group-item list-group-item-info text-center">Data Presensi</li>';
                html += '<li class="list-group-item">Sakit : '+data['sakit']+'';
                html += '<li class="list-group-item">Izin : '+data['izin']+'';
                html += '<li class="list-group-item">Tanpa Keterangan : '+data['tanpa_ket']+'';
                $('#presensi_out').html(html);
                $('#sakit_in').val(data['sakit']);
                $('#izin_in').val(data['izin']);
                $('#tanpa_ket_in').val(data['tanpa_ket']);
            }
        })
    }
    
    fetch_data_presensi();
    
    //EDIT CATATAN
    $('#catatan_edit').on('click', function(event){
        event.preventDefault();
        
        //gunakan fungsi serializearray untuk auto add dengan push
        
        var serialize = $("#catatan").serializeArray();
        serialize.push({name: 'nim', value: '<?=$nim?>'});
        serialize.push({name: 'key', value: 'catatan_edit'});
        $.ajax({
            url:"peserta_data_opr.php",
            method:"POST",
            data:$.param(serialize),
            success:function(data)
            {
                fetch_data_catatan();
                $('#catatan_modal').modal('toggle');
            }
        })
    });
    
    //LOAD DATA CATATAN
    function fetch_data_catatan(){
        $.ajax({
            url:"peserta_data_opr.php",
            method:"POST",
            dataType:"json",
            data:{
                'nim':'<?=$nim?>',
                'key':'catatan_load'
            },    
            success:function(data)
            {
                var html = '';
                html += '<li class="list-group-item list-group-item-info text-center">Data Catatan</li>';
                html += '<li class="list-group-item">Catatan : '+data['deskripsi']+'';
                $('#catatan_out').html(html);
                $('#catatan_in').val(data['deskripsi']);
            }
        })
    }
    
    fetch_data_catatan();
    
})
</script>

<script type="text/javascript"> //MATKUL PESERTA
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
                'key':'load',
                'mtk':'mtk'
            },
            dataType:"json",
            error: function (xhr, status) {
                //set tidak ada isi jika error ATAU DATA = 0 (NULL) atau data tidak terbaca
                var html = '';
                $('tbody').html(html);
                //alert(JSON.stringify(xhr));
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
                    html += '<td style="overflow:auto;">'+desc_nilai+'</td>';
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
        serialize.push({name: 'mtk', value: 'mtk'});
        
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
        serialize.push({name: 'mtk', value: 'mtk'});
        
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