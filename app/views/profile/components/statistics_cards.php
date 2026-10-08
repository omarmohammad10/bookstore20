<?php 
/** 
 * @var array $total
 */
?>

<div class="row">
  <div class="col-lg-3 mb-3">
    <div class="item">
      <div class="card py-2 px-3 rounded-4 bg-primary-subtle text-primary-emphasis">
        <i class="fa-solid fa-book m-auto mt-3"></i>
        <h6 class="my-3 text-center">Total Books</h6>
        <p class="text-center text-success fw-bolder mb-0"><?= $total['books'] ?></p>
      </div>
    </div>
  </div>
  <div class="col-lg-3 mb-3">
    <div class="item">
      <div class="card py-2 px-3 rounded-4 bg-primary-subtle text-primary-emphasis">
        <i class="fa-solid fa-user-group m-auto mt-3"></i>
        <h6 class="my-3 text-center">Total Authors</h6>
        <p class="text-center text-success fw-bolder mb-0"><?= $total['authors'] ?></p>
      </div>
    </div>
  </div>
  <div class="col-lg-3 mb-3">
    <div class="item">
      <div class="card py-2 px-3 rounded-4 bg-primary-subtle text-primary-emphasis">
        <i class="fa-solid fa-users m-auto mt-3"></i>
        <h6 class="my-3 text-center">Total Customers</h6>
        <p class="text-center text-success fw-bolder mb-0"><?= $total['customers'] ?></p>
      </div>
    </div>
  </div>
  <div class="col-lg-3 mb-3">
    <div class="item">
      <div class="card py-2 px-3 rounded-4 bg-primary-subtle text-primary-emphasis">
        <i class="fa-solid fa-users-gear m-auto mt-3"></i>
        <h6 class="my-3 text-center">Total Admins</h6>
        <p class="text-center text-success fw-bolder mb-0"><?= $total['admins'] ?></p>
      </div>
    </div>
  </div>
  <div class="col-lg-3 mb-3">
    <div class="item">
      <div class="card py-2 px-3 rounded-4 bg-primary-subtle text-primary-emphasis">
        <i class="fa-solid fa-circle-pause m-auto mt-3"></i>
        <h6 class="my-3 text-center">Total Ordered orders</h6>
        <p class="text-center text-success fw-bolder mb-0"><?= $total['orders']['ordered'] ?></p>
      </div>
    </div>
  </div>
  <div class="col-lg-3 mb-3">
    <div class="item">
      <div class="card py-2 px-3 rounded-4 bg-primary-subtle text-primary-emphasis">
        <i class="fa-solid fa-ban m-auto mt-3"></i>
        <h6 class="my-3 text-center">Total Cancelled orders</h6>
        <p class="text-center text-success fw-bolder mb-0"><?= $total['orders']['cancelled'] ?></p>
      </div>
    </div>
  </div>
  <div class="col-lg-3 mb-3">
    <div class="item">
      <div class="card py-2 px-3 rounded-4 bg-primary-subtle text-primary-emphasis">
        <i class="fa-solid fa-circle-check m-auto mt-3"></i>
        <h6 class="my-3 text-center">Total Done orders</h6>
        <p class="text-center text-success fw-bolder mb-0"><?= $total['orders']['done'] ?></p>
      </div>
    </div>
  </div>
</div>