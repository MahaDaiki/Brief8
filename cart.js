// Define a global variable to store the cart items
var cartItems = [];

// Function to add an item to the cart
function addToCart(button) {
    var productReference = button.getAttribute('data-product-reference');
    var productName = button.getAttribute('data-product-name');
    var productPrice = button.getAttribute('data-product-price');
    var productImage = button.getAttribute('data-product-image');

    // Check if the item is already in the cart
    var existingItem = cartItems.find(item => item.reference === productReference);

    if (existingItem) {
        // If the item is already in the cart, increase the quantity
        existingItem.quantity += 1;
    } else {
        // If the item is not in the cart, add a new item
        var cartItem = {
            reference: productReference,
            image: productImage,
            name: productName,
            price: productPrice,
            quantity: 1
        };
        cartItems.push(cartItem);
    }

    // Update the cart modal with the current items
    updateCartModal();
}

// Function to update the cart modal with current items
function updateCartModal() {
    // Clear the existing content
    var cartItemsContainer = document.getElementById('cartItems');
    cartItemsContainer.innerHTML = '';

    // Add each item to the cart modal
    cartItems.forEach(function (item) {
        var cartItemDiv = document.createElement('div');
        cartItemDiv.classList.add('cart-item');
        cartItemDiv.innerHTML = `
        <img src="${item.image}" alt="${item.name}" style="width: 50px; height: 50px;">
        <p>${item.name} - DH${item.price} x ${item.quantity}</p>
        <button class="btn btn-sm btn-info" onclick="modifyQuantity('${item.reference}', 1)">+</button>
        <button class="btn btn-sm btn-warning" onclick="modifyQuantity('${item.reference}', -1)">-</button>
        <button class="btn btn-sm btn-danger" onclick="removeItem('${item.reference}')">Remove</button>
    `;
        cartItemsContainer.appendChild(cartItemDiv);
    });
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
}

// Function to modify the quantity of an item in the cart
function modifyQuantity(reference, amount) {
    var item = cartItems.find(item => item.reference === reference);

    if (item) {
        // Increase or decrease the quantity
        item.quantity += amount;
        // If the quantity becomes zero or less, remove the item from the cart
        if (item.quantity <= 0) {
            removeItem(reference);
        }
    }

    updateCartModal();
}

// Function to remove an item from the cart
function removeItem(reference) {
    cartItems = cartItems.filter(item => item.reference !== reference);
    updateCartModal();
}

function viewCart() {
    // Retrieve cart items from localStorage
    var cartItemsString = localStorage.getItem('cartItems');

    if (cartItemsString) {
        // Parse the cart items
        var parsedCartItems = JSON.parse(cartItemsString);

        if (parsedCartItems && parsedCartItems.length > 0) {
            // Store cart items in sessionStorage
            sessionStorage.setItem('cartItems', JSON.stringify(parsedCartItems));
            // Redirect to confirmation.php
            window.location.href = 'confirmation.php';
        } else {
            // Handle the case when there are no items in the cart
            alert('Your cart is empty.');
        }
    }
}

// document.addEventListener('DOMContentLoaded', function () {
//     var storedCartItems = localStorage.getItem('cartItems');
//     if (storedCartItems) {
//         cartItems = JSON.parse(storedCartItems);
//         updateCartModal();
//     }
// });

function checkout() {
    // Send the cart items to the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                var response = JSON.parse(xhr.responseText);
                console.log(response);
                alert("Checkout successful!");
                window.location.href = 'confirmation.php?order_id=' + response.order_id;
                // Clear the cart after checkout
                // cartItems = [];
                // updateCartModal();
               
            } else {
                // If the request failed, handle the error
                console.error(xhr.statusText);
                alert("Checkout failed. Please try again.");
            }
        }
    };

    // Prepare the data to send to the server
    var data = JSON.stringify(cartItems);

    xhr.open("POST", "Checkout.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    // Send the data
    xhr.send(data);
}
