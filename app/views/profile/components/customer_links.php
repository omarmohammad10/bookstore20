 <?php

/** 
 * @var array $total
 */
?>
 
 <nav class="mb-3 position-relative">
   <button type="button" class="btn position-absolute bg-primary-subtle text-primary-emphasis mb-5" style="right: 20px" onclick="getCartItems()">
     <i class="fa-solid fa-cart-shopping"></i>
     <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
       <span id="TotalItems"><?= $total['totalItems'] ?></span>
       <span class="visually-hidden">unread messages</span>
     </span>
   </button>
   <div class="nav nav-tabs" id="nav-tab" role="tablist">
     <button class="nav-link active" id="nav-statistics-tab"
       data-bs-toggle="tab" data-bs-target="#nav-statistics"
       type="button" role="tab" aria-controls="nav-statistics"
       aria-selected="true">Statistics</button>
     <button class="nav-link" id="nav-books-tab"
       data-bs-toggle="tab" data-bs-target="#nav-books"
       type="button" role="tab" aria-controls="nav-books"
       aria-selected="false">Books</button>
     <div class="dropdown">
       <button class="btn nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
         Orders
       </button>
       <ul class="dropdown-menu">
         <li><a class="dropdown-item" id="nav-orders_ordered-tab"
             data-bs-toggle="tab" data-bs-target="#nav-orders_ordered"
             type="button" role="tab" aria-controls="nav-orders_ordered"
             aria-selected="false">Ordered</a></li>
         <li><a class="dropdown-item" id="nav-orders_cancelled-tab"
             data-bs-toggle="tab" data-bs-target="#nav-orders_cancelled"
             type="button" role="tab" aria-controls="nav-orders_cancelled"
             aria-selected="false">Cancelled</a></li>
         <li><a class="dropdown-item" id="nav-orders_done-tab"
             data-bs-toggle="tab" data-bs-target="#nav-orders_done"
             type="button" role="tab" aria-controls="nav-orders_done"
             aria-selected="false">Done</a></li>
       </ul>
     </div>
   </div>
 </nav>
 <div class="tab-content" id="nav-tabContent">
   <div class="tab-pane fade show active" id="nav-statistics"
     role="tabpanel" aria-labelledby="nav-statistics-tab"
     tabindex="0">
     <?php include __DIR__ . "/statistics_cards.php" ?>
   </div>
   <div class="tab-pane fade" id="nav-books" role="tabpanel"
     aria-labelledby="nav-books-tab" tabindex="0">
     <div id="BooksFilter">
       <form id="BooksFilterForm">
         <input type="hidden" name="page" value="1" id="ChangePage">
         <div class="row">
           <div class="col-lg-6">
             <div class="item">
               <div class="input-group mb-3">
                 <label for="FilterBookTitle" class="input-group-text" id="FilterBookTitle"><i class="fa-solid fa-book"></i></label>
                 <input type="text" class="form-control" placeholder="Title..." name="title">
               </div>
             </div>
           </div>
           <div class="col-lg-6">
             <div class="item">
               <div class="input-group mb-3">
                 <label for="FilterBookAuthor" class="input-group-text" id="FilterBookAuthor"><i class="fa-solid fa-user"></i></label>
                 <input type="text" class="form-control" placeholder="Author..." name="author">
               </div>
             </div>
           </div>
           <div class="col-lg-6">
             <div class="item">
               <div class="input-group mb-3">
                 <label for="FilterBookMinPrice" class="input-group-text" id="FilterBookMinPrice"><i class="fa-solid fa-dollar-sign"></i></label>
                 <input type="text" class="form-control" placeholder="Min Price..." name="minPrice">
               </div>
             </div>
           </div>
           <div class="col-lg-6">
             <div class="item">
               <div class="input-group mb-3">
                 <label for="FilterBookMaxPrice" class="input-group-text" id="FilterBookMaxPrice"><i class="fa-solid fa-dollar-sign"></i></label>
                 <input type="text" class="form-control" placeholder="Max Price..." name="maxPrice">
               </div>
             </div>
           </div>
           <div class="col-lg-6">
             <div class="item">
               <div class="input-group mb-3">
                 <label for="FilterBookStock" class="input-group-text" id="FilterBookStock"><i class="fa-solid fa-hashtag"></i></label>
                 <input type="text" class="form-control" placeholder="Stock..." name="stock">
               </div>
             </div>
           </div>
           <div class="col-lg-6">
             <div class="item">
               <div class="input-group mb-3">
                 <label for="FilterBookSort" class="input-group-text" id="FilterBookSort"><i class="fa-solid fa-hashtag"></i></label>
                 <select class="form-control" id="FilterBookSort" name="sort">
                   <option value="DESC">↑ DESC</option>
                   <option value="DESC">↓ ASC</option>
                 </select>
               </div>
             </div>
           </div>
         </div>
         <button class="btn btn-success w-100 mb-3">Filter</button>
       </form>
     </div>
     <?php include __DIR__ . "/books_cards.php" ?>
   </div>
   <div class="tab-pane fade" id="nav-orders_ordered" role="tabpanel"
     aria-labelledby="nav-orders_ordered-tab" tabindex="0">
     <?php include __DIR__ . "/orders_ordered_cards.php" ?>
   </div>
   <div class="tab-pane fade" id="nav-orders_cancelled" role="tabpanel"
     aria-labelledby="nav-orders_cancelled-tab" tabindex="0">
     <?php include __DIR__ . "/orders_cancelled_cards.php" ?>
   </div>
   <div class="tab-pane fade" id="nav-orders_done" role="tabpanel"
     aria-labelledby="nav-orders_done-tab" tabindex="0">
     <?php include __DIR__ . "/orders_done_cards.php" ?>
   </div>
 </div>