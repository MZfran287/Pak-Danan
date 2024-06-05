<!-- proses menampilkan data hasil konsultasi -->
<?php 
// mengambil id dari parameter
$idkonsultasi=$_GET['idkonsultasi'];

$sql = "SELECT * FROM konsultasi WHERE idkonsultasi='$idkonsultasi'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!-- tampilan halaman hasil konsultasi -->
<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Hasil Konsultasi</strong></div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Nama Pasien</label>
                            <input type="text" class="form-control" value="<?php echo $row['nama'] ?>" name="nama" readonly>
                        </div>
                        
                        <!-- tabel gejala-gejala -->
                        <label for="">Gejala-Gejala Penyakit Yang Dipulih:</label>
                        <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="40px">No.</th>
                            <th width="700px">Nama Gejala</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no=1;
                        "SELECT detail_konsultasi.idkonsultasi,detail_konsultasi.idgejala,gejala.nmgejala
                        FROM detail_koonsultasi INNER JOIN gejala 
                        ON detail_konsultasi.idgejala=gejala.idgejala WHERE idkonsultasi='$idkonsultasi'";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo isset($row['nmgejala']) ? htmlspecialchars($row['nmgejala']) : 'Data tidak tersedia'; ?></td>
                        </tr>
                    <?php       
                        }
                    ?>
                        </tbody>
                        </table>

                        <!-- hasil konsultasi penyakitnya -->
                        <label for="">Hasil Konsultasi Penyakit:</label>
                        <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="40px">No.</th>
                            <th width="700px">Nama Penyakit</th>
                            <th width="700px">Persentase</th>
                            <th width="700px">Solusi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no=1;
                        "SELECT detail_ penyakit.idkonsultasi,detail_penyakit.idpenyakit,penyakit.nmpenyakit,
                                penyakit.solusi,detail_penyakit.persentase
                        FROM detail_penyakit INNER JOIN penyakit 
                        ON detail_penyakit.idpenyakit=penyakit.idpenyakit WHERE idkonsultasi='$idkonsultasi'";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo isset($row['nmpenyakit']) ? htmlspecialchars($row['nmpenyakit']) : ''; ?></td>
                            <td><?php echo isset($row['persentase']) ? htmlspecialchars($row['persentase']) : ''; ?></td>
                            <td><?php echo isset($row['solusi']) ? htmlspecialchars($row['solusi']) : ''; ?></td>
                        </tr>
                    <?php       
                        }
                        $conn->close();
                    ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>