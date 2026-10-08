<?php

/**
 * @var array $admins
 */
?>

<div class="row">
  <?php
  if (!empty($admins['data'])) {
    foreach ($admins['data'] as $admin) {
      $adminImg = asset('images/admin.png');
      $isBadgeBanned = ($admin['is_banned']) ?
        "<span class='badge text-bg-danger position-absolute' style='top: 10px;right: 10px;'>Banned</span>"
        : "";
      $isButtonBanned = ($admin['is_banned']) ?
        "<div class='btn btn-danger w-100'>Unban</div>"
        : "<div class='btn btn-danger w-100'>Ban</div>";
      echo "
  <div class='col-lg-4 mb-3'>
    <div class='item'>
      <div class='card py-2 px-3 rounded-4 bg-primary-subtle text-primary-emphasis'>
      {$isBadgeBanned}
        <img src='{$adminImg}'
          class='card-img-top m-auto d-block'
          style='width:100px'>
        <div class='card-body'>
          <h5 class='card-title mb-3 text-center'>{$admin['name']}</h5>
          <div class='row'>
            <div class='col-4'>
              <div class='item'>
                <h6>Email : </h6>
              </div>
            </div>
            <div class='col-8'>
              <div class='item'>
                <p>{$admin['email']}</p>
              </div>
            </div>
          </div>
          <div class='row'>
            <div class='col-4'>
              <div class='item'>
                <h6>Gender : </h6>
              </div>
            </div>
            <div class='col-8'>
              <div class='item'>
                <p>{$admin['gender']}</p>
              </div>
            </div>
          </div>
          <div class='row'>
            <div class='col-4'>
              <div class='item'>
                <h6>Phone : </h6>
              </div>
            </div>
            <div class='col-8'>
              <div class='item'>
                <p>{$admin['phone']}</p>
              </div>
            </div>
          </div>
          <div class='buttons'>
            {$isButtonBanned}
          </div>
        </div>
      </div>
    </div>
  </div>
  ";
    }
  } else {
    echo "<p class='alert alert-warning text-center w-75 m-auto'>No admins here</p>";
  }
  ?>
</div>

<?php
preparePagination($admins,'admins');
?>