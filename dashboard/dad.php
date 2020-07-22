<?php
    #include sesuatu disini
    include_once "database.php";
    
    //ambil data komsat
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
        <link rel="stylesheet" href="../css/loading.css" />
        <script src="../js/bootstrap.min.js"></script>  
        <title></title>
    </head>
    <body>
        <?php include("nav.html"); ?>
        <br><br>
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
                                <label>NIA Ketum Umum :</label>
                                <input type="number" class="form-control" name="ketum_nia" id="ketum_nia" placeholder="4643534" value="">
                            </div>
                            
                            <div class="form-group">
                                <label>Bidang Kader (Nama) :</label>
                                <input type="text" class="form-control" name="kader_nama" id="kader_nama" placeholder="Muhammad T" value="">
                                <label>NIA Kader :</label>
                                <input type="number" class="form-control" name="kader_nia" id="kader_nia" placeholder="1232344" value="">
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
                                <input type="submit" name="edit" class="btn btn-primary pull-left" style="margin-right:10px;"value="Edit Data Komsat Pelaksana">
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
                                <li class="list-group-item list-group-item-info text-center">Data Komsat Tambahan</li>
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
            <hr style="color:black">
            <form method="post" id="form_data">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <li class="list-group-item text-center list-group-item-info"><h3 style="color:black">Data Instruktur</h3>
                                <span style="display: inline;">
                                    <a href="instruktur_add.php"><input type="button" name="add" id="add" class="btn btn-success" value="Tambah Data" /></a>
                                    <input type="button" name="multiple_update" id="update" class="btn btn-primary" value="Update Data Yang Dipilih" />
                                    <input type="button" name="multiple_delete" id="delete" class="btn btn-danger" value="Delete Data Yang Dipilih" />
                                </span>
                            </li>
                        </tr>
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
        <div class="ajaxload"><!-- ini loading ajax --></div>
    </body>
</html>

<script>
$(document).ready(function(){
    
    $body = $("body");
    
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }    
    });
    
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
                            jabatan="'+data[count].jabatan+'" asal="'+data[count].asal+'" mot_state="'+data[0].mot_state+'" class="check_box" /></td>';
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
                html +='<li class="list-group-item list-group-item-info text-center">Data PC</li>';
                html += '<li class="list-group-item">Ketum PC Djazman : '+data[1].nama+' ( NIA : '+data[1].nia+')';
                html += '<li class="list-group-item">Bidang Kader PC : '+data[0].nama+' (NIA : '+data[0].nia+')';
                $('#pc_out').html(html);
                
                $('#kader_nama').val(data[0].nama);
                $('#kader_nia').val(data[0].nia);
                $('#ketum_nama').val(data[1].nama);
                $('#ketum_nia').val(data[1].nia);
            }
        });
    }
    
    fetch_data_instruktur();
    fetch_data_pc();
    
    $(document).on('click', '.check_box', function(){
        var html = '';
        var mot = $(this).attr('mot_state');
        if(this.checked)
        {
            html += '<td><input type="checkbox" no="'+$(this).attr('no')+'" nia="'+$(this).attr('nia')+'" nama="'+$(this).attr('nama')+'"\n\
                    jabatan="'+$(this).attr('jabatan')+'" asal="'+$(this).attr('asal')+'" class="check_box" checked/></td>';
            html += '<input type="hidden" name="nia[]" class="form-control" value="'+$(this).attr("nia")+'" readonly/>'
            html += '<td>'+$(this).attr('no')+'</td>';
            html += '<td>'+$(this).attr('nia')+'</td>';
            html += '<td><input type="text" name="nama[]" class="form-control" value="'+$(this).attr("nama")+'"/></td>';
            html += '<td><select name="jabatan[]" class="form-control" id="options2'+$(this).attr('no')+'">';
            
            if(mot == "mot_true"){
                html += '<option value="MOT" disabled>MOT</option>';
            }
            else{
                html += '<option value="MOT">MOT</option>';
            }
            html += '<option value="SOT">SOT</option>\n\
                    <option value="IOT">IOT</option>\n\
                    <option value="PO">PO</option>\n\
                    <option value="OB">OB</option>\n\
                    <option value="">KOSONGKAN</option>\n\</select></td>';        
    
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
        $("#options2"+$(this).attr('no')).val($(this).attr('jabatan'));
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

