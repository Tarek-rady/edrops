var taxRate = parseFloat(document.getElementById("shipping-value").innerHTML),
    currencySign = "$";
function recalculateCart() {
    var t = 0,
        sd = 0,
        f = 0,
        c = 0,
        customer_cost =
            (Array.from(document.getElementsByClassName("product")).forEach(
                function (e) {
                    Array.from(
                        e.getElementsByClassName("product-line-price")
                    ).forEach(function (e) {
                        t += parseFloat(e.innerHTML);
                    });
                }
            ),
            t + taxRate);

    Array.from(document.getElementsByClassName("product")).forEach(function (
        e
    ) {
        Array.from(e.getElementsByClassName("product-line-cost")).forEach(
            function (e) {
                f += parseFloat(e.innerHTML);
            }
        );
    });

    var seller_profit =
        (Array.from(document.getElementsByClassName("product")).forEach(
            function (e) {
                sd +=
                    (parseFloat(
                        e.getElementsByClassName("selling-price")[0].value
                    ) -
                        parseFloat(
                            e.getElementsByClassName("product-price")[0]
                                .innerHTML
                        )) *
                    e.getElementsByClassName("product-quantity")[0].value;
                console.log(sd);
            }
        ),
        sd);

    c = f + taxRate;
    (document.getElementById("cost-subtotal").innerHTML =
        currencySign + f.toFixed(2)),
        (document.getElementById("cost-total").innerHTML =
            currencySign + c.toFixed(2)),
        (document.getElementById("customer-cost").innerHTML =
            currencySign + customer_cost.toFixed(2))(
            (document.getElementById("seller-profit").innerHTML =
                currencySign + seller_profit.toFixed(2))
        );
}
function updateQuantity(e) {
    var t,
        n,
        r = e.closest(".product"),
        c =
            ((r || r.getElementsByClassName("selling-price")) &&
                Array.from(r.getElementsByClassName("selling-price")).forEach(
                    function (e) {
                        t = parseFloat(e.value);
                    }
                ),
            e.previousElementSibling &&
            e.previousElementSibling.classList.contains("product-quantity")
                ? (n = e.previousElementSibling.value)
                : e.nextElementSibling &&
                  e.nextElementSibling.classList.contains("product-quantity") &&
                  (n = e.nextElementSibling.value),
            t * n);
    d =
        ((r || r.getElementsByClassName("product-price")) &&
            Array.from(r.getElementsByClassName("product-price")).forEach(
                function (e) {
                    t = parseFloat(e.innerHTML);
                }
            ),
        e.previousElementSibling &&
        e.previousElementSibling.classList.contains("product-quantity")
            ? (n = e.previousElementSibling.value)
            : e.nextElementSibling &&
              e.nextElementSibling.classList.contains("product-quantity") &&
              (n = e.nextElementSibling.value),
        t * n);
    Array.from(r.getElementsByClassName("product-line-price")).forEach(
        function (e) {
            e.innerHTML = c.toFixed(2);
        }
    );

    Array.from(r.getElementsByClassName("product-line-cost")).forEach(function (
        e
    ) {
        (e.innerHTML = d.toFixed(2)), recalculateCart();
    });
}

function updatePrice(input) {
    if (parseFloat(input.value) < parseFloat(input.min)) {
        input.value = input.min;
    } else if (parseFloat(input.value) > parseFloat(input.max)) {
        input.value = input.max;
    }

    var productContainer = input.closest(".product");
    var quantity = parseFloat(
        productContainer.querySelector(".product-quantity").value
    );
    var sellingPrice = parseFloat(
        productContainer.querySelector(".selling-price").value
    );
    var productLinePrice = quantity * sellingPrice;

    productContainer.querySelector(".product-line-price").innerHTML =
        productLinePrice.toFixed(2);
    recalculateCart();
}

var removeProduct = document.getElementById("removeItemModal");
removeProduct &&
    removeProduct.addEventListener("show.bs.modal", function (t) {
        document
            .getElementById("remove-product")
            .addEventListener("click", function (e) {
                var product_id = t.relatedTarget.closest(".product").dataset.id;
                remove_cart(product_id);
                t.relatedTarget.closest(".product").remove(),
                    document.getElementById("close-modal").click(),
                    recalculateCart();
            });
    });
