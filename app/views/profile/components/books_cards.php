<?php

  /**
 * @var array $books
 */
?>

<div class="row">
  <?php
      if (! empty($books['data'])) {
          foreach ($books['data'] as $book) {
              $bookImg = $book['image'] == null ? asset("images/book.png") : asset("images/uploads/{$book['image']}");
              $shortDesc = substr($book['description'], 0 , 100);
              $orderButton = "";
              if(isAuth('customer')){
                $orderButton = "
              <div class='input-group'>
                <input type='number' min='1' class='form-control' placeholder='Quantity' id='input_quantity_{$book['id']}'>
                <button class='btn btn-outline-success' type='button' onclick='addToCart({$book['id']},this)'>Add To Cart</button>
              </div>
              ";
              }
              echo "
  <div class='col-lg-4 mb-3'>
    <div class='item'>
      <div class='card py-2 px-3 rounded-4 bg-primary-subtle text-primary-emphasis'>
        <img src='{$bookImg}'
          class='card-img-top m-auto d-block'
          style='width:100px'>
        <div class='card-body pb-0'>
          <h5 class='card-title mb-3 text-center'>{$book['title']}</h5>
          <div class='row'>
            <div class='col-4'>
              <div class='item'>
                <h6>Author : </h6>
              </div>
            </div>
            <div class='col-8'>
              <div class='item'>
                <p>{$book['author_name']}</p>
              </div>
            </div>
          </div>
          <div class='row'>
            <div class='col-4'>
              <div class='item'>
                <h6>Description : </h6>
              </div>
            </div>
            <div class='col-8'>
              <div class='item'>
                <p>{$shortDesc}...</p>
              </div>
            </div>
          </div>
          <div class='row'>
            <div class='col-4'>
              <div class='item'>
                <h6>Price : </h6>
              </div>
            </div>
            <div class='col-8'>
              <div class='item'>
                <p>{$book['price']}</p>
              </div>
            </div>
          </div>
          <div class='row'>
            <div class='col-4'>
              <div class='item'>
                <h6>Stock : </h6>
              </div>
            </div>
            <div class='col-8'>
              <div class='item'>
                <p>{$book['stock']}</p>
              </div>
            </div>
          </div>
          {$orderButton}
        </div>
      </div>
    </div>
  </div>
  ";
          }
      } else {
          echo "<p class='alert alert-warning text-center w-75 m-auto'>No books here</p>";
      }
  ?>
</div>

<?php 
preparePagination($books,'books');
?>