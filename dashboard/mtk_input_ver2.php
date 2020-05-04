<?php
    session_start();
    #include sesuatu disini
    include_once "../sql_connect.php";
    include_once "database.php";
?>

<?php
    #ID PAGE

    $idmatkul = $_POST['id'];
    $nama = $_POST['nama'];
    $semester = $_POST['semester'];
    $thn = $_POST['thn'];
    $kelas = $_POST['kelas'];
    $kkm = $_POST['kkm'];
    
    $limit = 10;
    $query = "SELECT COUNT(*) FROM nilaimtk";  
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
        <script src="../scripts/jquery-3.4.1.js"></script>
        <link rel="stylesheet" href="../css/bootstrap337.min.css" />  
        <script src="../scripts/bootstrap.js"></script>  
        <title></title>
    </head>
    <body>
        <div class="container">
            <ul>
                <li>Matkul : <?php echo $nama;?></li>
                <li>Semester : <?php echo $semester;?></li>
                <li>Tahun Ajaran : <?php echo $thn;?></li>
                <li>Kelas : <?php echo $kelas;?></li>
                <li>KKM : <?php echo $kkm;?></li>
            </ul>
            <br />
            <h3 align="center">List Nilai Matkul Al-Quran</h3>
            <br />
            <form method="post" id="update_form">
                <div align="left">
                    <input type="submit" name="multiple_update" id="multiple_update" class="btn btn-info" value="Multiple Update" />
                    <label for="cars">Jumlah Data Perhalaman :</label>
                    <select id="limit">
                        <option value="2" selected="selected">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
                <br />
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th width="5%">Pilih</th>
                            <th width="10%">No</th>
                            <th width="15%">NIM</th>
                            <th width="30%">Nama</th>
                            <th width="10%">Nilai</th>
                        </thead>
                        <tbody id="tbody"></tbody>
                    </table>
                </div>
            </form>
            <!--PERHATIAN, CSS TABEL DAN ISINYA MASIH MENGGUNAKAN BOOTSTRAP 3.3.7, SILAHKAN KALAU MAU GANTI ATAU MODIF -->
            <div class="text-center">
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
            <h3 align="center">Deskripsi Nilai</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th width="15%">A</th>
                        <th width="15%">B</th>
                        <th width="15%">C</th>
                        <th width="15%">D</th>
                    </thead>
                    <tbody id="abody"></tbody>
                </table>
            </div>
        </div>
    </body>
</html>

<script> //PAKAI ACTIVE JAVASCRIPT (AJAX)
$(document).ready(function(){
    
    $("#limit").change(function(){
    alert("ahsd");
    }
    
    //AMBIL DATA NILAI MATA KULIAH DARI DATABASE (loaddata.php)
    function fetch_data_nilaimtk(id)
    {
        //REFRESH PAGE
        //$('#bp2').attr('data-id',1);
        var limit_perpage = $("#limit :selected").val();
        if(id == null){
            id = 1;
        }
        $.ajax({
            url:"load_nilaimtk.php",
            method:"POST",
            /* Masukkan data yang diperlukan untuk di loaddatanya di loaddata.php*/
            data:{
                'idmatkul': '<?=$idmatkul?>',
                'limit':limit_perpage,
                'page':id
            },
            dataType:"json",
            success:function(data)
            {
                var html = '';
                var count = 0;
                for(count; count < data.length; count++)
                {
                    html += '<tr>';
                    html += '<td><input type="checkbox" no="'+(count+1)+'" nim="'+data[count].nim+'" namafull="'+data[count].namafull+'" nilai="'+data[count].nilai+'" class="check_box"  /></td>';
                    html += '<td>'+(count+1)+'</td>';
                    html += '<td>'+data[count].nim+'</td>';
                    html += '<td>'+data[count].namafull+'</td>';
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
            url:"load_descmtk.php",
            method:"POST",
            /* Masukkan data yang diperlukan untuk di loaddatanya di loaddata.php*/
            data:{
                'idmatkul': '<?=$idmatkul?>'
            },
            dataType:"json",
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
        var limit_perpage = $("#limit :selected").val();
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

        $.ajax({
        url:"load_nilaimtk.php",
        method:"POST",
        /* Masukkan data yang diperlukan untuk di loaddatanya di loaddata.php*/
        data:{
            'idmatkul': '<?=$idmatkul?>',
            'limit':limit_perpage,
            'page':id
        },
        dataType:"json",
        success:function(data)
        {
            var html = '';
            var count = 0;
            for(count; count < data.length; count++)
            {
                html += '<tr>';
                html += '<td><input type="checkbox" no="'+(count+1)+'" nim="'+data[count].nim+'" namafull="'+data[count].namafull+'" nilai="'+data[count].nilai+'" class="check_box"  /></td>';
                html += '<td>'+(count+1)+'</td>';
                html += '<td>'+data[count].nim+'</td>';
                html += '<td>'+data[count].namafull+'</td>';
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
    });
    
    //JALANKAN FUNGSI fetch_data
    fetch_data_nilaimtk();
    fetch_data_descmtk();
    
    $(document).on('click', '.check_box', function(){
        var html = '';
        alert($(this).attr('nilai'));
        if(this.checked)
        {
            html = '<td><input type="checkbox" no="'+$(this).attr('no')+'" nim="'+$(this).attr('nim')+'" namafull="'+$(this).attr('namafull')+'" nilai="'+$(this).attr('nilai')+'" class="check_box" checked /></td>';
            html += '<td>'+$(this).attr("no")+'</td>';
            html += '<td>'+$(this).attr("nim")+'<input type="hidden" name="nim[]" class="form-control" value="'+$(this).attr("nim")+'" readonly/></td>';
            html += '<td>'+$(this).attr("namafull")+'</td>';
            
            html += '<td><select name="nilai[]" class="form-control" id="n_op">\n\
                    <option value="A">A</option>\n\
                    <option value="B">B</option>\n\
                    <option value="C">C</option>\n\
                    <option value="D">D</option>\n\
                    <option value="">KOSONGKAN</option>\n\</select></td>';
        }
        else
        {
            html = '<td><input type="checkbox" no="'+$(this).attr('no')+'" nim="'+$(this).attr('nim')+'" namafull="'+$(this).attr('namafull')+'" nilai="'+$(this).attr('nilai')+'" class="check_box" /></td>';
            html += '<td>'+$(this).attr('no')+'</td>';
            html += '<td>'+$(this).attr('nim')+'</td>';
            html += '<td>'+$(this).attr('namafull')+'</td>';
            html += '<td>'+$(this).attr('nilai')+'</td>';
        }
        $(this).closest('tr').html(html);
        
        //SET option sesuai dengan database awal
        $("#n_op").val($(this).attr('nilai'));
    });
    
    $('#update_form').on('submit', function(event){
        event.preventDefault();
        
        //gunakan fungsi serializearray untuk auto add dengan push
        var serialize = $(this).serializeArray();
        var page = $('#bp2').attr('data-id');
        serialize.push({name: 'idmatkul', value: <?=$idmatkul?>});
        
        if($('.check_box:checked').length > 0)
        {
            $.ajax({
                url:"update.php",
                method:"POST",
                data:$.param(serialize),
                success:function(data)
                {
                    alert(page);
                    fetch_data_nilaimtk(page-1);
                }
             })
        }
    });
        
    
})
    
    
    
    
    /* 

    $(document).on('click', '.check_box', function(){
        var html = '';
        if(this.checked)
        {
            html = '<td><input type="checkbox" no="'+$(this).attr('no')+'" nim="'+$(this).data('nim')+'" nama="'+$(this).data('nama')+'" nilai="'+$(this).data('nilai')+'" data-designation="'+$(this).data('designation')+'" data-age="'+$(this).data('age')+'" class="check_box" checked /></td>';
            html += '<td><input type="text" nim="nim[]" class="form-control" value="'+$(this).data("nim")+'" /></td>';
            html += '<td><input type="text" nim="nama[]" class="form-control" value="'+$(this).data("nama")+'" /></td>';
            html += '<td><select nim="nilai[]" no="nilai_'+$(this).attr('no')+'" class="form-control"><option value="Male">Male</option><option value="Female">Female</option></select></td>';
            html += '<td><input type="text" nim="designation[]" class="form-control" value="'+$(this).data("designation")+'" /></td>';
            html += '<td><input type="text" nim="age[]" class="form-control" value="'+$(this).data("age")+'" /><input type="hnoden" nim="hnoden_no[]" value="'+$(this).attr('no')+'" /></td>';
        }
        else
        {
            html = '<td><input type="checkbox" no="'+$(this).attr('no')+'" nim="'+$(this).data('nim')+'" nama="'+$(this).data('nama')+'" nilai="'+$(this).data('nilai')+'" data-designation="'+$(this).data('designation')+'" data-age="'+$(this).data('age')+'" class="check_box" /></td>';
            html += '<td>'+$(this).data('nim')+'</td>';
            html += '<td>'+$(this).data('nama')+'</td>';
            html += '<td>'+$(this).data('nilai')+'</td>';
            html += '<td>'+$(this).data('designation')+'</td>';
            html += '<td>'+$(this).data('age')+'</td>';            
        }
        $(this).closest('tr').html(html);
        $('#nilai_'+$(this).attr('no')+'').val($(this).data('nilai'));
    });

    $('#update_form').on('submit', function(event){
        event.preventDefault();
        if($('.check_box:checked').length > 0)
        {
            $.ajax({
                url:"multiple_update.php",
                method:"POST",
                data:$(this).serialize(),
                success:function()
                {
                    alert('Data Updated');
                    fetch_data();
                }
            })
        }
    });

};  */
</script>

