
<?php

    include('database.php');
    
    //Panggil seluruh data kader
    $query = "SELECT nim,namafull,universitas,fakultas,periode,jk,essai FROM kader WHERE nim = '$nim'";
    $sql_run = mysqli_query($conn2,$query);
    $row = mysqli_fetch_assoc($sql_run);
    
    $nim = $row['nim'];
    $namafull = $row['namafull'];
    $universitas = $row['universitas'];
    $fakultas = $row['fakultas'];
    $periode = $row['periode'];
    $jk = $row['jk'];
    $essai = $row['essai'];
    
    //Panggil seluruh data materi sikap kader------------------------------------ START
    $u_mtk = "%_______mtk_skp";
    $query = "SHOW TABLES LIKE '$u_mtk'";
    $sql_run = mysqli_query($conn2, $query);
    
    while($row = mysqli_fetch_array($sql_run)){
        $data[] = $row[0];
    }
    
    //echo json_encode($data_chp);
    //echo json_encode($data); //Data TABEL Materi Sikap
    
    foreach($data as $data){
        $query = "select idmtk_skp.nama, $data.nilai from idmtk_skp,$data where $data.id = idmtk_skp.id and $data.nim = '$nim'";
        
        $sql_run = mysqli_query($conn2, $query);
        
        while($row = mysqli_fetch_assoc($sql_run)){
            $data_chp[] = chop($data,"_mtk_skp");
            $data_2[] = $row;
        }
    }
        
    //print_r($data_2);
    
    foreach($data_chp as $data){
        $query = "select A,B,C,D from descmtk where id = '$data'";
        
        $sql_run = mysqli_query($conn2, $query);
        
        while($row = mysqli_fetch_assoc($sql_run)){
            $data_3[] = $row;
        }
    }
    
    $desc = array();
    for($i=0;$i<count($data_3);$i++){
        if($data_2[$i]['nilai'] == 'A'){
            $desc[] = $data_3[$i]['A'];
        }
        else if($data_2[$i]['nilai'] == 'B'){
            $desc[] = $data_3[$i]['B'];
        }
        else if($data_2[$i]['nilai'] == 'C'){
            $desc[] = $data_3[$i]['C'];
        }
        else if($data_2[$i]['nilai'] == 'D'){
            $desc[] = $data_3[$i]['D'];
        }
        else if($data_2[$i]['nilai'] == ''){
            $desc[] = '';
        }
    }
    
    for($i=0;$i<count($data_3);$i++){
        $data_2[$i]['desc'] = $desc[$i];
    }
    
    //Deklarasi
    $mtk_skp = $data_2;
    
    //print_r($mtk_skp);
    //------------------------------------------------------------------------------ END
    
    //Bersihkan array yang sudah terpakai sebelumnya
    $data = array();
    $data_chp = array();
    $data_2 = array();
    $data_3 = array();
    $desc = array();
    
    //Panggil seluruh data materi kader------------------------------------ START
    $u_mtk = "%_______mtk";
    $query = "SHOW TABLES LIKE '$u_mtk'";
    $sql_run = mysqli_query($conn2, $query);
    
    while($row = mysqli_fetch_array($sql_run)){
        $data[] = $row[0];
    }
    
    foreach($data as $data){
        $query = "select idmtk.nama, $data.nilai from idmtk,$data where $data.id = idmtk.id and $data.nim = '$nim'";
        
        $sql_run = mysqli_query($conn2, $query);
        
        while($row = mysqli_fetch_assoc($sql_run)){
            $data_chp[] = chop($data,"_mtk");
            $data_2[] = $row;
        }
    }
    
    foreach($data_chp as $data){
        $query = "select A,B,C,D from descmtk where id = '$data'";
        
        $sql_run = mysqli_query($conn2, $query);
        
        while($row = mysqli_fetch_assoc($sql_run)){
            $data_3[] = $row;
        }
    }
    
    $desc = array();
    for($i=0;$i<count($data_3);$i++){
        if($data_2[$i]['nilai'] == 'A'){
            $desc[] = $data_3[$i]['A'];
        }
        else if($data_2[$i]['nilai'] == 'B'){
            $desc[] = $data_3[$i]['B'];
        }
        else if($data_2[$i]['nilai'] == 'C'){
            $desc[] = $data_3[$i]['C'];
        }
        else if($data_2[$i]['nilai'] == 'D'){
            $desc[] = $data_3[$i]['D'];
        }
        else if($data_2[$i]['nilai'] == ''){
            $desc[] = '';
        }
    }
    
    for($i=0;$i<count($data_3);$i++){
        $data_2[$i]['desc'] = $desc[$i];
    }
    
    //Deklarasi
    $mtk = $data_2;
    
    //print_r($mtk_skp);
    //------------------------------------------------------------------------------ END
    
    //Bersihkan array yang sudah terpakai sebelumnya
    $data = array();
    $data_chp = array();
    $data_2 = array();
    $data_3 = array();
    $desc = array();
    
    //DATA CATATAN
    $query = "SELECT deskripsi FROM kader_catatan WHERE nim = '$nim'";
    $sql_run = mysqli_query($conn2, $query);
    $row = mysqli_fetch_assoc($sql_run);
    
    $deskripsi = $row['deskripsi'];
    
    //DATA AKUMULASI PRESENSI
    $query = "SELECT izin,sakit,tanpa_ket FROM kader_presensi WHERE nim = '$nim'";
    $sql_run = mysqli_query($conn2, $query);
    $row = mysqli_fetch_assoc($sql_run);
    
    $izin = $row['izin'];
    $sakit = $row['sakit'];
    $tanpa_ket = $row['tanpa_ket'];
   
    //DAD-----------------------------------------
    //DATA Master Of Training
    $query = "SELECT nama,nia FROM instruktur WHERE jabatan = 'MOT'";
    $sql_run = mysqli_query($conn2, $query);
    $row = mysqli_fetch_assoc($sql_run);
    
    $nama_instruktur = $row['nama'];
    $NIA = $row['nia'];
    
    //DAD-----------------------------------------
    //DATA PC
    $query = "SELECT nia,nama FROM data_pc";
    $sql_run = mysqli_query($conn2, $query);
    
    while($row = mysqli_fetch_assoc($sql_run)){
        $data[] = $row;
    }
    
    //$abc = $row[0]['nama'];
    //$NIA = $row['nia'];
    
    //print_r($data);
    
    $nama_kader = $data[0]['nama'];
    $nba_kader = $data[0]['nia'];
    $nama_ketua = $data[1]['nama'];
    $nba_ketua = $data[1]['nia'];
    
    //https://www.malasngoding.com/membuat-format-tanggal-indonesia-dengan-php/
    function tgl_indo($tanggal){
            $bulan = array (
                    1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
            );
            $pecahkan = explode('-', $tanggal);

            // variabel pecahkan 0 = tanggal
            // variabel pecahkan 1 = bulan
            // variabel pecahkan 2 = tahun

            return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
    
    $tanggal = tgl_indo(date('Y-m-d'));

?>

<html>
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=windows-1252"/>
	<title></title>
	<meta name="generator" content="LibreOffice 6.3.4.2 (Windows)"/>
	<meta name="created" content="2017-10-20T23:41:04.964000000"/>
	<meta name="changed" content="2020-05-20T10:14:22.432000000"/>
	
	<style type="text/css">
		body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Arial"; font-size:xx-small }
		a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  } 
		a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  } 
		comment { display:none;  } 
	</style>
	
</head>

<body>
<table cellspacing="0" border="0" width="100%" style="table-layout:fixed;">
	<colgroup width="44"></colgroup>
	<colgroup width="107"></colgroup>
	<colgroup width="51"></colgroup>
	<colgroup width="119"></colgroup>
	<colgroup width="79"></colgroup>
	<colgroup width="49"></colgroup>
	<colgroup width="118"></colgroup>
	<colgroup width="30"></colgroup>
	<colgroup width="36"></colgroup>
	<tr>
		<td colspan=2 height="19" align="right" valign=middle><font color="#000000">Nama Kader</font></td>
		<td align="right" valign=middle><b><font color="#000000">:</font></b></td>
		<td align="left"><b><font color="#000000"><?php echo $namafull; ?></font></b></td>
		<td align="right"><font color="#000000">Komisariat</font></td>
		<td align="right" valign=middle><b><font color="#000000">:</font></b></td>
		<td align="left"><font color="#000000"><?php echo $jk; ?></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td colspan=2 height="19" align="right" valign=middle><font color="#000000">Nomor Induk Mahasiswa</font></td>
		<td align="right" valign=middle><b><font color="#000000">:</font></b></td>
		<td align="left" sdval="1900023225" sdnum="1033;"><font color="#000000"><?php echo $nim; ?></font></td>
		<td align="right"><font color="#000000">Prodi</font></td>
		<td align="right" valign=middle><b><font color="#000000">:</font></b></td>
		<td align="left"><font color="#000000"><?php echo $fakultas; ?></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td colspan=2 height="19" align="right" valign=middle><font color="#000000">Perguruan Tinggi</font></td>
		<td align="right" valign=middle><b><font color="#000000">:</font></b></td>
		<td align="left"><font color="#000000"><?php echo $universitas; ?></font></td>
		<td align="right"><font color="#000000">Periode</font></td>
		<td align="right" valign=middle><b><font color="#000000">:</font></b></td>
		<td align="left"><font color="#000000"><?php echo $periode; ?></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td colspan=2 height="19" align="right" valign=middle><font color="#000000">Fakultas</font></td>
		<td align="right" valign=middle><b><font color="#000000">:</font></b></td>
		<td align="left"><font color="#000000"><?php echo $fakultas; ?></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td colspan=4 height="24" align="left" valign=middle><b><font color="#000000">A. Sikap</font></b></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=9 height="27" align="center" valign=middle bgcolor="#CCCCCC"><b><font color="#000000">Deskripsi</font></b></td>
        </tr>
        <?php for($i=0;$i<count($mtk_skp);$i++){ ?>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="48" align="left" valign=middle><b><font color="#000000"><?php echo ($i+1).".".$mtk_skp[$i]['nama']; ?></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; word-break: break-all;" colspan=7 align="left" valign=middle><font color="#000000"><?php echo $mtk_skp[$i]['desc']; ?></font></td>
        </tr>
        <?php } ?>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td colspan=4 height="24" align="left" valign=middle><b><font color="#000000">B. Pengetahuan dan Keterampilan</font></b></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 height="68" align="center" valign=middle bgcolor="#CCCCCC"><b><font color="#000000">No.</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" rowspan=2 align="center" valign=middle bgcolor="#CCCCCC"><b><font color="#000000">Muatan Materi</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=7 align="center" valign=middle bgcolor="#CCCCCC"><b><font color="#000000">Pengetahuan dan Keterampilan</font></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle bgcolor="#CCCCCC"><b><font color="#000000">Nilai</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=6 align="center" valign=middle bgcolor="#CCCCCC"><b><font color="#000000">Deskripsi</font></b></td>
		</tr>
        <?php for($i=0;$i<count($mtk);$i++){ ?>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="58" align="center" valign=middle sdval="1" sdnum="1033;"><b><font color="#000000"><?php echo ($i+1); ?></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><b><font color="#000000"><?php echo $mtk[$i]['nama']; ?></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><b><font color="#000000"><?php echo $mtk[$i]['nilai']; ?></font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; word-break: break-all;" colspan=6 align="center" valign=middle><font color="#000000"><?php echo $mtk[$i]['desc']; ?></font></td>
        </tr>
        <?php } ?>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td colspan=4 height="24" align="left" valign=middle><b><font color="#000000">C. Catatan untuk komisariat</font></b></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=9 height="33" align="center" valign=middle bgcolor="#CCCCCC"><b><font color="#000000">Deskripsi</font></b></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; word-break: break-all;" colspan=9 height="39" align="center" valign=middle bgcolor="#CCCCCC"><font color="#000000"><?php echo $deskripsi ?></font></td>
		</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td colspan=4 height="17" align="left" valign=middle><b><font color="#000000">D. Judul Essai</font></b></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; word-break: break-all;" colspan=9 height="24" align="center" valign=middle bgcolor="#CCCCCC"><font color="#000000"><?php echo $essai ?></font></td>
		</tr>
	<tr>
		<td height="29" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="24" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td colspan=3 align="left" valign=middle><b><font color="#000000">l. Ketidakhadiran</font></b></td>
		</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="left"><font color="#000000">Sakit</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="center" valign=middle><font color="#000000">:</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left"><font color="#000000"><?php echo $sakit ?></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="left"><font color="#000000">Izin</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="center" valign=middle><font color="#000000">:</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left"><font color="#000000"><?php echo $izin ?></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="left"><font color="#000000">Tanpa Keterangan</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="center" valign=middle><font color="#000000">:</font></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000" align="left"><font color="#000000"><?php echo $tanpa_ket ?></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td colspan=1 align="center" valign=middle><font color="#000000">Yogyakarta, <?php echo $tanggal; ?></font></td>
		</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="right"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td colspan=2 align="center" valign=middle><font color="#000000">Mengetahui</font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="center"><font color="#000000">Bidang Kader</font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td colspan=2 align="center" valign=middle><font color="#000000">Ketua PC Djazman</font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="center"><font color="#000000">Master of Training</font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="center"><font color="#000000"><?php echo $nama_kader; ?></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td colspan=2 align="center" valign=middle><font color="#000000"><?php echo $nama_ketua; ?></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="center"><font color="#000000"><?php echo $nama_instruktur; ?></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td height="17" align="left"><font color="#000000"><br></font></td>
		<td align="center"><font color="#000000">NIA : <?php echo $nba_kader; ?></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td colspan=2 align="center" valign=middle><font color="#000000">NIA : <?php echo $nba_ketua; ?></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="center"><font color="#000000">NIA : <?php echo $NIA; ?></font></td>
		<td align="left"><font color="#000000"><br></font></td>
		<td align="left"><font color="#000000"><br></font></td>
	</tr>
</table>
<!-- ************************************************************************** -->
</body>

</html>
