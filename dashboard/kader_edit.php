<?php
    ob_start();
    include_once "database.php";
    
    $warning = 0;
    $notf = "";

    if(isset($_POST['edit']) && !empty($_POST['nim'])){

        $nim = $_POST['nim'];
        $komsat = $_POST['komsat'];
        $namafull = $_POST['namafull'];
        $namapanggil = $_POST['namapanggil'];
        $notelp = $_POST['notelp'];
        $tempat = $_POST['tempat'];
        $email = $_POST['email'];
        $web = $_POST['web'];
        $hobi = $_POST['hobi'];
        $motto = $_POST['motto'];
        $motivasi = $_POST['motivasi'];
        $bacaan = $_POST['bacaan'];
        $jk = $_POST['jk'];
        $tanggal = $_POST['tanggal'];
        $penyakit = $_POST['penyakit'];
        $darah = $_POST['darah'];
        $prodi = $_POST['prodi'];
        $fakultas = $_POST['fakultas'];
        $universitas = $_POST['universitas'];
        $alamat = $_POST['alamat'];
        $essai = $_POST['essai'];
        $periode = $_POST['periode'];
        
        //Tanggal
        $date = explode('-', $tanggal);
        
        $tahun = $date[2];
        $bulan = $date[1];
        $hari = $date[0];

        //Data Ortu
        $nama_ayah = $_POST['nama_ayah'];
        $nama_ibu = $_POST['nama_ibu'];
        $kerja_ayah = $_POST['kerja_ayah'];
        $kerja_ibu = $_POST['kerja_ibu'];

        if($jk == "Perempuan"){
            $jk = "P";
        }
        else if($jk == "Laki-laki"){
            $jk = "L";
        }

    }

    if(isset($_POST['submit'])){ //check if form was submitted
        
        $nim = $_POST['nim'];
        $nim = $_POST['nim'];
        $komsat = $_POST['komsat'];
        $namafull = $_POST['namafull'];
        $namapanggil = $_POST['namapanggil'];
        $notelp = $_POST['notelp'];
        $tempat = $_POST['tempat'];
        $email = $_POST['email'];
        $web = $_POST['web'];
        $hobi = $_POST['hobi'];
        $motto = $_POST['motto'];
        $motivasi = $_POST['motivasi'];
        $bacaan = $_POST['bacaan'];
        $jk = $_POST['jk'];
        $tanggal = $_POST['tanggal'];
        $penyakit = $_POST['penyakit'];
        $darah = $_POST['darah'];
        $prodi = $_POST['prodi'];
        $fakultas = $_POST['fakultas'];
        $universitas = $_POST['universitas'];
        $alamat = $_POST['alamat'];
        $essai = $_POST['essai'];
        $periode = $_POST['periode'];

        //Tanggal
        $hari = $_POST['hari'];
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];

        $tanggal = $tahun."-".$bulan."-".$hari;

        //Data Ortu
        $nama_ayah = $_POST['nama_ayah'];
        $nama_ibu = $_POST['nama_ibu'];
        $kerja_ayah = $_POST['kerja_ayah'];
        $kerja_ibu = $_POST['kerja_ibu'];

        //Edit data kader
        $query = "UPDATE `kader` SET `komsat` = '$komsat', `namafull` = '$namafull', `namapanggil` = '$namapanggil', "
                . "`notelp` = '$notelp', `tempat` = '$tempat', `email` = '$email', `web` = '$web', `hobi` = '$hobi', `motto` = '$motto', "
                . "`motivasi` = '$motivasi', `bacaan` = '$bacaan', `tanggal` = '$tanggal', `penyakit` = '$penyakit', "
                . "`darah` = '$darah', `prodi` = '$prodi', `fakultas` = '$fakultas', `universitas` = '$universitas', `alamat` = '$alamat', "
                . "`nama_ayah` = '$nama_ayah', `nama_ibu` = '$nama_ibu', `kerja_ayah` = '$kerja_ayah', `kerja_ibu` = '$kerja_ibu', "
                . "`essai` = '$essai', `periode` = '$periode' WHERE `kader`.`nim` = $nim";
        $sql_run = mysqli_query($conn2, $query);

        //Test untuk sql berjalan
        if($sql_run){
            $_SESSION['nim'] = $nim;
            header("location:kader_data");
            exit();
        }
        else{
            $warning = 2;
            $notf = "Maaf ada kesalahan data, silahkan coba lagi";
        }
    }
?>

<html>
    <head>
        <!--Metadata-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../js/jquery.min.js"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css" /> 
        <link rel="stylesheet" href="../css/loading.css" />  
        <link rel="stylesheet" href="../css/form.css" />  
        <script src="../js/bootstrap.min.js"></script>  
        <title></title>
    </head>
    <body>
        <?php include("nav.html"); ?>
        <div class="container">
            <?php
                if($warning == 0){
                    //do nothing
                }
                else if($warning == 1){
                    echo "<p class='test' style='background-color: #66ff66;'>$notf</p>";
                }
                else if($warning == 2 || $warning == 3){
                    echo "<p class='test' style='background-color: #ff6666;'>$notf</p>";
                }
            ?>
            <div class="page-header text-center">
                <h3>Form Data Kader</h3>      
            </div>
            
            <form action="kader_edit" method="post">
                
                <div class="form-all">
                    <div class="form-prehead">
                        <h4>Profil Kader</h4>      
                        <hr>
                    </div>

                    <div class="form-group">
                        <label>NIM (Tidak Bisa Diedit)</label>
                        <input type="number" class="form-control" name="nim" placeholder="e.g : 1700018012" value="<?php echo $nim; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan NIM Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require" readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="namafull" placeholder="e.g : Fulan Fulan" value="<?php echo $namafull; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Nama Lengkap Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Nama Panggil</label>
                        <input type="text" class="form-control" name="namapanggil" placeholder="e.g : Fulan" value="<?php echo $namapanggil; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Nama Panggil Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Alamat Lengkap Asal (Lahir)</label>
                        <input type="text" class="form-control" name="tempat" placeholder="e.g : Yogyakarta, Umbulharjo ..." value="<?php echo $tempat; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Alamat Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Alamat Lengkap Domisili (Tempat Tinggal Sekarang)</label>
                        <input type="text" class="form-control" name="alamat" placeholder="e.g : Yogyakarta, Umbulharjo ..." value="<?php echo $alamat; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Alamat Domisili Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Nomor HP/WA</label>
                        <input type="number" class="form-control" name="notelp" placeholder="e.g : 0852......" value="<?php echo $notelp; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Nomor HP/WA Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="e.g : aku@gmail.com" value="<?php echo $email; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Email Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Website / Blog</label>
                        <input type="text" class="form-control" name="web" placeholder="e.g : webaku.com ..." value="<?php echo $web; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Websit / Blog Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Perguruan Tinggi</label>
                        <input type="text" class="form-control" name="universitas" placeholder="e.g : Universitas . . ." value="<?php echo $universitas; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Perguruan Tinggi Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Prodi</label>
                        <input type="text" class="form-control" name="prodi" placeholder="e.g : Teknik Informatika ..." value="<?php echo $prodi; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Prodi Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Hobi</label>
                        <input type="text" class="form-control" name="hobi" placeholder="e.g : Main Bola ..." value="<?php echo $hobi; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Hobi Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Riwayat Penyakit Atau Alergi</label>
                        <input type="text" class="form-control" name="penyakit" placeholder="e.g : Alergi Kacang..., Punya Penyakit..." value="<?php echo $penyakit; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Riwayat Penyakit Atau Alergi Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Motto Hidup</label>
                        <input type="text" class="form-control" name="motto" placeholder="e.g : Saya percaya diri..." value="<?php echo $motto; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Motto Hidup Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Motivasi Mengikuti DAD</label>
                        <input type="text" class="form-control" name="motivasi" placeholder="e.g : Saya Semangat..."  value="<?php echo $motivasi; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Motto Hidup Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>
                    
                    <div class="form-group">
                        <label>Judul Essai (Bisa Di Kosongkan Jika Belum Ada)</label>
                        <input type="text" class="form-control" name="essai" placeholder="e.g : Pembuatan Aplikasi..." value="<?php echo $essai; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label>Periode</label>
                        <input type="number" class="form-control" name="periode" placeholder="e.g : 2012/2020/..." value="<?php echo $periode; ?>">
                    </div>

                    <div class="form-group form-drop">
                        <label>Jenis Kelamin</label>
                        <select name="jk" class="form-control"
                                oninvalid="this.setCustomValidity('Silahkan Pilih Jenis Kelamin nya')"
                                            accept=""oninput="this.setCustomValidity('')" required>
                        <option value="">MOHON PILIH</option>
                        <option value="L" <?php if($jk == 'L'){echo "selected"; }?>>Laki laki</option>
                        <option value="P" <?php if($jk == 'L'){echo "selected"; }?>>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group form-drop">
                        <label>Bacaan Yang Diminati</label>
                        <select name="bacaan" class="form-control"
                                oninvalid="this.setCustomValidity('Silahkan Pilih Jenis Bacaan nya')"
                                            accept=""oninput="this.setCustomValidity('')" required>
                        <option value="">MOHON PILIH</option>
                        <option value="Sosial" <?php if($bacaan == 'Sosial'){echo "selected"; }?>>Sosial</option>
                        <option value="Politik" <?php if($bacaan == 'Politik'){echo "selected"; }?>>Politik</option>
                        <option value="Agama" <?php if($bacaan == 'Agama'){echo "selected"; }?>>Agama</option>
                        <option value="Keilmuan" <?php if($bacaan == 'Keilmuan'){echo "selected"; }?>>Keilmuan</option>
                        <option value="Ekonomi" <?php if($bacaan == 'Ekonomi'){echo "selected"; }?>>Ekonomi</option>
                        <option value="Filsafat" <?php if($bacaan == 'Filsaft'){echo "selected"; }?>>Filsafat</option>
                        <option value="Teknologi" <?php if($bacaan == 'Teknologi'){echo "selected"; }?>>Teknologi</option>
                        <option value="Sejarah" <?php if($bacaan == 'Sejarah'){echo "selected"; }?>>Sejarah</option>
                        </select>
                    </div>

                    <div class="form-group form-drop">
                        <label>Golongan Darah</label>
                        <select name="darah" class="form-control"
                                oninvalid="this.setCustomValidity('Silahkan Pilih Jenis Golongan Darah nya')"
                                            accept=""oninput="this.setCustomValidity('')" required>
                        <option value="">MOHON PILIH</option>
                        <option value="A" <?php if($darah == 'A'){echo "selected"; }?>>A</option>
                        <option value="B" <?php if($darah == 'B'){echo "selected"; }?>>B</option>
                        <option value="AB" <?php if($darah == 'AB'){echo "selected"; }?>>AB</option>
                        <option value="O" <?php if($darah == 'O'){echo "selected"; }?>>O</option>
                        </select>
                    </div>

                    <div class="form-group form-drop">
                        <label>Fakultas</label>
                        <select name="fakultas" class="form-control"
                                oninvalid="this.setCustomValidity('Silahkan Pilih Fakultas nya')"
                                            accept=""oninput="this.setCustomValidity('')" required>
                        <option value="">MOHON PILIH</option>
                        <option value="Psikologi" <?php if($fakultas == 'Psikologi'){echo "selected"; }?>>Psikologi</option>
                        <option value="FAI" <?php if($fakultas == 'FAI'){echo "selected"; }?>>FAI</option>
                        <option value="FEB" <?php if($fakultas == 'FEB'){echo "selected"; }?>>FEB</option>
                        <option value="FKIP" <?php if($fakultas == 'FKIP'){echo "selected"; }?>>FKIP</option>
                        <option value="Hukum" <?php if($fakultas == 'Hukum'){echo "selected"; }?>>Hukum</option>
                        <option value="FSBK" <?php if($fakultas == 'FSBK'){echo "selected"; }?>>FSBK</option>
                        <option value="MIPA" <?php if($fakultas == 'MIPA'){echo "selected"; }?>>MIPA</option>
                        <option value="Farmasi" <?php if($fakultas == 'Farmasi'){echo "selected"; }?>>Farmasi</option>
                        <option value="FKM" <?php if($fakultas == 'FKM'){echo "selected"; }?>>FKM</option>
                        <option value="FTI" <?php if($fakultas == 'FTI'){echo "selected"; }?>>FTI</option>
                        <option value="Teknik UCY" <?php if($fakultas == 'Teknik (UCY)'){echo "selected"; }?>>Teknik (UCY)</option>
                        </select>
                    </div>

                    <div class="form-group form-drop">
                        <label>Komisariat</label>
                        <select name="komsat" class="form-control"
                                oninvalid="this.setCustomValidity('Silahkan Pilih Komisariat nya')"
                                            accept=""oninput="this.setCustomValidity('')" required>
                        <option value="">MOHON PILIH</option>
                        <option value="Psikologi" <?php if($komsat == 'Psikologi'){echo "selected"; }?>>Psikologi</option>
                        <option value="FEB" <?php if($komsat == 'FEB'){echo "selected"; }?>>FEB</option>
                        <option value="FAI" <?php if($komsat == 'FAI'){echo "selected"; }?>>FAI</option>
                        <option value="FKM" <?php if($komsat == 'FKM'){echo "selected"; }?>>FKM</option>
                        <option value="FTI" <?php if($komsat == 'FTI'){echo "selected"; }?>>FTI</option>
                        <option value="MIPA" <?php if($komsat == 'MIPA'){echo "selected"; }?>>MIPA/JPMIPA</option>
                        <option value="Farmasi" <?php if($komsat == 'Farmasi'){echo "selected"; }?>>Farmasi</option>
                        <option value="PBII" <?php if($komsat == 'PBII'){echo "selected"; }?>>PBII</option>
                        <option value="BPP" <?php if($komsat == 'BPP'){echo "selected"; }?>>BPP</option>
                        <option value="Hukum" <?php if($komsat == 'Hukum'){echo "selected"; }?>>Hukum</option>
                        <option value="FSBK" <?php if($komsat == 'FSBK'){echo "selected"; }?>>FSBK</option>
                        <option value="HOS Cokroaminoto" <?php if($komsat == 'HOS Cokroaminoto'){echo "selected"; }?>>HOS Cokroaminoto</option>
                        <option value="Rasyid Ridho" <?php if($komsat == 'Rasyid Ridho'){echo "selected"; }?>>Rasyid Ridho</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir (Hari-Bulan-Tahun) : </label>
                        <input type="number" class="tgl" name="hari" value="<?php echo $hari; ?>"
                                                oninvalid="this.setCustomValidity('Silahkan Masukkan Harinya (Dalam Angka, 1-31)')"
                                                accept=""oninput="this.setCustomValidity('')" required="require" min="1" max="31" >

                        <input type="number" class="tgl" name="bulan" value="<?php echo $bulan; ?>"
                                              oninvalid="this.setCustomValidity('Silahkan Masukkan Harinya (Dalam Angka, 1-12)')"
                                                accept=""oninput="this.setCustomValidity('')" required="require" min="1" max="12" >

                        <input type="number" class="tgl" name="tahun" value="<?php echo $tahun; ?>"
                                              oninvalid="this.setCustomValidity('Silahkan Masukkan Tahunnya (Dalam Angka, 1800-3000 )')"
                                                accept=""oninput="this.setCustomValidity('')" required="require" min="1800" max="3000" >
                    </div>
                </div>
                
                <br>
                
                <div class="form-all">
                    <div class="form-prehead">
                        <h4>Data Orang Tua Kader</h4>      
                        <hr>
                    </div>
                    
                    <div class="form-group">
                        <label>Nama Ayah</label>
                        <input type="text" class="form-control" name="nama_ayah" placeholder="e.g : Fulan fulan..." value="<?php echo $nama_ayah; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Nama Ayah Mu')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>
                    
                    <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="text" class="form-control" name="nama_ibu" placeholder="e.g : Fulan fulan..." value="<?php echo $nama_ibu; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Nama Ibu Mu')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>
                    
                    <div class="form-group">
                        <label>Kerja Ayah</label>
                        <input type="text" class="form-control" name="kerja_ayah" placeholder="e.g : Wira Usaha..." value="<?php echo $kerja_ayah; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Kerja Ayah Mu')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>
                    
                    <div class="form-group">
                        <label>Kerja Ibu</label>
                        <input type="text" class="form-control" name="kerja_ibu" placeholder="e.g : IRT..." value="<?php echo $kerja_ibu; ?>"
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Kerja Ibu Mu')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>
                    
                </div>
                
                <br>
                <input type="submit" name="submit" class="btn btn-primary center-block" value="Update / Submit">
                <br>
            </form>
        </div>
    </body>
</html>





