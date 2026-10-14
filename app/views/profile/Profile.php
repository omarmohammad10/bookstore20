<?php
require_once __DIR__ . "/components/functions.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | <?= ucfirst(auth('role')) ?></title>
  <link rel="stylesheet" href="<?= asset("css/all.min.css") ?>">
  <link rel="stylesheet" href="<?= asset("css/bootstrap.css") ?>">
  <link rel="stylesheet" href="<?= asset("css/global.css") ?>">

</head>

<body>


  <?php include __DIR__ . "/../components/Navbar.php" ?>

  <section id="profile">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 info mb-3">
          <div class="item">
            <div class="card py-3 rounded-4">
              <img src="<?= asset('images/admin.png') ?>"
                class="card-img-top m-auto d-block" style="width:100px"
                alt="...">
              <div class="card-body">
                <h5 class="card-title mb-3 text-center"><i
                    class="fa-regular fa-pen-to-square text-info fs-6"
                    data-bs-toggle="modal"
                    data-bs-target="#editName"></i><?= auth('name') ?></h5>
                <div class="row">
                  <div class="col-4">
                    <div class="item">
                      <h6><i
                          style="cursor: pointer;"
                          class="fa-regular fa-pen-to-square text-info fs-6"
                          data-bs-toggle="modal"
                          data-bs-target="#editEmail"></i>Email
                        : </h6>
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="item">
                      <p><?= auth('email') ?></p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="item">
                      <h6><i
                          class="fa-regular fa-pen-to-square text-info fs-6" data-bs-toggle="modal"
                          data-bs-target="#editGender"></i>Gender
                        : </h6>
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="item">
                      <p><?= auth('gender') ?></p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="item">
                      <h6><i
                          class="fa-regular fa-pen-to-square text-info fs-6" data-bs-toggle="modal"
                          data-bs-target="#editPhone"></i>Phone
                        : </h6>
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="item">
                      <p><?= auth('phone') ?></p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-5">
                    <div class="item">
                      <h6><i
                          class="fa-regular fa-pen-to-square text-info fs-6" data-bs-toggle="modal"
                          data-bs-target="#editPassword"></i>Password
                        : </h6>
                    </div>
                  </div>
                  <div class="col-7">
                    <div class="item">
                    </div>
                  </div>
                </div>
                <p></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-9 links">
          <div class="item px-4 py-3 bg-light rounded-4">
           <?php 
           if(isAuth('admin')){
            include __DIR__ . "/components/admin_links.php";
           }else if(isAuth('customer')){
            include __DIR__ . "/components/customer_links.php";
           }
           ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include __DIR__ . "/components/edit_popups.php" ?>

  <script src="<?= asset("js/bootstrap.js") ?>"></script>
  <script src="<?= asset("js/jquery.js") ?>"></script>
  <script src="<?= asset("js/sweetalert.js") ?>"></script>
  <script src="<?= asset("js/profile/functions.js") ?>"></script>
  <script src="<?= asset("js/profile/profile.js") ?>"></script>

  <?php 
  if(isAuth('customer')){
    echo "<script src='" . asset('js/profile/customer.js') . "'></script>";
  }
  ?>

  <script>
    isError(<?= json_encode($_SESSION['editAlert'] ?? null) ?>)
  </script>
  <?php unset($_SESSION['editAlert']) ?>
</body>

</html>