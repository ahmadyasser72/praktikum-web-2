<div id="top" class="row mb-3">
  <div class="col">
    <h3>Pilih Bulan dan Tahun Penggajian</h3>
  </div>
</div>
<div id="pesan" class="row mb-3">
  <div class="col">
    <?php
    include "database/connection.php";

    $selectSQL = "SELECT DISTINCT tahun FROM penggajian";
    $resultSelect = mysqli_query($connection, $selectSQL);
    if (!$resultSelect) { ?>
      <div class="alert alert-danger" role="alert">
        <?php echo mysqli_error($connection); ?>
      </div> <?php return;}

    if (mysqli_num_rows($resultSelect) == 0) { ?>
      <div class="alert alert-danger" role="alert">
        Data kosong
      </div> <?php return;}

    if (isset($_POST["lanjut_button"])) {
        $tahun = $_POST["tahun_select"];
        $bulan = $_POST["bulan_select"];

        if ($bulan == "Semua" && $tahun == "Semua") {
            $checkSQL = "SELECT * FROM penggajian";
        } elseif ($bulan == "Semua" && $tahun != "Semua") {
            $checkSQL = "SELECT * FROM penggajian WHERE tahun = $tahun";
        } elseif ($bulan != "Semua" && $tahun != "Semua") {
            $checkSQL = "SELECT * FROM penggajian WHERE tahun = $tahun AND bulan = $bulan";
        }

        $resultCheck = mysqli_query($connection, $checkSQL);
        if (mysqli_num_rows($resultSelect) == 0) { ?>
        <div class="alert alert-danger" role="alert">
          <i class="fa fa-exclamation-circle"></i>
          Data dengan tahun dan bulan tersebut masih kosong
        </div> <?php } else {echo "<meta http-equiv='refresh' content='0;url=?page=penggajian&bulan=$bulan&tahun=$tahun'>";}
    }
    ?>
  </div>
</div>
<div id="inputan" class="row mb-3">
  <div class="col">
    <form action="" method="POST">
      <div class="card px-3">
        <div class="mb-3 mt-3">
          <label for="bagian_id" class="form-label">Bulan</label>
          <select class="form-select" name="bulan_select">
            <option value="Semua" selected>Semua</option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="tahun_select" class="form-label">Tahun</label>
          <select class="form-select" name="tahun_select">
            <option value="Semua" selected>Semua</option>
            <?php while ($row = mysqli_fetch_assoc($resultSelect)) { ?>
              <option value="<?php echo $row["tahun"]; ?>"> <?php echo $row[
    "tahun"
]; ?> </option>
              <?php } ?>
          </select>
        </div>
        <div class="col mb-3">
          <button class="btn btn-success" type="submit" name="lanjut_button">
            <i class="fa fa-arrow-circle-right"></i>
            Lanjut
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
