<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e3f2fd; /* Warna biru muda */
        }
        .header-text {
            color: #0d6efd; /* Warna biru Bootstrap */
        }
        .btn-primary-custom {
            background-color: #0d6efd; /* Warna biru Bootstrap */
            border-color: #0d6efd;
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <h2 class="text-center header-text">Data Mahasiswa</h2>
        <form class="form-inline mb-3" action="" method="get">
            <div class="form-group">
                <label for="filter" class="mr-2 header-text">Filter Alamat:</label>
                <select class="form-control mr-2" name="filter">
                    <?php
                    $q_alamat = "SELECT alamat FROM biodata_mhs GROUP BY alamat";
                    $r_alamat = $mysqli->query($q_alamat);
                    while ($data_alamat = $r_alamat->fetch_assoc()) {
                    ?>
                        <option value="<?= $data_alamat['alamat']; ?>"><?= $data_alamat['alamat']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <button class="btn btn-primary-custom">Filter</button>
        </form>

        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr style="background-color: #0d6efd; color: white;">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['filter'])) {
                    $query = "SELECT * FROM biodata_mhs WHERE alamat='$_GET[filter]'";
                } else {
                    $query = "SELECT * FROM biodata_mhs";
                }
                $result = $mysqli->query($query);
                $no = 0;
                while ($row = $result->fetch_assoc()) {
                    $no++;
                ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['alamat']; ?></td>
                        <td><?= $row['tempat_lahir']; ?></td>
                        <td><?= $row['tgl_lahir']; ?></td>
                        <td>
                            <a href="<?= 'form_edit.php?id=' . $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= 'hapus_data.php?id=' . $row['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="form_data.php" class="btn btn-primary-custom">Tambah Data</a>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>