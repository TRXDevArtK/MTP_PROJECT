<?php
    
    #include sesuatu disini
    include_once "database.php";
    
    $query = "SELECT *FROM `komsat`";
    $sql_run = mysqli_query($conn2, $query);
    $row = mysqli_fetch_assoc($sql_run);
    
    $id = $row['id'];
    $pelaksana = $row['pelaksana'];
    $alamat = $row['alamat'];
    $kecamatan = $row['kecamatan'];
    $kota = $row['kota'];
    $provinsi = $row['provinsi'];
    $faks = $row['faks'];
    $periode = $row['periode'];
    $ketua = $row['ketua'];
    $telp = $row['telp'];
    $cabang = $row['cabang'];
    
?>

<html>
    <head>
        <!--Metadata-->
        <meta charset="UTF-8">
        <script src="../js/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />  
        <script src="../js/bootstrap.min.js"></script>  
        <title></title>
    </head>
    <body>
        <div class="container">
            
             <!-- Modal -->
            <div id="pc_modal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center">Data PC</h4>
                    </div>
                    <div class="modal-body">
                        <form id="pc_data">
                            <div class="form-group">
                                <label>Ketua Umum (Nama) :</label>
                                <input type="text" class="form-control" name="ketum_nama" id="ketum_nama" placeholder="Dzikri A" value="">
                                <label>NBA Ketum Umum :</label>
                                <input type="number" class="form-control" name="ketum_nba" id="ketum_nba" placeholder="4643534" value="">
                            </div>
                            
                            <div class="form-group">
                                <label>Bidang Kader (Nama) :</label>
                                <input type="text" class="form-control" name="kader_nama" id="kader_nama" placeholder="Muhammad T" value="">
                                <label>NBA Kader :</label>
                                <input type="number" class="form-control" name="kader_nba" id="kader_nba" placeholder="1232344" value="">
                            </div>
                            
                            <input type="button" name="pc_edit" id="pc_edit" class="btn btn-primary center-block" value="Update / Submit">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
              </div>
            </div>
             
            <form action="komsat_edit.php" method="post">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <input type="submit" name="edit" class="btn btn-primary pull-left" style="margin-right:10px;"value="Edit Data Komsat">
                                <input type="button" data-toggle="modal" data-target="#pc_modal" id="edit_pc" name="edit_pc" class="btn btn-primary pull-left" value="Edit Data PC">
                                <br><br><br>
                                <input type="hidden" name="id" value="<?php echo $id ?>" readonly>
                                <a class="list-group-item">Komsat Pelaksana : <?php echo $pelaksana ?></a><input type="hidden" name="pelaksana" value="<?php echo $pelaksana ?>" readonly>
                                <a class="list-group-item">Nama Ketua : <?php echo $ketua ?></a><input type="hidden" name="ketua" value="<?php echo $ketua ?>" readonly>
                                <a class="list-group-item">Pimpinan Cabang : <?php echo $cabang ?></a><input type="hidden" name="cabang" value="<?php echo $cabang ?>" readonly>
                                <a class="list-group-item">No Telp/WA : <?php echo $telp ?></a><input type="hidden" name="telp" value="<?php echo $telp ?>" readonly>
                                <br>
                                <button data-toggle="collapse" href="#collapse1" type="button" class="btn btn-info">Data Komsat +</button>
                                <button data-toggle="collapse" href="#collapse2" type="button" class="btn btn-info">Data PC +</button>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse">
                            <ul class="list-group">
                                <li class="list-group-item">Alamat : <?php echo $alamat ?><input type="hidden" name="alamat" value="<?php echo $alamat ?>" readonly>
                                <li class="list-group-item">Kecamatan : <?php echo $kecamatan ?><input type="hidden" name="kecamatan" value="<?php echo $kecamatan ?>" readonly>
                                <li class="list-group-item">Kabupaten/Kota : <?php echo $kota ?><input type="hidden" name="kota" value="<?php echo $kota ?>" readonly>
                                <li class="list-group-item">Provinsi : <?php echo $provinsi ?><input type="hidden" name="provinsi" value="<?php echo $provinsi ?>" readonly>
                                <li class="list-group-item">Telp/Faks : <?php echo $faks ?><input type="hidden" name="faks" value="<?php echo $faks ?>" readonly>
                                <li class="list-group-item">Periode Jabatan : <?php echo $periode ?><input type="hidden" name="periode" value="<?php echo $periode ?>" readonly>
                            </ul>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <!-- Data ada di script -->
                            <ul class="list-group" id="pc_out">
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
             
            <br>
            
            <span style="display: inline;">
                <a href="instruktur_add.php"><input type="button" name="add" id="add" class="btn btn-success" value="Tambah Data" /></a>
                <input type="button" name="multiple_update" id="update" class="btn btn-primary" value="Update Data Yang Dipilih" />
                <input type="button" name="multiple_delete" id="delete" class="btn btn-danger" value="Delete Data Yang Dipilih" />
            </span>
            <br><br>
            <form method="post" id="form_data">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th width="2%">Pilih</th>
                            <th width="2%">No</th>
                            <th width="5%">NIA</th>
                            <th width="10%">Nama</th>
                            <th width="15%">Jabatan</th>
                            <th width="10%">Asal Komsat</th>
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
    
    //LOAD DATA KOMSAT
    function fetch_data_instruktur(){
        $.ajax({
            url:"dad_opr.php",
            method:"POST",
            data:{
              'key':'load_instruktur'  
            },
            dataType:"json",
            error: function (xhr, status) {
                //set tidak ada isi jika error ATAU DATA = 0 (NULL) atau data tidak terbaca
                var html = '';
                $('#tbody').html(html);
            },
            success:function(data)
            {
                var html = '';
                var count = 0;
                for(count; count < data.length; count++){
                    
                    html += '<tr>';
                    html += '<td><input type="checkbox" no="'+(count+1)+'" nia="'+data[count].nia+'" nama="'+data[count].nama+'"\n\
                            jabatan="'+data[count].jabatan+'" asal="'+data[count].asal+'" class="check_box" /></td>';
                    html += '<td>'+(count+1)+'</td>';
                    html += '<td>'+data[count].nia+'</td>';
                    html += '<td>'+data[count].nama+'</td>';
                    html += '<td>'+data[count].jabatan+'</td>';
                    html += '<td>'+data[count].asal+'</td>';
                    html += '</tr>';                 
                }
                
                $('#tbody').html(html);
            }
        });
    }
    
    //LOAD DATA PC
    function fetch_data_pc(){
        //alert("asdd");
        $.ajax({
            url:"dad_opr.php",
            method:"POST",
            data:{
              'key':'load_pc'  
            },
            dataType:"json",
            success:function(data)
            {
                var html = '';
                html += '<li class="list-group-item">Ketum PC Djazman : '+data[0].nama+' ( NBA : '+data[0].nba+')';
                html += '<li class="list-group-item">Bidang Kader PC : '+data[1].nama+' (NBA : '+data[1].nba+')';
                $('#pc_out').html(html);
                
                $('#kader_nama').val(data[0].nama);
                $('#kader_nba').val(data[0].nba);
                $('#ketum_nama').val(data[1].nama);
                $('#ketum_nba').val(data[1].nba);
            }
        });
    }
    
    fetch_data_instruktur();
    fetch_data_pc();
    
    $(document).on('click', '.check_box', function(){
        var html = '';
        if(this.checked)
        {
            html += '<td><input type="checkbox" no="'+$(this).attr('no')+'" nia="'+$(this).attr('nia')+'" nama="'+$(this).attr('nama')+'"\n\
                    jabatan="'+$(this).attr('jabatan')+'" asal="'+$(this).attr('asal')+'" class="check_box" checked/></td>';
            html += '<input type="hidden" name="nia[]" class="form-control" value="'+$(this).attr("nia")+'" readonly/>'
            html += '<td>'+$(this).attr('no')+'</td>';
            html += '<td>'+$(this).attr('nia')+'</td>';
            html += '<td><input type="text" name="nama[]" class="form-control" value="'+$(this).attr("nama")+'"/></td>';
            html += '<td><input type="text" name="jabatan[]" class="form-control" value="'+$(this).attr("jabatan")+'"/></td>';        
            html += '<td><input type="text" name="asal[]" class="form-control" value="'+$(this).attr("asal")+'"/></td>';
        }
        else
        {
            html += '<td><input type="checkbox" no="'+$(this).attr('no')+'" nia="'+$(this).attr('nia')+'" nama="'+$(this).attr('nama')+'"\n\
                    jabatan="'+$(this).attr('jabatan')+'" asal="'+$(this).attr('asal')+'" class="check_box"/></td>';
            html += '<td>'+$(this).attr('no')+'</td>';
            html += '<td>'+$(this).attr('nia')+'</td>';
            html += '<td>'+$(this).attr('nama')+'</td>';
            html += '<td>'+$(this).attr('jabatan')+'</td>';
            html += '<td>'+$(this).attr('asal')+'</td>';            
        }
        
        $(this).closest('tr').html(html);
    });
    
    //UPDATE DATA INSTRUKTUR
    $('#update').on('click', function(event){
        event.preventDefault();
        //gunakan fungsi serializearray untuk auto add dengan push
        var serialize = $("#form_data").serializeArray();
        serialize.push({name: 'key', value: 'update_instruktur'});
        if($('.check_box:checked').length > 0)
        {
            $.ajax({
                url:"dad_opr.php",
                method:"POST",
                data:$.param(serialize),
                success:function(data)
                {
                    fetch_data_instruktur();
                }
             });
        }
    });
    
    //UPDATE DATA INSTRUKTUR
    $('#delete').on('click', function(event){
        event.preventDefault();
        //gunakan fungsi serializearray untuk auto add dengan push
        var serialize = $("#form_data").serializeArray();
        serialize.push({name: 'key', value: 'delete_instruktur'});
        
        //alert("asdwd");
        if($('.check_box:checked').length > 0)
        {
            $.ajax({
                url:"dad_opr.php",
                method:"POST",
                data:$.param(serialize),
                success:function(data)
                {
                    fetch_data_instruktur();
                }
             });
        }
    });
    
    //UPDATE DATA PC
    $('#pc_edit').on('click', function(event){
        event.preventDefault();
        //gunakan fungsi serializearray untuk auto add dengan push
        var serialize = $("#pc_data").serializeArray();
        serialize.push({name: 'key', value: 'update_pc'});
        $.ajax({
            url:"dad_opr.php",
            method:"POST",
            data:$.param(serialize),
            success:function(data)
            {
                $('#pc_modal').modal('toggle');
                fetch_data_pc();
            }
         });
    });
    
})
</script>

