<?php
    #include sesuatu disini
    include_once "database.php";
    
?>

<?php

    //rumus untuk pagination
    //set limit, 20 data di list akan tampil
    $limit = 1;
    $query = "SELECT COUNT(*) FROM kader";  
    $sql_run = mysqli_query($conn2, $query);  
    $row = mysqli_fetch_row($sql_run);  
    $total_records = $row[0];  
    $total_pages = ceil($total_records / $limit);
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
            <br />
            <h3 align="center">List Kader</h3>
            <br />
            <div class="row" style="margin:0px 0px;">
                <a href="kader_add"><input type="button" class="btn btn-info col-md-2 pull-left" value="Tambah Kader" /></a>
                <form id="tls_src">
                    <div class="col-md-1 pull-right">
                        <input type="button" id="search" name="search" class="btn btn-warning" value="Cari">
                    </div>
                    <div class="col-md-2 pull-right">
                        <div class="form-group">
                            <input type="text" placeholder="Masukkan keywordnya" name="keyword" id="keyword" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2 pull-right">
                        <select name="filter" id="filter" class="form-control">
                            <option value="">Semua Komsat</option>
                            <option value="FTI">FTI</option>
                            <option value="FKM">FKM</option>
                            <option value="Psikologi">Psikologi</option>
                            <option value="Farmasi">Farmasi</option>
                            <option value="JMIPA">JPMIPA</option>
                            <option value="FEB">FEB</option>
                        </select>
                    </div>
                    <div class="col-md-2 pull-right">
                        <select name="order" id="order" class="form-control">
                            <option value="nim ASC">NIM Terkecil</option>
                            <option value="nim DESC">NIM Terbesar</option>
                            <option value="namafull ASC">Nama Menaik</option>
                            <option value="namafull DESC">Nama Menurun</option>
                            <option value="komsat ASC">Komsat Menaik</option>
                            <option value="komsat DESC">Komsat Menurun</option>
                        </select>
                    </div>
                </form>
            </div>
            <form method="post" id="update_form">
                <br />
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th width="5%">No</th>
                            <th width="10%">Nim</th>
                            <th width="10%">Nama</th>
                            <th width="10%">Asal Komsat</th>
                            <th width="10%">Menu</th>
                        </thead>
                        <tbody></tbody>
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
        </div>
        <div class="ajaxload"><!-- ini loading ajax --></div>
    </body>
</html>

<script> //PAKAI ACTIVE JAVASCRIPT (AJAX)
$(document).ready(function(){
    
    //ini adalah rumus untuk loading jquery
    //jika load data dari database.php maka tampilkan animasi loading
    //agar orang tahu datanya lagi diload
    $body = $("body");
    
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }    
    });
    
    //AMBIL DATA NILAI MATA KULIAH DARI DATABASE
    function fetch_data_kader(id, order, filter, keyword)
    {
        //REFRESH PAGE
        //$('#bp2').attr('data-id',2);
        if(id == null){
            id = 1;
        }
        
        var lmt = <?=$limit?>;
        
        //alert(id-1 * lmt)
        //jalankan fungsi ajax
        $.ajax({
            url:"kader_opr",
            method:"POST",
            data:{
                limit:'<?=$limit?>',
                page:id,
                filter:filter,
                order:order,
                keyword:keyword,
                key:'load'
            },
            dataType:"json",
            error: function (xhr, status) {
                //set tidak ada isi jika error ATAU DATA = 0 (NULL) atau data tidak terbaca
                var html = '';
                $('tbody').html(html);
                console.log(JSON.stringify(xhr));
            },
            success:function(data)
            {
                var html = '';
                var count = 0;
                //dibawah adalah kode html yang akan diulang begitu juga dengan file databasenya sesuai index
                for(count; count < data.length; count++){
                    html += '<tr>';
                    html += '<td>'+(count+1)+'</td>';
                    html += '<td>'+data[count].nim+'</td>';
                    html += '<td>'+data[count].namafull+'</td>';
                    html += '<td>'+data[count].komsat+'</td>';
                    html += '<td>\n\
                                <i></i><form action="kader_data" method="post" class="pull-left" style="margin-right : 10px">\n\
                                            <input type="hidden" name="nim" value="'+data[count].nim+'" readonly>\n\
                                            <input type="hidden" name="namafull" value="'+data[count].namafull+'" readonly>\n\
                                            <input type="hidden" name="komsat" value="'+data[count].komsat+'" readonly>\n\
                                            <input type="submit" value="Data Kader" class="btn btn-primary">\n\
                                        </form>\n\
                                <i></i><input type="button" class="pull-left btn btn-danger" id="kader_hapus" id_s="'+data[count].nim+'"value="Hapus Kader">\n\
                            </td></tr>';
                    //console.log(data[count].id);
                    
                }
                
                //CEK DATA JSON (butuh JSON.stringify
                //alert(JSON.stringify(data));
                
                //Masukkan koda tadi ke <tbody> yang ada di html
                $('tbody').html(html);
                $(".pageitem").removeClass("active");
                $("#"+id).addClass("active");
                //$('abody').html(html);
                
            }
        });
    }
    
    fetch_data_kader(null,"nim ASC",null,null);
    
    //Jika pagination di click
    //maka kalkukasikan tombol paginationnya
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
        
        var keyword = $("#keyword").val();
        var filter = $("#filter").val();
        var order = $("#order").val();

        fetch_data_kader(id,order,filter,keyword);
    });
    $("#search").click(function(){
        var keyword = $("#keyword").val();
        var filter = $("#filter").val();
        var order = $("#order").val();
        
        fetch_data_kader(null,order,filter,keyword);
    });
    
    $("#keyword").keypress(function(){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            event.preventDefault();
            $('#search').trigger('click');
        }
    });
    
    $("#filter").change(function(){
        $('#search').trigger('click');
    });
    $("#order").change(function(){
        $('#search').trigger('click');
    });
    
    //fungsi hapus mtk
    $(document).on('click', '#kader_hapus', function(){
        var submit = prompt("Apa anda yakin ingin menghapus KADER ? \n\
        \n\Ketik 'YAKIN' (Huruf Besar) jika anda yakin untuk menghapus KADER", "KETIK DISINI");
        var id = $(this).attr('id_s');
        var page = $('#bp2').attr('data-id');
        var keyword = $("#keyword").val();
        var filter = $("#filter").val();
        var order = $("#order").val();
        if(submit == "YAKIN"){
          $.ajax({
                url:"kader_opr",
                method:"POST",
                data : {
                    nim : id,
                    'key':'delete'
                },
                //dataType:"json",
                success:function(data){
                    alert("Mahasiswa Dihapus");
                    fetch_data_kader(page-1,order,filter,keyword);
                }
            });
        }
        else{
          //alert("Penghapusal Batal");
        }
    });
})
</script>

<?php
    
?>