<?php
include "config.php";

// Simpan / Create Data
if(isset($_POST['tombolsimpan'])) {
    $nis = $_POST['tNIS'];
    $nama = $_POST['tNAMA'];
    $jk = ($_POST['tJK'] == 'L') ? 'Laki-laki' : 'Perempuan';
    $rombel = $_POST['tRombel'];
    $jurusan = $_POST['tJurusan'];

    $masuk = mysqli_query($konek, "INSERT INTO siswa (NIS, NAMA, JK, Rombel, Jurusan) VALUES ('$nis', '$nama', '$jk', '$rombel', '$jurusan')");

    if($masuk) {
        echo "<script>alert('Data berhasil disimpan'); document.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}

// Hapus Data
if(isset($_GET['delete'])) {
    $hapus = mysqli_query($konek, "DELETE FROM siswa WHERE NIS = '{$_GET['delete']}'");
    if($hapus) {
        echo "<script>alert('Data berhasil dihapus'); document.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}

// Edit Data
if(isset($_GET['nis'])) {
    $getNIS = $_GET['nis'];
    $edit = mysqli_query($konek, "SELECT * FROM siswa WHERE NIS = '$getNIS'");
    $summon = mysqli_fetch_array($edit);
}

// Update Data
if(isset($_POST['tomboledit'])) {
    $nis = $_POST['tNIS'];
    $nama = $_POST['tNAMA'];
    $jk = ($_POST['tJK'] == 'L') ? 'Laki-laki' : 'Perempuan';
    $rombel = $_POST['tRombel'];
    $jurusan = $_POST['tJurusan'];

    $update = mysqli_query($konek, "UPDATE siswa SET NAMA = '$nama', JK = '$jk', Rombel = '$rombel', Jurusan = '$jurusan' WHERE NIS = '$nis'");

    if($update) {
        echo "<script>alert('Data berhasil diperbarui'); document.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data');</script>";
    }
}
?>

<form action="" method="post">
    <table>
        <tr>
            <td> NIS </td>
            <td><input type="text" name="tNIS" value="<?php echo @$summon['NIS']; ?>"/></td>
        </tr>
        <tr>
            <td> NAMA </td>
            <td><input type="text" name="tNAMA" value="<?php echo @$summon['NAMA']; ?>"/></td>
        </tr>
        <tr>
            <td> JK </td>
            <td>
                <input type="radio" name="tJK" value="L" <?php if(@$summon['JK'] == 'Laki-laki') echo 'checked'; ?>>Laki-laki
                <input type="radio" name="tJK" value="P" <?php if(@$summon['JK'] == 'Perempuan') echo 'checked'; ?>>Perempuan
            </td>
        </tr>
        <tr>
            <td> Rombel </td>
            <td><input type="text" name="tRombel" value="<?php echo @$summon['Rombel']; ?>"/></td>
        </tr>
        <tr>
            <td> Jurusan </td>
            <td><input type="text" name="tJurusan" value="<?php echo @$summon['Jurusan']; ?>"/></td>
        </tr>
        <tr>
            <td bgcolor="grey" colspan="2" align="right">
                <input type="submit" name="tombolsimpan" value="Simpan">
                <input type="submit" name="tomboledit" value="Edit">
            </td>
        </tr>
    </table>
</form>

<?php
    include("config.php");
?>

<style>
    table {
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            box-shadow: inset 2px 2px 2px 2px grey, 2px 2px 2px 2px black;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color:green;
            color:green;
        }
</style>

<table>
    <tr>
        <td align="center" bgcolor="yellow">NIS</td>
        <td align="center" bgcolor="green">Nama</td>
        <td align="center" bgcolor="green">Jenis Kelamin</td>
        <td align="center" bgcolor="green">Rombel</td>
        <td align="center" bgcolor="green">Jurusan</td>
        <td align="center" colspan="2" bgcolor="green">Action</td>
    </tr>
    <?php
        $panggil = mysqli_query($konek, "SELECT * FROM siswa ORDER BY Jurusan ASC");
        while($data = mysqli_fetch_array($panggil)){
    ?>
    <tr>
        <td><?php echo $data['NIS']; ?></td>
        <td><?php echo $data['NAMA']; ?></td>
        <td><?php echo $data['JK']; ?></td>
        <td><?php echo $data['Rombel']; ?></td>
        <td><?php echo $data['Jurusan']; ?></td>
        <td><a href="?delete=<?php echo $data['NIS']; ?>"><img src="trash.png" alt="" height="30" width="30"></a></td>
        <td><a href="?nis=<?php echo $data['NIS']; ?>"><img src="editikon.png" alt="" height="30" width="30"></a></td>
    </tr>
    <?php   
        }
    ?>
</table>