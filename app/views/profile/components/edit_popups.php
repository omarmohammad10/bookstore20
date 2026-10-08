 <!-- Edit Name Modal -->
 <div class="modal fade" id="editName" tabindex="-1"
   aria-labelledby="editNameLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h1 class="modal-title fs-5" id="editNameLabel">Edit Name</h1>
         <button type="button" class="btn-close" data-bs-dismiss="modal"
           aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form method="POST" action="<?= route('/profile/editName') ?>">
           <div class="form-group">
             <label for="Name">Name : </label>
             <input type="text" class="form-control" id="Name" name="name" value='<?= auth('name') ?>'>
             <button
               class="btn btn-info text-light mt-3 me-auto">Edit</button>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>

 <!-- Email Modal -->
 <div class="modal fade" id="editEmail" tabindex="-1"
   aria-labelledby="editEmailLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h1 class="modal-title fs-5" id="editEmailLabel">Edit Email</h1>
         <button type="button" class="btn-close" data-bs-dismiss="modal"
           aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form method="POST" action="<?= route('/profile/editEmail') ?>">
           <div class="form-group">
             <label for="Email">Email : </label>
             <input type="email" class="form-control" id="Email" name="email" value='<?= auth('email') ?>'>
             <button
               class="btn btn-info text-light mt-3 me-auto">Edit</button>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>

 <!-- Edit Gender -->
 <div class="modal fade" id="editGender" tabindex="-1"
   aria-labelledby="editGenderLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h1 class="modal-title fs-5" id="editGenderLabel">Edit Gender</h1>
         <button type="button" class="btn-close" data-bs-dismiss="modal"
           aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form method="POST" action="<?= route('/profile/editGender') ?>">
           <div class="form-group">
             <label for="Gender">Gender : </label>
             <select class="form-control" name="gender" id="Gender">
               <option value="" <?= isSelected(auth('gender'), '') ?> hidden></option>
               <option value="male" <?= isSelected(auth('gender'), 'male') ?>>Male</option>
               <option value="female" <?= isSelected(auth('gender'), 'female') ?>>Female</option>
             </select>
             <button
               class="btn btn-info text-light mt-3 me-auto">Edit</button>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>

 <!-- Edit Phone -->
 <div class="modal fade" id="editPhone" tabindex="-1"
   aria-labelledby="editPhoneLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h1 class="modal-title fs-5" id="editPhoneLabel">Edit Phone</h1>
         <button type="button" class="btn-close" data-bs-dismiss="modal"
           aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form method="POST" action="<?= route('/profile/editPhone') ?>">
           <div class="form-group">
             <label for="Phone">Phone : </label>
             <input type="text" class="form-control" id="Phone" name="phone" value='<?= auth('phone') ?>'>
             <button
               class="btn btn-info text-light mt-3 me-auto">Edit</button>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>

 <!-- Edit Password -->
 <div class="modal fade" id="editPassword" tabindex="-1"
   aria-labelledby="editPasswordLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h1 class="modal-title fs-5" id="editPasswordLabel">Edit Password</h1>
         <button type="button" class="btn-close" data-bs-dismiss="modal"
           aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form method="POST" action="<?= route('/profile/editPassword') ?>">
           <div class="form-group">
             <label for="Password">Password : </label>
             <input type="password" class="form-control" id="Password" name="password">
             <button
               class="btn btn-info text-light mt-3 me-auto">Edit</button>
           </div>
         </form>
       </div>
     </div>
   </div>
 </div>

 <!-- Add Author -->
 <div class="modal fade" id="addAuthor" tabindex="-1"
   aria-labelledby="AddAuthorLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h1 class="modal-title fs-5" id="AddAuthorLabel">Edit Author</h1>
         <button type="button" class="btn-close" data-bs-dismiss="modal"
           aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form id="AddAuthorForm">
           <div class="form-group mb-3">
             <label for="AuthorName">Name : </label>
             <input type="text" class="form-control" id="AuthorName" name="authorName">
             <p class="alert alert-danger d-none mt-3" data-error-name="authorName"></p>
           </div>
           <div class="form-group mb-3">
             <label for="AuthorBio">Bio : </label>
             <textarea class="form-control" id="AuthorBio" name="authorBio" rows="10" style="resize: none;"></textarea>
             <p class="alert alert-danger d-none mt-3" data-error-name="authorBio"></p>
           </div>
           <button class="btn btn-success d-block mt-3 me-auto w-100">Add</button>
         </form>
       </div>
     </div>
   </div>
 </div>