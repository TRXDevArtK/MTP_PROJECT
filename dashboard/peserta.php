<?php
    session_start();
    #include sesuatu disini
    include_once "../sql_connect.php";
    include_once "database.php";
?>

<?php
    $limit = 20;
    $query = "SELECT COUNT(*) FROM peserta";  
    $sql_run = mysqli_query($conn2, $query);  
    $row = mysqli_fetch_row($sql_run);  
    $total_records = $row[0];  
    $total_pages = ceil($total_records / $limit);
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
            <br />
            <h3 align="center">List Peserta</h3>
            <br />
            <div align="left">
                <a href="peserta_add.php"><input type="button" class="btn btn-info" value="Tambah Peserta" /></a>
            </div>
            <form method="post" id="update_form">
                <br />
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th width="5%">No</th>
                            <th width="10%">Nim</th>
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
    </body>
</html>

<script> //PAKAI ACTIVE JAVASCRIPT (AJAX)
$(document).ready(function(){
    
    //AMBIL DATA NILAI MATA KULIAH DARI DATABASE (loaddata.php)
    function fetch_data_peserta(id)
    {
        //REFRESH PAGE
        //$('#bp2').attr('data-id',2);
        if(id == null){
            id = 1;
        }
        $.ajax({
            url:"peserta_opr.php",
            method:"POST",
            data:{
                'limit':'<?=$limit?>',
                'page':id,
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
                for(count; count < data.length; count++){
                    html += '<tr>';
                    html += '<td>'+(count+1)+'</td>';
                    html += '<td>'+data[count].nim+'</td>';
                    html += '<td>'+data[count].namafull+'</td>';
                    html += '<td>\n\
                                <i></i><form action="peserta_data.php" method="post" class="pull-left" style="margin-right : 10px">\n\
                                            <input type="hidden" name="nim" value="'+data[count].nim+'" readonly>\n\
                                            <input type="hidden" name="namafull" value="'+data[count].namafull+'" readonly>\n\
                                            <input type="submit" value="Data Peserta" class="btn btn-primary">\n\
                                        </form>\n\
                                <i></i><input type="button" class="pull-left btn btn-danger" id="peserta_hapus" id_s="'+data[count].nim+'"value="Hapus Peserta">\n\
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
    
    fetch_data_peserta();
    
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

        fetch_data_peserta(id);
    });
    
    //Hapus MTK
    $(document).on('click', '#peserta_hapus', function(){
        //var text;
        var submit = prompt("Apa anda yakin ingin menghapus PESERTA ? \n\
        \n\Ketik 'YAKIN' (Huruf Besar) jika anda yakin untuk menghapus PESERTA", "KETIK DISINI");
        var id = $(this).attr('id_s');
        var page = $('#bp2').attr('data-id');
        if(submit == "YAKIN"){
          $.ajax({
                url:"peserta_opr.php",
                method:"POST",
                data : {
                    nim : id,
                    'key':'delete'
                },
                //dataType:"json",
                success:function(data){
                    alert("Mahasiswa Dihapus");
                    fetch_data_peserta(page-1);
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