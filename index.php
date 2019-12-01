<?php require('func.php');?>
<html>
<head>
    <title>HASH with PHP</title>
    <link rel="shortcut icon" href="favicon.png">
    <style>
        body{
            font-family:arial;
            margin-top:25px;
            margin-left:25px;
            margin-right:25px;
        }
        thead>tr{
            background-color: black;
            color:white;
            text-transform:uppercase;
            font-weight: bold;
            text-align:center;
        }
        td{
            padding: 10px;
        }
        .alert-light{
            text-align: justify !important;            
        }
        .blockquote{
            font-size: 16px !important;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/sticky-footer-navbar.css">
</head>
<body>
    <div class="container"><br>
        <div class="display-4"><img src="favicon.png" height="75" /> HASH <small><sub>with PHP</sub></small></div>
        <hr><br>

        <?php if(!isset($_GET['submit'])){ ?>
            <form method="GET">
                <div style="margin-bottom:15px;">
                    <div>Pesan Teks</div>
                    <textarea rows="8" cols="80" name="message" class="form-control" required="true"></textarea>
                </div>
                <div style="margin-bottom:15px;">
                    <div>Hash</div>
                    <select name="hash" class="form-control" required="true">
                        <option value="MD5">MD5</option>
                        <option value="SHA1">SHA1</option>
                        <option value="SHA224">SHA224</option>
                        <option value="SHA256">SHA256</option>
                        <option value="SHA512">SHA512</option>
                    </select>
                </div>
                <div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Eksekusi">
                </div>
            </form>
        <?php } else { $enc = _ch($_GET['hash'], $_GET['message']); ?>
            <div class="row">
                <div class="col-6">
                    <div>
                        <p><b>PESAN TEKS</b></p>
                        <p><code><?=$_GET['message'];?></code></p>
                    </div>
                    <div>
                        <p><b>HASIL ENKRIPSI DARI <code><?=$_GET['hash'];?></code> ADALAH</b></p>
                        <p><code><?=$enc;?></code></p>
                    </div>
                    <div>
                        <p><b>PANJANG ENKRIPSI</b></p>
                        <p><code><?=strlen($enc);?> karakter</code></p>
                    </div>
                    <form method="POST">
                        <div style="margin-bottom:15px;">
                            <div>Pesan Teks</div>
                            <textarea rows="8" cols="80" name="message" class="form-control" required="true"><?=isset($_POST['message']) ? $_POST['message'] : '';?></textarea>
                        </div>
                        <div>
                            <input type="submit" class="btn btn-success" name="try" value="Uji Coba"> &nbsp;
                            <a href="/hash" class="btn btn-default">Coba Teks Yang Lain</a>
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <div class="alert alert-light" role="alert">
                        <blockquote class="blockquote">
                            HASH memiliki sifat-sifat sebagai berikut :
                            <ul>
                                <li>Inputan yang sama akan menghasilkan output yang sama.</li>
                                <li>Sedikit perubahan pada inputan akan menghasilkan perubahan yang sangat besar pada hasil outputnya.</li>
                                <li>Tidak dapat dikembalikan ke nilai awal.</li>
                            </ul>
                        </blockquote>
                        <blockquote class="blockquote">HASH bisa disebut dengan One Way Function atau bisa juga dikatakan enkripsi yang satu arah. Jadi kita dapat melakukan encript tapi tidak dapat melakukan decript.</blockquote>
                        <blockquote class="blockquote">HASH ditujukan untuk menjaga <b>integritas</b> suatu data. HASH tidak dapat di decript sehingga pengguna juga harus melakukan hashing untuk mengetahui apakah <i>data awal</i> berbeda dengan <i>data saat</i> ini. Jadi cara kerjanya lebih pada mencocokan antara <i>hasil awal hashing</i> dengan <i>hasil akhir hashing</i>.</blockquote>
                    </div>
                    <div class="alert alert-dark" role="alert">
                        <blockquote class="blockquote">Untuk membuktikannya kamu bisa melakukan hasing dengan mengisi inputan disamping. Pada bagian ini Data Awalnya Adalah <code><?=$_GET['message'];?></code> dengan output <code><?=$enc;?></code> dan panjang <code><?=strlen($enc);?> karakter</code> dan HASH yang digunakan adalah <code><?=$_GET['hash'];?></code>.</blockquote>
                    </div>
                </div>
            </div>            
            <?php if(isset($_POST['try'])){ ?>
                <?php $enc_2 = _ch($_GET['hash'], $_POST['message']); ?>
                <div class="modal fade" id="result-x" role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Hasil Dictionary</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-header">Data Awal</div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            Pesan teksnya adalah <code><?=$_POST['message'];?></code>, di encript menggunakan <code><?=$_GET['hash'];?></code>. Hasil enkripsinya adalah <code><?=$enc;?></code> dan memiliki panjang <code><?=strlen($enc);?> karakter</code>
                                        </p>
                                    </div>
                                </div>
                                <br>

                                <div class="card">
                                    <div class="card-header">Data Saat Ini</div>
                                    <div class="card-body">
                                        <p class="card-text">
                                            Pesan teksnya adalah <code><?=$_GET['message'];?></code>, di encript menggunakan <code><?=$_GET['hash'];?></code>. Hasil enkripsinya adalah <code><?=$enc_2;?></code> dan memiliki panjang <code><?=strlen($enc_2);?> karakter</code>
                                        </p>
                                    </div>
                                </div>
                                <br>

                                <?php if($enc === $enc_2){ ?>
                                    <div class="alert alert-success" role="alert">Data Cocok</div>
                                <?php } else { ?>
                                    <div class="alert alert-danger" role="alert">Data Tidak Cocok</div>
                                <?php } ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>

    <footer class="footer bg-dark">
        <div class="container">
            <span class="text-white">development by <a href="https://www.kang-cahya.com/" rel="dofollow">kang-cahya.com</a> || download full source code on <a href="https://github.com/dyazincahya/hash-with-php" target="_blank">github.com/dyazincahya/hash-with-php</a></span>
        </div>
    </footer>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <?php if(isset($_POST['try'])){ ?>
        <script type="text/javascript">
            $( document ).ready(function() {
                $('#result-x').modal('show');
            });
        </script>
    <?php } ?>
</body>
</html>