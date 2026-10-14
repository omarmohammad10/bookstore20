<?php

/**
 * @var array $authors
 */
?>

<div class="row">
  <?php
  if (! empty($authors['data'])) {
    foreach ($authors['data'] as $author) {
      $authorImg = asset('images/author.png');
      $shortBio = substr($author['bio'], 0, 100);
      echo "
  <div class='col-lg-4 mb-3'>
    <div class='item'>
      <div class='card py-2 px-3 rounded-4 bg-primary-subtle text-primary-emphasis'>
        <img src='{$authorImg}'
          class='card-img-top m-auto d-block'
          style='width:100px'>
        <div class='card-body'>
          <h5 class='card-title mb-3 text-center'>{$author['name']}</h5>
          <div class='row'>
            <div class='col-4'>
              <div class='item'>
                <h6>BIO : </h6>
              </div>
            </div>
            <div class='col-8'>
              <div class='item'>
                <p>{$shortBio}...</p>
              </div>
            </div> 
          </div>
          <button class='btn btn-success w-100 mb-3' onclick='openAddBookPopup({$author['id']},\"{$author['name']}\")'>Add New Book</button>
        </div>
      </div>
    </div>
  </div>
  ";
    }
  } else {
    echo "<p class='alert alert-warning text-center w-75 m-auto'>No authors here</p>";
  }
  ?>
</div>

<?php

preparePagination($authors,'authors');

?>