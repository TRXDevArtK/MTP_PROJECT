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
                'key':'load'
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
        
        if($('.check_box:checked').length > 0)
        {
            $.ajax({
                url:"peserta_data_opr.php",
                method:"POST",
                data:$.param(serialize),
                error: function (xhr, status) {
                    alert(JSON.stringify(xhr));
                },
                success:function(data)
                {
                    fetch_data_perpeserta();
                }
             })
        }
    });
    
})