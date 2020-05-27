<?php
    ob_start();
    #include sesuatu disini
    include_once "database.php";
    
?>

<?php
    #ID PAGE
    
    $mtk = "skp";
    
    if(isset($_SESSION['id'])){
        $idmatkul = $_SESSION['id']."_mtk_skp";
        unset($_SESSION['id']);
    }
    else if(isset($_POST['id'])){
        $idmatkul = $_POST['id']."_mtk_skp";
    }
    else{
        header('Location:mtk_skp.php');
        exit();
    }
    
    $id_chp = chop($idmatkul,"_mtk_skp");
    
    $query = "SELECT nama FROM idmtk_skp WHERE id = $id_chp";
    $sql_run = mysqli_query($conn2, $query);
    $row = mysqli_fetch_assoc($sql_run);
    
    $nama = $row['nama'];
    
    $limit = 20;
    $query = "SELECT COUNT(*) FROM ".$idmatkul."";
    $sql_run = mysqli_query($conn2, $query);  
    $row = mysqli_fetch_row($sql_run);  
    $total_records = $row[0];  
    $total_pages = ceil($total_records / $limit);

    //echo "total pages = ",$total_pages," |-------| ";
    //echo "total_records = "; print_r($row); echo"|------|";
    //echo "limit = ",$limit;
    
    //DEBUGG
    /*print_r($_SESSION['nim']);
    unset ($_SESSION['nim']);
    echo " |------| ";
    print_r($_SESSION['nilai']);
    unset ($_SESSION['nilai']);
    echo " |------| ";
    print($_SESSION['idmatkul']);
    unset ($_SESSION['idmatkul'])*/
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
                <h3>Data Matkul Sikap</h3>      
            </div>
            <ul class="list-group">
                <li class="list-group-item">Matkul : <?php echo $nama;?></li>
            </ul>
            
            <hr style="color:black">
            <form action="mtk_pes_add.php" method="post">
                <input type="hidden" name="idmatkul" value="<?= $idmatkul ?>"/>
                <input type="hidden" name="mtk" value="<?= $mtk ?>"/>
                <input type="submit" name="add_pes" id="add" class="hidden"/>
            </form>
            
            <form method="post" id="form_data">
                <!-- BUTTON SEBAGAI BUTTON BIASA (BUKAN SUBMIT) agar nantinya bisa fleksibel kegunaannya-->
                <br />
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <li class="list-group-item text-center list-group-item-info"><h3 style="color:black">Nilai Matkul Sikap</h3>
                                <span style="display: inline;">
                                    <label for="add" tabindex="0" class="btn btn-success">Tambah Peserta</label>
                                    <input type="button" name="multiple_update" id="update" class="btn btn-primary" value="Update Data Yang Dipilih" />
                                    <input type="button" name="multiple_delete" id="delete" class="btn btn-danger" value="Hapus Data Yang Dipilih" />
                                </span>
                            </li>
                        </tr>
                        <thead>
                            <th width="5%">Pilih</th>
                            <th width="5%">No</th>
                            <th width="5%">NIM</th>
                            <th width="15%">Nama</th>
                            <th width="30%">Waktu & Tanggal Penilaian</th>
                            <th width="10%">Nilai</th>
                        </thead>
                        <tbody id="tbody"></tbody>
                    </table>
                </div>
            </form>
            <!--PERHATIAN, CSS TABEL DAN ISINYA MASIH MENGGUNAKAN BOOTSTRAP 3.3.7, SILAHKAN KALAU MAU GANTI ATAU MODIF -->
            <div class="text-center" <?php if($total_pages == 1){ echo " hidden"; }?>>
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
                            <a href="#" data-id="2" class="page-link" id="bp2" > > </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <hr style="color:black">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <li class="list-group-item text-center list-group-item-info"><h3 style="color:black">Deskripsi Nilai</h3>
                        </li>
                    </tr>
                    <thead>
                        <th width="15%" class="text-center">A</th>
                        <th width="15%" class="text-center">B</th>
                        <th width="15%" class="text-center">C</th>
                        <th width="15%" class="text-center">D</th>
                    </thead>
                    <tbody id="abody"></tbody>
                </table>
            </div>
        </div>
        
        <div class="ajaxload"><!-- ini loading ajax --></div>
    </body>
</html>

<script> //PAKAI ACTIVE JAVASCRIPT (AJAX)
$(document).ready(function(){
    
    $body = $("body");
    
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }    
    });
    
    //AMBIL DATA NILAI MATA KULIAH DARI DATABASE (loaddata.php)
    
    function fetch_data_nilaimtk(id)
    {
        //REFRESH PAGE
        //$('#bp2').attr('data-id',1);
        if(id == null){
            id = 1;
        }
        $.ajax({
            url:"mtk_data_opr.php",
            method:"POST",
            /* Masukkan data yang diperlukan untuk di loaddatanya di loaddata.php*/
            data:{
                'idmatkul': '<?=$idmatkul?>',
                'limit':'<?=$limit?>',
                'page':id,
                'key':'load_nilai'
            },
            dataType:"json",
            error: function (xhr, status) {
                //set tidak ada isi jika error ATAU DATA = 0 (NULL) atau data tidak terbaca
                var html = '';
                $('#tbody').html(html);
                //alert(JSON.stringify(xhr));
            },
            success:function(data)
            {
                var html = '';
                var count = 0;
                for(count; count < data.length; count++)
                {
                    html += '<tr>';
                    html += '<td><input type="checkbox" no="'+(count+1)+'" nim="'+data[count].nim+'" namafull="'+data[count].namafull+'" tanggal_nilai="'+data[count].tanggal_nilai+'" nilai="'+data[count].nilai+'" class="check_box"  /></td>';
                    html += '<td>'+(count+1)+'</td>';
                    html += '<td>'+data[count].nim+'</td>';
                    html += '<td>'+data[count].namafull+'</td>';
                    html += '<td>'+data[count].tanggal_nilai+'</td>';
                    html += '<td>'+data[count].nilai+'</td></tr>';
                }
                
                //CEK DATA JSON (butuh JSON.stringify
                //alert(JSON.stringify(data));
                
                //Masukkan koda tadi ke <tbody> yang ada di html
                $('#tbody').html(html);
                $(".pageitem").removeClass("active");
                $("#"+id).addClass("active");
                //$('abody').html(html);
                
            }
        });
    }
    
    //AMBIL DATA NILAI MATA KULIAH DARI DATABASE (loaddata.php)
    function fetch_data_descmtk()
    {
        $.ajax({
            url:"mtk_data_opr.php",
            method:"POST",
            /* Masukkan data yang diperlukan untuk di loaddatanya di loaddata.php*/
            data:{
                'idmatkul': '<?=$idmatkul?>',
                'key':'load_dsc',
                'mtk':'<?= $mtk ?>'
            },
            dataType:"json",
            error: function (xhr, status) {
                //set tidak ada isi jika error ATAU DATA = 0 (NULL) atau data tidak terbaca
                var html = '';
                $('#abody').html(html);
                //alert(JSON.stringify(xhr));
            },
            success:function(data)
            {
                var html = '';
                var count = 0;
                for(count; count < data.length; count++)
                {
                    html += '<tr>';
                    html += '<td>'+data[count].A+'</td>';
                    html += '<td>'+data[count].B+'</td>';
                    html += '<td>'+data[count].C+'</td>';
                    html += '<td>'+data[count].D+'</td></tr>';
                }
                
                //CEK DATA JSON (butuh JSON.stringify
                //alert(JSON.stringify(data));
                
                //Masukkan koda tadi ke <tbody> yang ada di html
                $('#abody').html(html);
                //$('abody').html(html);
                
            }
        });
    }
    
    //Jika pagination di click
    $(".page-link").click(function(){
        var id = $(this).attr("data-id");
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

        fetch_data_nilaimtk(id);
    });
    
    //JALANKAN FUNGSI fetch_data
    fetch_data_nilaimtk();
    fetch_data_descmtk();
    
    $(document).on('click', '.check_box', function(){
        var html = '';
        if(this.checked)
        {
            html = '<td><input type="checkbox" no="'+$(this).attr('no')+'" nim="'+$(this).attr('nim')+'" namafull="'+$(this).attr('namafull')+'" tanggal_nilai="'+$(this).attr('tanggal_nilai')+'" nilai="'+$(this).attr('nilai')+'" class="check_box" checked /></td>';
            html += '<td>'+$(this).attr("no")+'</td>';
            html += '<td>'+$(this).attr("nim")+'<input type="hidden" name="nim[]" class="form-control" value="'+$(this).attr("nim")+'" readonly/></td>';
            html += '<td>'+$(this).attr("namafull")+'</td>';
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
            html = '<td><input type="checkbox" no="'+$(this).attr('no')+'" nim="'+$(this).attr('nim')+'" namafull="'+$(this).attr('namafull')+'" tanggal_nilai="'+$(this).attr('tanggal_nilai')+'" nilai="'+$(this).attr('nilai')+'" class="check_box" /></td>';
            html += '<td>'+$(this).attr('no')+'</td>';
            html += '<td>'+$(this).attr('nim')+'</td>';
            html += '<td>'+$(this).attr('namafull')+'</td>';
            html += '<td>'+$(this).attr("tanggal_nilai")+'</td>';
            html += '<td>'+$(this).attr('nilai')+'</td>';
        }
        $(this).closest('tr').html(html);
        
        //SET option sesuai dengan database awal
        $("#options"+$(this).attr('no')).val($(this).attr('nilai'));
    });
    
    $('#update').on('click', function(event){
        event.preventDefault();
        
        //gunakan fungsi serializearray untuk auto add dengan push
        //Catatan : Serialize butuh form
        var serialize = $("#form_data").serializeArray();
        var page = $('#bp2').attr('data-id');
        serialize.push({name: 'idmatkul', value: '<?=$idmatkul?>'});
        serialize.push({name: 'key', value: 'update'});
        
        if($('.check_box:checked').length > 0)
        {
            $.ajax({
                url:"mtk_data_opr.php",
                method:"POST",
                data:$.param(serialize),
                success:function(data)
                {
                    fetch_data_nilaimtk(page-1);
                }
             })
        }
    });
    
    $('#delete').on('click', function(event){
        event.preventDefault();
        
        //gunakan fungsi serializearray untuk auto add dengan push
        //Catatan : Serialize butuh form
        var serialize = $("#form_data").serializeArray();
        var page = $('#bp2').attr('data-id');
        serialize.push({name: 'idmatkul', value: '<?=$idmatkul?>'});
        serialize.push({name: 'key', value: 'delete'});
        
        if($('.check_box:checked').length > 0)
        {
            $.ajax({
                url:"mtk_data_opr.php",
                method:"POST",
                data:$.param(serialize),
                success:function(data)
                {
                    fetch_data_nilaimtk(page-1);
                }
             })
        }
    });
        
    
})
</script>

