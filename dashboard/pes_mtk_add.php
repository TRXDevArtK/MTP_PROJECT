<?php

include('database.php');
    
$nim = $_POST['nim'];
  
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
                                <th width="25%">Nama Matkul</th>
                                <th width="5%">Semester</th>
                            </thead>
                            <tbody id="tbody"></tbody>
                        </table>
                        <div class="text-center">Catatan : Jika data tidak ada , berarti seluruh matkul sudah diinputkan ke peserta</div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<script>
$(document).ready(function(){
    
    //AMBIL DATA NILAI MATA KULIAH DARI DATABASE (loaddata.php)
    function fetch_data_mtk()
    {
        //REFRESH PAGE
        $.ajax({
            url:"pes_mtk_opr.php",
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
                console.log(data);
                var html = '';
                var count = 0;
                for(count; count < data.length; count++){
                    html += '<tr>';
                    html += '<td><input type="checkbox" no="'+(count+1)+'" id="'+data[count].id+'" nama="'+data[count].nama+'" \n\
                            semester="'+data[count].semester+'" class="check_box"/></td>';
                    html += '<td>'+(count+1)+'</td>';
                    html += '<td>'+data[count].nama+'</td>';
                    html += '<td>'+data[count].semester+'</td>';
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
    
    fetch_data_mtk();
    
    $(document).on('click', '.check_box', function(){
        var html = '';
        if(this.checked)
        {
            html = '<td><input type="checkbox" no="'+$(this).attr('no')+'" id="'+$(this).attr('id')+'" nama="'+$(this).attr('nama')+'" \n\
                    semester="'+$(this).attr('semester')+'" class="check_box" checked /></td>';
            html += '<input type="hidden" name="id[]" class="form-control" value="'+$(this).attr("id")+'" readonly/>';
            html += '<td>'+$(this).attr("no")+'</td>';
            html += '<td>'+$(this).attr("nama")+'</td>';
            html += '<td>'+$(this).attr("semester")+'</td>';

        }
        else
        {
            html = '<td><input type="checkbox" no="'+$(this).attr('no')+'" nama="'+$(this).attr('nama')+'" \n\
                    semester="'+$(this).attr('semester')+'" class="check_box" /></td>';
            html += '<td>'+$(this).attr("no")+'</td>';
            html += '<td>'+$(this).attr("nama")+'</td>';
            html += '<td>'+$(this).attr("semester")+'</td>';
        }
        
        $(this).closest('tr').html(html);
        
    });
    
    $('#submit').on('click', function(event){
        event.preventDefault();
        
        //gunakan fungsi serializearray untuk auto add dengan push
        var serialize = $("#form_data").serializeArray();
        serialize.push({name: 'nim', value: '<?=$nim?>'});
        serialize.push({name: 'key', value: 'submit'});
        
        //alert($.param(serialize));
        
        if($('.check_box:checked').length > 0){
            $.ajax({
                url:"pes_mtk_opr.php",
                method:"POST",
                data:$.param(serialize),
                success:function(data)
                {
                    var url = "peserta_data.php";
                    $(location).attr('href',url);
                    //fetch_data_mtk();
                }
             })
        }
    });
})
</script>
