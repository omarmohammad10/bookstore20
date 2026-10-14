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

function imgPath(imgName) {
  return window.location.origin + "/PHP/bookstore/public/assets/images/" + imgName;
}

function showErrors(errors) {
  for (let error in errors) {
    $(`p.alert[data-error-name="${error}"]`).text(errors[error]).removeClass("d-none");
  }
}

function openModal(modalId) {
  const myModal = new bootstrap.Modal(`#${modalId}`);
  myModal.show();
  document.activeElement?.blur();
}

function bookComponent(book, status) {
  let shortDesc = book['description'].slice(0, 100);
  let additionalRows = "";

  if (status == 'books') {
    additionalRows = `
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
    `;
  } else if (status == 'cart') {

  }

  return `
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
          ${additionalRows}
        </div>
      </div>
    </div>
  </div>  
  `;
}