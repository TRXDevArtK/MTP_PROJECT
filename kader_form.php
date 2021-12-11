<?php
    if(empty($_POST)){
        $conn2 = new mysqli('localhost','root','','mtk');
        $query = "SELECT *FROM form_data WHERE id = '9765'";
        $sql_run = mysqli_query($conn2, $query);
        $row = mysqli_fetch_assoc($sql_run);
        
        $judul = $row['judul'];
        $deskripsi = $row['deskripsi'];
    }
?>


<html>
    <head>
        <!--Metadata-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/jquery.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css" /> 
        <link rel="stylesheet" href="css/loading.css" />  
        <link rel="stylesheet" href="css/form.css" />  
        <script src="js/bootstrap.min.js"></script>  
        <title></title>
    </head>
    <body>
        <div class="container">  
            <div class="page-header text-center">
                <h3 style="word-wrap: break-word;"><?php echo $judul ?></h3>
                <p style="word-wrap: break-word;"><?php echo $deskripsi ?></p>
            </div>
            
            <form action="form_conf" method="post">
                
                <div class="form-all">
                    <div class="form-prehead">
                        <h4>Profil Kader</h4>      
                        <hr>
                    </div>

                    <div class="form-group">
                        <label>NIM</label>
                        <input type="number" class="form-control" name="nim" placeholder="e.g : 1700018012" 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan NIM Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="namafull" placeholder="e.g : Fulan Fulan" 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Nama Lengkap Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Nama Panggil</label>
                        <input type="text" class="form-control" name="namapanggil" placeholder="e.g : Fulan" 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Nama Panggil Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Alamat Lengkap Asal (Lahir)</label>
                        <input type="text" class="form-control" name="tempat" placeholder="e.g : Yogyakarta, Umbulharjo ..." 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Alamat Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Alamat Lengkap Domisili (Tempat Tinggal Sekarang)</label>
                        <input type="text" class="form-control" name="alamat" placeholder="e.g : Yogyakarta, Umbulharjo ..." 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Alamat Domisili Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Nomor HP/WA</label>
                        <input type="number" class="form-control" name="notelp" placeholder="e.g : 0852......" 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Nomor HP/WA Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="e.g : aku@gmail.com" 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Email Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Website / Blog</label>
                        <input type="text" class="form-control" name="web" placeholder="e.g : webaku.com ..." 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Websit / Blog Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Perguruan Tinggi</label>
                        <input type="text" class="form-control" name="universitas" placeholder="e.g : Universitas . . ." 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Perguruan Tinggi Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Prodi</label>
                        <input type="text" class="form-control" name="prodi" placeholder="e.g : Teknik Informatika ..." 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Prodi Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Hobi</label>
                        <input type="text" class="form-control" name="hobi" placeholder="e.g : Main Bola ..." 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Hobi Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Riwayat Penyakit Atau Alergi</label>
                        <input type="text" class="form-control" name="penyakit" placeholder="e.g : Alergi Kacang..., Punya Penyakit..." 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Riwayat Penyakit Atau Alergi Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Motto Hidup</label>
                        <input type="text" class="form-control" name="motto" placeholder="e.g : Saya percaya diri..." 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Motto Hidup Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>

                    <div class="form-group">
                        <label>Motivasi Mengikuti DAD</label>
                        <input type="text" class="form-control" name="motivasi" placeholder="e.g : Saya Semangat..." 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Motto Hidup Nya')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>
                    
                    <div class="form-group">
                        <label>Judul Essai (Bisa Di Kosongkan Jika Belum Ada)</label>
                        <input type="text" class="form-control" name="essai" placeholder="e.g : Pembuatan Aplikasi...">
                    </div>

                    <div class="form-group form-drop">
                        <label>Jenis Kelamin</label>
                        <select name="jk" class="form-control"
                                oninvalid="this.setCustomValidity('Silahkan Pilih Jenis Kelamin nya')"
                                            accept=""oninput="this.setCustomValidity('')" required>
                        <option value="">MOHON PILIH</option>
                        <option value="L">Laki laki</option>
                        <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group form-drop">
                        <label>Bacaan Yang Diminati</label>
                        <select name="bacaan" class="form-control"
                                oninvalid="this.setCustomValidity('Silahkan Pilih Jenis Bacaan nya')"
                                            accept=""oninput="this.setCustomValidity('')" required>
                        <option value="">MOHON PILIH</option>
                        <option value="Sosial">Sosial</option>
                        <option value="Politik">Politik</option>
                        <option value="Agama">Agama</option>
                        <option value="Keilmuan">Keilmuan</option>
                        <option value="Ekonomi">Ekonomi</option>
                        <option value="Filsafat">Filsafat</option>
                        <option value="Teknologi">Teknologi</option>
                        <option value="Sejarah">Sejarah</option>
                        </select>
                    </div>

                    <div class="form-group form-drop">
                        <label>Golongan Darah</label>
                        <select name="darah" class="form-control"
                                oninvalid="this.setCustomValidity('Silahkan Pilih Jenis Golongan Darah nya')"
                                            accept=""oninput="this.setCustomValidity('')" required>
                        <option value="">MOHON PILIH</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                        </select>
                    </div>

                    <div class="form-group form-drop">
                        <label>Fakultas</label>
                        <select name="fakultas" class="form-control"
                                oninvalid="this.setCustomValidity('Silahkan Pilih Fakultas nya')"
                                            accept=""oninput="this.setCustomValidity('')" required>
                        <option value="">MOHON PILIH</option>
                        <option value="Psikologi">Psikologi</option>
                        <option value="FAI">FAI</option>
                        <option value="FEB">FEB</option>
                        <option value="FKIP">FKIP</option>
                        <option value="Hukum">Hukum</option>
                        <option value="FSBK">FSBK</option>
                        <option value="MIPA">MIPA</option>
                        <option value="Farmasi">Farmasi</option>
                        <option value="FKM">FKM</option>
                        <option value="FTI">FTI</option>
                        <option value="Teknik (UCY)">Teknik (UCY)</option>
                        </select>
                    </div>

                    <div class="form-group form-drop">
                        <label>Komisariat</label>
                        <select name="komsat" class="form-control"
                                oninvalid="this.setCustomValidity('Silahkan Pilih Komisariat nya')"
                                            accept=""oninput="this.setCustomValidity('')" required>
                        <option value="">MOHON PILIH</option>
                        <option value="Psikologi">Psikologi</option>
                        <option value="FEB">FEB</option>
                        <option value="FAI">FAI</option>
                        <option value="FKM">FKM</option>
                        <option value="FTI">FTI</option>
                        <option value="MIPA">MIPA/JPMIPA</option>
                        <option value="Farmasi">Farmasi</option>
                        <option value="PBII">PBII</option>
                        <option value="BPP">BPP</option>
                        <option value="Hukum">Hukum</option>
                        <option value="FSBK">FSBK</option>
                        <option value="HOS Cokroaminoto">HOS Cokroaminoto</option>
                        <option value="Rasyid Ridho">Rasyid Ridho</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir (Hari-Bulan-Tahun) : </label>
                        <input type="number" class="tgl" name="hari" 
                                                oninvalid="this.setCustomValidity('Silahkan Masukkan Harinya (Dalam Angka, 1-31)')"
                                                accept=""oninput="this.setCustomValidity('')" required="require" min="1" max="31" >

                        <input type="number" class="tgl" name="bulan" 
                                              oninvalid="this.setCustomValidity('Silahkan Masukkan Harinya (Dalam Angka, 1-12)')"
                                                accept=""oninput="this.setCustomValidity('')" required="require" min="1" max="12" >

                        <input type="number" class="tgl" name="tahun" 
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
                        <input type="text" class="form-control" name="nama_ayah" placeholder="e.g : Fulan fulan..." 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Nama Ayah Mu')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>
                    
                    <div class="form-group">
                        <label>Nama Ibu</label>
                        <input type="text" class="form-control" name="nama_ibu" placeholder="e.g : Fulan fulan..." 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Nama Ibu Mu')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>
                    
                    <div class="form-group">
                        <label>Kerja Ayah</label>
                        <input type="text" class="form-control" name="kerja_ayah" placeholder="e.g : Wira Usaha..." 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Kerja Ayah Mu')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>
                    
                    <div class="form-group">
                        <label>Kerja Ibu</label>
                        <input type="text" class="form-control" name="kerja_ibu" placeholder="e.g : IRT..." 
                                            oninvalid="this.setCustomValidity('Silahkan Masukkan Kerja Ibu Mu')"
                                            accept=""oninput="this.setCustomValidity('')" required="require">
                    </div>
                    
                </div>
                
                <br>
                <input type="submit" name="submit" class="btn btn-primary center-block" value="Tambahkan / Submit">
                <br>
            </form>
        </div>
    </body>
</html>

