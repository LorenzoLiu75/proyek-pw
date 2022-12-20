<?php 
  include 'includes/config.php';
  session_start();
  if(!isset($_SESSION["user_username"])) {
    header("Location: index.php");
    die();
  }

  $sql = null;
  $msg = "";

  if(isset($_POST['addPegawai'])) {

    $id = $_POST['idPegawai'];
    $name = $_POST['namaPegawai'];
    $date = $_POST['tanggal'];
    $jk = $_POST['jk'];
    $jabatan = $_POST['jabatan'];
    $divisi = $_POST['divisi'];
    

    $sql = "INSERT INTO pegawai (id_pegawai, nama_pegawai, tgl_lahir, jenis_kelamin, jabatan, divisi) VALUES ('$id', '$name', '$date', '$jk', '$jabatan', '$divisi')";

    $result = mysqli_query($conn, $sql);

    if($result) {
      $msg = "<div class='alert'>Add pegawai is succeed</div>";
      header("refresh:2; url=dashboard.php");
    }
    else {
      $msg = "<div class='alert alert-danger'>Add pegawai is failed</div>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/dashboard.css" />
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Rubik:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Bootstrap's css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <!-- Bootstrap's js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous" defer></script>
    <!-- font awesome's kit code -->
		<script
			src="https://kit.fontawesome.com/bc44dd7ee2.js"
			crossorigin="anonymous"
			defer
		></script>
    <!-- Title -->
    <title>Beyond Reality</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <div class="card bg-white rounded-border shadow">
            <div class="card-header">
              <h4>Add Pegawai</h4>
            </div>
            <div class="card-body p-4">
              <?php echo $msg; ?>
              <form action="" method="post">
                <div class="mb-3">
                  <label for="id" class="form-label">ID</label>
                  <input type="text" class="form-control" name="idPegawai">
                </div>
                <div class="mb-3">
                  <label for="id" class="form-label">Nama Pegawai</label>
                  <input type="text" class="form-control" name="namaPegawai" id="nama">
                </div>
                <div class="mb-3">
                  <label for="id" class="form-label">Tanggal Lahir</label>
                  <input type="date" class="form-control" name="tanggal" id="tanggal">
                </div>
                <div class="mb-3">
                  <label for="id" class="form-label">Jenis Kelamin</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="jk" id="jk" value="Pria">
                    <label class="form-check-label" for="flexRadioDefault1">
                      Pria
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="jk" id="jk" value="Wanita">
                    <label class="form-check-label" for="flexRadioDefault1">
                      Wanita
                    </label>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="id" class="form-label">Jabatan</label>
                  <select id="jabatan" name="jabatan" class="form-select" aria-label="Default select example">
                    <option selected>Select Jabatan</option>
                    <?php 
                      $queryJabatan = mysqli_query($conn, "SELECT * FROM jabatan");

                      while($jabatan = mysqli_fetch_array($queryJabatan)) {
                        echo "<option value='$jabatan[nama_jabatan]'>$jabatan[nama_jabatan]</option>";
                      }
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="id" class="form-label">Divisi</label>
                  <select id="divisi" name="divisi" class="form-select" aria-label="Default select example">
                    <option selected>Select Divisi</option>
                    <?php 
                      $queryDivisi = mysqli_query($conn, "SELECT * FROM divisi");

                      while($divisi = mysqli_fetch_array($queryDivisi)) {
                        echo "<option value='$divisi[nama_divisi]'>$divisi[nama_divisi]</option>";
                      }
                    ?>
                  </select>
                </div>
                <button type="submit" name="addPegawai" class="btn btn-primary">Add</button>
                <button class="btn btn-danger" onclick="history.back()" >Cancel</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
