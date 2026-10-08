function isError(alert) {
  if (alert != null) {
    Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      }
    }).fire({
      icon: alert[0],
      title: alert[1]
    });
  }
}

$(document).ready(function () {
  let type = window.location.search.replace("?", "").split("-")[0];
  $(`#nav-${type}-tab`).get(0)?.click();
})

function imgPath(imgName) {
  return window.location.origin + "/PHP/bookstore/public/assets/images/" + imgName;
}

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

function showErrors(errors) {
  for (let error in errors) {
    $(`p.alert[data-error-name="${error}"]`).text(errors[error]).removeClass("d-none");
  }
}

$("#BooksFilterForm").submit(function (e) {
  e.preventDefault();
  let dataForm = new FormData(this);
  $.ajax({
    url: "profile/filterBooks",
    type: "POST",
    data: dataForm,
    success: function (response) {
      console.log(response);
      let books = response.data.data,
        currentPage = response.data.currentPage,
        total = response.data.total;

      $("#nav-books > .row").html("");
      $("#nav-books nav").remove();

      if (books.length != 0) {
        for (let i = 0; i < books.length; i++) {
          let shortDesc = books[i]['description'].slice(0,100);
          $("#nav-books > .row").append(`
           <div class='col-lg-4 mb-3'>
    <div class='item'>
      <div class='card py-2 px-3 rounded-4 bg-primary-subtle text-primary-emphasis'>
        <img src='${imgPath(books[i].image == null ? 'book.png' : `uploads/${books[i].image}`)}'
          class='card-img-top m-auto d-block'
          style='width:100px'>
        <div class='card-body'>
          <h5 class='card-title mb-3 text-center'>${books[i]['title']}</h5>
          <div class='row'>
            <div class='col-4'>
              <div class='item'>
                <h6>Author : </h6>
              </div>
            </div>
            <div class='col-8'>
              <div class='item'>
                <p>${books[i]['author_name']}</p>
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
                <p>${books[i]['price']}</p>
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
                <p>${books[i]['stock']}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
          `);
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

function preparePagination(data)
{
  books = data.data;
  if (books.length != 0 ) {
    
    let prepareLi = "",
    pagesNumber = Math.ceil(data.total / 10),
    prevPage = (data.currentPage > 1) ? data.currentPage - 1 : 1,
    nextPage = (data.currentPage < pagesNumber) ? data.currentPage + 1: pagesNumber,
    isprevPageDisabled = (data.currentPage > 1) ? '' : 'disabled',
    isNextPageDisabled = (data.currentPage < pagesNumber) ? '' : 'disabled';

    for (let i = 1; i <= pagesNumber; i++) {
      let isActive = (data.currentPage == i) ? 'active' : '';
      prepareLi += `<li class='page-item'><a class='page-link ${isActive}' onclick="changePage(${i}) data-page=${i}'>${i}</a></li>`;
    };

    return ` 
  <nav aria-label='Page navigation example'>
    <ul class='pagination'>
      <li class='page-item'><a class='page-link ${isprevPageDisabled}' onclick="changePage(${prevPage})" data-page=${prevPage}'>Previous</a></li>
      ${prepareLi}
      <li class='page-item'><a class='page-link ${isNextPageDisabled}' onclick="changePage(${nextPage}) data-page='${nextPage}'>Next</a></li>
    </ul>
  </nav>
  `;
  }
  return "";
}

function changePage(page){
  $("#BooksFilterForm #ChangePage").val(page);
  $("#BooksFilterForm").trigger('submit');
}