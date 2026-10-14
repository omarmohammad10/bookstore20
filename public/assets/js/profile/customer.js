function addToCart(bookId, that) {
  let $quantityInput = $(that).prev(),
  // Get the input next to (add to cart) button
  quantity = Number($quantityInput.val()); // Quantity Value

  if(quantity == 0){
    return;
  }

  let dataForm = {
    bookId: bookId,
    quantity: quantity
  };

  $.ajax({
    url: "profile/addToCart",
    type: "POST",
    data: dataForm,
    success: function (response) {
      console.log(response);
      let totalItems = response.data.totalItems;
      $("#TotalItems").text(totalItems);
      $quantityInput.val("");
    },
    error: function (response) {
      console.log(response);
      if(response.status == 422){
        let errorMsg = response.responseJSON.data.bookId[0];
        isError(['error',errorMsg]);
      }
    }
  })
}

function getCartItems(){
  $.ajax({
    url: "profile/getCartItems",
    type: "POST",
    data: "",
    success: function (response) {
      console.log(response);
      openModal("Cart");
    },
    error: function (response) {
      console.log(response);
    }
  })
}