// cart.js

// Update Quantity
function updateQuantity(rowId, quantity) {
  $.ajax({
    url: '/cart/update',
    method: 'POST',
    data: {
      rowId: rowId,
      quantity: quantity,
    },
    success: function(response) {
      // Handle success response
      console.log(response);
      // Reload the cart or update the quantity displayed in the UI
    },
    error: function(xhr) {
      // Handle error response
      console.log(xhr.responseText);
    }
  });
}

// Remove Row
function removeRow(rowId) {
  $.ajax({
    url: '/cart/remove',
    method: 'POST',
    data: {
      rowId: rowId,
    },
    success: function(response) {
      // Handle success response
      console.log(response);
      // Remove the row from the UI
    },
    error: function(xhr) {
      // Handle error response
      console.log(xhr.responseText);
    }
  });
}
