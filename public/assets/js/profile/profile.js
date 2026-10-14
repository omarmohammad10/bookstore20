$(document).ready(function () {
  let type = window.location.search.replace("?", "").split("-")[0];
  $(`#nav-${type}-tab`).get(0)?.click();
})

$("#AddAuthorForm").submit(function (e) {
  e.preventDefault();
  let dataForm = new FormData(this);
  $.ajax({
    url: "profile/addAuthor",
    type: "POST",
    data: dataForm,
    success: function (response) {
      console.log(response);
      let author = response.data;
      $("#AddAuthorForm").get(0).reset();
      $(`#AddAuthorForm p.alert[data-error-name]`).addClass("d-none");
      $("#addAuthor .btn-close").get(0).click();
      $("#nav-authors > .row").prepend(`
  <div class='col-lg-4 mb-3'>
    <div class='item'>
      <div class='card py-2 px-3 rounded-4 bg-primary-subtle text-primary-emphasis'>
        <img src='${imgPath('author.png')}'
          class='card-img-top m-auto d-block'
          style='width:100px'>
        <div class='card-body'>
          <h5 class='card-title mb-3 text-center'>${author.name}</h5>
          <div class='row'>
            <div class='col-4'>
              <div class='item'>
                <h6>BIO : </h6>
              </div>
            </div>
            <div class='col-8'>
              <div class='item'>
                <p>${author.bio.slice(0, 100)}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  ";
        `)
    },
    error: function (response) {
      let errors = response.responseJSON.data;
      console.log(errors);
      showErrors(errors);
    }
  })
})

$("#BooksFilterForm").submit(function (e) {
  e.preventDefault();
  let dataForm = new FormData(this);
  $.ajax({
    url: "profile/filterBooks",
    type: "POST",
    data: dataForm,
    success: function (response) {
      console.log(response.data);
      let books = response.data.data,
        currentPage = response.data.currentPage,
        total = response.data.total;

      $("#nav-books > .row").html("");
      $("#nav-books nav").remove();

      if (books.length != 0) {
        for (let i = 0; i < books.length; i++) {
          $("#nav-books > .row").append(bookComponent(books[i],'books'));
        }

        $("#nav-books").append(preparePagination(response.data));

      } else {
        $("#nav-books > .row").append(`<p class='alert alert-warning text-center w-75 m-auto'>No books here</p>`)
      }
    },
    error: function (response) {
      console.log(response);
    }
  })
})

function preparePagination(data) {
  books = data.data;
  if (books.length != 0) {

    let prepareLi = "",
      pagesNumber = Math.ceil(data.total / 10),
      prevPage = (data.currentPage > 1) ? data.currentPage - 1 : 1,
      nextPage = (data.currentPage < pagesNumber) ? data.currentPage + 1 : pagesNumber,
      isprevPageDisabled = (data.currentPage > 1) ? '' : 'disabled',
      isNextPageDisabled = (data.currentPage < pagesNumber) ? '' : 'disabled';

    for (let i = 1; i <= pagesNumber; i++) {
      let isActive = (data.currentPage == i) ? 'active' : '';
      prepareLi += `<li class='page-item'><a class='page-link ${isActive}' onclick="changePage(${i})" data-page='${i}'>${i}</a></li>`;
    };

    return ` 
  <nav aria-label='Page navigation example'>
    <ul class='pagination'>
      <li class='page-item'><a class='page-link ${isprevPageDisabled}' onclick="changePage(${prevPage})" data-page='${prevPage}'>Previous</a></li>
      ${prepareLi}
      <li class='page-item'><a class='page-link ${isNextPageDisabled}' onclick="changePage(${nextPage})" data-page='${nextPage}'>Next</a></li>
    </ul>
  </nav>
  `;
  }
  return "";
}

function changePage(page) {
  console.log(page)
  $("#BooksFilterForm #ChangePage").val(page);
  $("#BooksFilterForm #ChangePage").trigger('submit');
}

function openAddBookPopup(authorId, authorName) {
  $("#AuthorId option").val(authorId).text(authorName); // Appears in UI
  $("#AuthorIdHidden").val(authorId); // Sent to backend
  openModal("addBook");
}

$("#AddBookForm").submit(function (e) {
  e.preventDefault();
  let dataForm = new FormData(this);
  $.ajax({
    url: "profile/addBook",
    type: "POST",
    data: dataForm,
    success: function (response) {
      console.log(response);
      let book = response.data;

      $("#AddBookForm").get(0).reset();
      $(`#AddBookForm p.alert[data-error-name]`).addClass("d-none");
      $("#addBook .btn-close").get(0).click();
      let shortDesc = book['description'].slice(0, 100);

      $("#nav-books > .row").prepend(`
           <div class='col-lg-4 mb-3'>
    <div class='item'>
      <div class='card py-2 px-3 rounded-4 bg-primary-subtle text-primary-emphasis'>
        <img src='${imgPath(book.image == null ? 'book.png' : `uploads/${book.image}`)}'
          class='card-img-top m-auto d-block'
          style='width:100px'>
        <div class='card-body'>
          <h5 class='card-title mb-3 text-center'>${book['title']}</h5>
          <div class='row'>
            <div class='col-4'>
              <div class='item'>
                <h6>Author : </h6>
              </div>
            </div>
            <div class='col-8'>
              <div class='item'>
                <p>${book['author_name']}</p>
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
                <p>${shortDesc}...</p>
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
                <p>${book['price']}</p>
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
                <p>${book['stock']}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
          `);

    },
    error: function (response) {
      console.log(response);
      if (response.status == 422) {
        let errors = response.responseJSON.data;
        console.log(errors);
        showErrors(errors);
      }
    }
  });
})

function banUser(userId, text) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: `Yes, ${text} it!`
  }).then((result) => {
    if (result.isConfirmed) {
      let dataForm = {
        'userId': userId
      };

      $.ajax({
        url: "profile/banUser",
        type: "POST",
        data: dataForm,
        success: function (response) {
          console.log(response);
          let user = response.data
          Swal.fire({
            title: `${(user.is_banned) ? "Banned" : "Unbanned"}`,
            text: `Admin Ban has been Updated`,
            icon: "success"
          });

          let isBadgeBanned = (user['is_banned']) ?
            "<span class='badge text-bg-danger position-absolute' style='top: 10px;right: 10px;'>Banned</span>"
            : "";
          let isButtonBanned = (user['is_banned']) ?
            `<div class='btn btn-danger w-100' onclick='banUser(${user['id']},"Unban")'>Unban</div>`
            : `<div class='btn btn-danger w-100' onclick='banUser(${user['id']},"Ban")'>Ban</div>`;

          $(`.card[data-user-id='${userId}']`).html(`
            ${isBadgeBanned}
        <img src='${imgPath(`${user.role}.png`)}'
          class='card-img-top m-auto d-block'
          style='width:100px'>
        <div class='card-body'>
          <h5 class='card-title mb-3 text-center'>${user['name']}</h5>
          <div class='row'>
            <div class='col-4'>
              <div class='item'>
                <h6>Email : </h6>
              </div>
            </div>
            <div class='col-8'>
              <div class='item'>
                <p>${user['email']}</p>
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
                <p>${user['gender']}</p>
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
                <p>${user['phone']}</p>
              </div>
            </div>
          </div>
          <div class='buttons'>
            ${isButtonBanned}
          </div>
        </div>
            `);
        },
        error: function (response) {
          console.log(response)
          if (response.status == 422) {
            let errorMsg = response.responseJSON.data.userId[0];
            isError(['error', errorMsg])
          }
          if(response.status ==  403){
            let errorMsg = response.statusText = "You are forbidden";
            isError(['error', errorMsg])
          }
        }
      });
    }
  });
}