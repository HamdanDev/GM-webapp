// Handles only page interactions. Product data is loaded by PHP from MySQL.

const heartBtn = document.querySelector(".wishlist-btn");
if (heartBtn) {
  heartBtn.addEventListener("click", function() {
    const icon = heartBtn.querySelector("i");
    icon.classList.toggle("bi-heart");
    icon.classList.toggle("bi-heart-fill");
  });
}

let quantity = 1;
const quantityText = document.getElementById("quantity");
const plusBtn = document.getElementById("plusBtn");
const minusBtn = document.getElementById("minusBtn");

if (quantityText && plusBtn && minusBtn) {
  plusBtn.addEventListener("click", function() {
    quantity++;
    quantityText.innerText = quantity;
  });

  minusBtn.addEventListener("click", function() {
    if (quantity > 1) {
      quantity--;
      quantityText.innerText = quantity;
    }
  });
}

const mainImage = document.getElementById("mainImage");

document.addEventListener("click", function(e) {
  if (mainImage && e.target.classList.contains("small-img")) {
    mainImage.src = e.target.src;
    document.querySelectorAll(".small-img").forEach(function(item) {
      item.classList.remove("active-img");
    });
    e.target.classList.add("active-img");
  }
});

document.querySelectorAll(".cart-btn, .btn-panier").forEach(function(btn) {
  btn.addEventListener("click", function() {
    const badge = document.getElementById("cart-count");
    const count = parseInt(badge?.textContent || "0", 10);

    if (badge) {
      badge.textContent = count + 1;
    }
  });
});
