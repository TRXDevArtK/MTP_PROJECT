<?php
    #include sesuatu disini
    include_once "database.php";
?>

<?php
    $limit = 20;
    $query = "SELECT COUNT(*) FROM idmtk";  
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
            <h3 align="center">List Materi</h3>
            <br />
            <div class="row" style="margin:0px 0px;">
                <a href="mtk_add"><input type="button" class="btn btn-info col-md-2 pull-left" value="Tambah Materi" /></a>
                <form id="tls_src">
                    <div class="col-md-1 pull-right">
                        <input type="button" id="search" name="search" class="btn btn-warning" value="Cari">
                    </div>
                    <div class="col-md-2 pull-right">
                        <div class="form-group">
                            <input type="text" placeholder="Masukkan keywordnya" name="keyword" id="keyword" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <form method="post" id="update_form">
                <br />
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th width="5%">No</th>
                            <th width="10%">Nama</th>
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
    
    $body = $("body");
    
    $(document).on({
        ajaxStart: function() { $body.addClass("loading"); },
        ajaxStop: function() { $body.removeClass("loading"); }    
    });
    
    //AMBIL DATA NILAI MATA KULIAH DARI DATABASE (loaddata)
    function fetch_data_idmtk(id,keyword)
    {
        //REFRESH PAGE
        //$('#bp2').attr('data-id',2);
        if(id == null){
            id = 1;
        }
        if(keyword == null){
            keyword = "";
        }
        $.ajax({
            url:"mtk_opr",
            method:"POST",
            data:{
                limit:<?=$limit?>,
                page:id,
                keyword:keyword,
                key:'load'
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
                for(count; count < data.length; count++){
                    html += '<tr>';
                    html += '<td>'+(count+1)+'</td>';
                    html += '<td>'+data[count].nama+'</td>';
                    //html += '<td><button id="soak">SOAK</button></td>';
                    html += '<td>\n\
                                <i></i><form action="mtk_data" method="post" class="pull-left">\n\
                                            <input type="hidden" name="id" value="'+data[count].id+'" readonly>\n\
                                            <input type="submit" value="Input Nilai" class="btn btn-primary" style="margin-right:10px">\n\
                                        </form>\n\
                                <i></i><input type="button" class="pull-left btn btn-danger" id="mtk_hapus" id_s="'+data[count].id+'"value="Hapus Materi" style="margin-right:10px">\n\
                                <i></i><form action="mtk_edit" method="post" class="pull-left">\n\
                                            <input type="hidden" name="id" value="'+data[count].id+'" readonly>\n\
                                            <input type="hidden" name="nama" value="'+data[count].nama+'" readonly>\n\
                                            <input type="hidden" name="semester" value="'+data[count].semester+'" readonly>\n\
                                            <input type="hidden" name="thn" value="'+data[count].thn+'" readonly>\n\
                                            <input type="hidden" name="kelas" value="'+data[count].kelas+'" readonly>\n\
                                            <input type="hidden" name="kkm" value="'+data[count].kkm+'" readonly>\n\
                                            <input type="submit" name="edit" value="Edit Data Materi" class="btn btn-info">\n\
                                        </form>\n\
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
    
    fetch_data_idmtk();
    
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
        
        fetch_data_idmtk(id,null);
    });
    
    $("#search").click(function(){
        var keyword = $("#keyword").val();
        
        fetch_data_idmtk(null,keyword);
    });
    
    $("#keyword").keypress(function(){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            event.preventDefault();
            $('#search').trigger('click');
        }
    });
    
    //Hapus MTK
    $(document).on('click', '#mtk_hapus', function(){
        //var text;
        var submit = prompt("Apa anda yakin ingin menghapus materi ? \n\
        \n\Ketik 'YAKIN' (Huruf Besar) jika anda yakin untuk menghapus materi", "KETIK DISINI");
        var id = $(this).attr('id_s');
        var page = $('#bp2').attr('data-id');
        if(submit == "YAKIN"){
          $.ajax({
                url:"mtk_opr",
                method:"POST",
                data : {
                    id : id,
                    'key':'delete'
                },
                //dataType:"json",
                success:function(data){
                    alert("Materi Dihapus");
                    fetch_data_idmtk(page-1);
                }
            });
        }
        else{
          //alert("Penghapusal Batal");
        }
    });
    
})
</script>