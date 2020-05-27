<?php

    include('database.php');

    $idmatkul = $_POST['idmatkul'];
    
    if(isset($_POST['mtk'])){
        $mtk = $_POST['mtk'];
    }
    else{
        $mtk = null;
    }
  
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
        <?php include("nav.html"); ?>
        <div class="container">
            <div class="page-header text-center">
                <h3>Matkul List</h3>      
            </div>
                <form method="post" id="form_data">
                    <!-- BUTTON SEBAGAI BUTTON BIASA (BUKAN SUBMIT) agar nantinya bisa fleksibel kegunaannya-->
                    <div align="left">
                        <input type="button" name="submit" id="submit" class="btn btn-info" value="Pilih Matkul Yang Di Centang" />
                    </div>
                    <br />
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th width="5%">Pilih</th>
                                <th width="5%">No</th>
                                <th width="10%">NIM</th>
                                <th width="5%">Nama Peserta</th>
                            </thead>
                            <tbody id="tbody"></tbody>
                        </table>
                        <div class="text-center">Catatan : Jika data tidak ada , berarti seluruh peserta sudah diinputkan ke matkul</div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<script>
$(document).ready(function(){
    
    //AMBIL DATA NILAI MATA KULIAH DARI DATABASE (loaddata.php)
    function fetch_data_peserta()
    {
        //REFRESH PAGE
        $.ajax({
            url:"mtk_pes_opr.php",
            method:"POST",
            data:{
                'idmatkul':'<?=$idmatkul?>',
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
                console.log(data);
                var html = '';
                var count = 0;
                for(count; count < data.length; count++){
                    html += '<tr>';
                    html += '<td><input type="checkbox" no="'+(count+1)+'" nim="'+data[count].nim+'" namafull="'+data[count].namafull+'" class="check_box"/></td>';
                    html += '<td>'+(count+1)+'</td>';
                    html += '<td>'+data[count].nim+'</td>';
                    html += '<td>'+data[count].namafull+'</td>';
                    html += '</tr>';
                    //console.log(data[count].id);
                }
                
                //CEK DATA JSON (butuh JSON.stringify
                //alert(JSON.stringify(data));
                
                //Masukkan koda tadi ke <tbody> yang ada di html
                $('#tbody').html(html);
                
            }
        });
    }
    
    fetch_data_peserta();
    
    $(document).on('click', '.check_box', function(){
        var html = '';
        if(this.checked)
        {
            html = '<td><input type="checkbox" no="'+$(this).attr('no')+'" nim="'+$(this).attr('nim')+'" namafull="'+$(this).attr('namafull')+'" class="check_box" checked /></td>';
            html += '<td>'+$(this).attr("no")+'</td>';
            html += '<td>'+$(this).attr("nim")+'</td>';
            html += '<input type="hidden" name="nim[]" class="form-control" value="'+$(this).attr("nim")+'" readonly/>';
            html += '<td>'+$(this).attr("namafull")+'</td>';

        }
        else
        {
            html = '<td><input type="checkbox" no="'+$(this).attr('no')+'" nim="'+$(this).attr('nim')+'" namafull="'+$(this).attr('namafull')+'" class="check_box" /></td>';
            html += '<td>'+$(this).attr("no")+'</td>';
            html += '<td>'+$(this).attr("nim")+'</td>';
            html += '<td>'+$(this).attr("namafull")+'</td>';
        }
        
        $(this).closest('tr').html(html);
        
    });
    
    $('#submit').on('click', function(event){
        event.preventDefault();
        
        //gunakan fungsi serializearray untuk auto add dengan push
        var serialize = $("#form_data").serializeArray();
        serialize.push({name: 'idmatkul', value: '<?=$idmatkul?>'});
        serialize.push({name: 'key', value: 'submit'});
        serialize.push({name: 'mtk', value: '<?=$mtk?>'});
        
        //alert($.param(serialize));
        
        if($('.check_box:checked').length > 0){
            $.ajax({
                url:"mtk_pes_opr.php",
                method:"POST",
                data:$.param(serialize),
                success:function(data)
                {
                    var url = "";
                    <?php if($mtk == 'skp'){?>
                        url = "mtk_skp_data.php";
                    <?php } else if($mtk == 'mtk'){?>
                        url = "mtk_data.php";
                    <?php } ?>
                    $(location).attr('href',url);
                    //fetch_data_mtk();
                }
             })
        }
    });
    
})
</script>
