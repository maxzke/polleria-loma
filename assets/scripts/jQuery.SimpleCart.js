/*
 * jQuery Simple Shopping Cart v0.1
 * Basis shopping cart using javascript/Jquery.
 *
 * Authour : Sirisha
 */
/* '(function(){})();' this function is used, to make all variables of the plugin Private */
let totalCarritoImporte = 0;
(function ($, window, document, undefined) {

    /* Default Options */
    var defaults = {
        cart: [],
        addtoCartClass: '.sc-add-to-cart',
        cartProductListClass: '.cart-products-list',
        totalCartCountClass: '.total-cart-count',
        totalCartCostClass: '.total-cart-cost',
        showcartID : '#show-cart',
        itemCountClass : '.item-count',
        vaciarCarrito : '.limpiar_carrito'
    };

    function Item(name, price, count) {
        this.name = name;
        this.price = price;
        this.count = count;
    }
    /*Constructor function*/
    function simpleCart(domEle, options) {

        /* Merge user settings with default, recursively */
        this.options = $.extend(true, {}, defaults, options);
        //Cart array
        this.cart = [];
        //Dom Element
        this.cart_ele = $(domEle);
        //Initial init function
        this.init();
    }


    /*plugin functions */
    $.extend(simpleCart.prototype, {
        init: function () {
            this._setupCart();
            this._setEvents();
            this._loadCart();
            this._updateCartDetails();
        },
        _setupCart: function () {
            this.cart_ele.addClass("cart-grid panel panel-defaults");
            this.cart_ele.append(`<div class='panel-body cart-body'>
                                    <div class='cart-products-list' id='show-cart'>
                                        <!-- Dynamic Code from Script comes here-->
                                    </div>
                                </div>`);
        },
        _addProductstoCart: function () {
        },
        _updateCartDetails: function () {
            var mi = this;
            $(this.options.cartProductListClass).html(mi._displayCart());
            $(this.options.totalCartCountClass).html(" " + mi._totalCartCount() + " Artículos");
            $(this.options.totalCartCostClass).html(mi._totalCartCost().toFixed(2));
            totalCarritoImporte = mi._totalCartCost().toFixed(2);
        },
        _setCartbuttons: function () {

        },
        _setEvents: function () {
            var mi = this;
            $(document).on("click",this.options.addtoCartClass, function (e) {
                e.preventDefault();
                var name = $(this).attr("data-name");
                var cost = Number($(this).attr("data-price"));
                mi._addItemToCart(name, cost, 1);
                mi._updateCartDetails();
            });

            $(this.options.showcartID).on("change", this.options.itemCountClass, function (e) {
                var ci = this;
                e.preventDefault();
                var count = $(this).val();
                var name = $(this).attr("data-name");
                var cost = Number($(this).attr("data-price"));
                mi._removeItemfromCart(name, cost, count);
                mi._updateCartDetails();
            });

            $(document).on("click",this.options.vaciarCarrito, function (e) {
                mi._clearCart();
                mi._updateCartDetails();
            });

        },
        /* Helper Functions */
        _addItemToCart: function (name, price, count) {
            for (var i in this.cart) {
                if (this.cart[i].name === name) {
                    this.cart[i].count++;
                    this.cart[i].price = price * this.cart[i].count;
                    this._saveCart();
                    return;
                }
            }
            var item = new Item(name, price, count);
            this.cart.push(item);
            this._saveCart();
        },
        _removeItemfromCart: function (name, price, count) {
            for (var i in this.cart) {
                if (this.cart[i].name === name) {
                    var singleItemCost = Number(price / this.cart[i].count);
                    this.cart[i].count = count;
                    this.cart[i].price = singleItemCost * count;
                    if (count == 0) {
                        this.cart.splice(i, 1);
                    }
                    break;
                }
            }
            this._saveCart();
        },
        _clearCart: function () {
            this.cart = [];
            this._saveCart();
        },
        _totalCartCount: function () {
            return this.cart.length;
        },
        _displayCart: function () {
            var cartArray = this._listCart();
            //console.log(cartArray);
            var output = `<div class='row cart-each-product bg-primary'>
                            <div class='col-12 col-md-8 my-2'>
                                <strong>Producto</strong>
                            </div>
                            <div class='col-1 offset-4 col-md-2 offset-md-0 align-self-center'>
                                <strong>Cantidad</strong>
                            </div>
                            <div class='col-3 col-md-1 align-self-center'>
                                <strong>Precio</strong>
                            </div>
                            <div class='col-3 col-md-1 align-self-center'>
                                <strong>Total</strong>
                            </div>                                                        
                        </div><br>`;
            if (cartArray.length <= 0) {
                output = "<div class='mt-4 display-4 text-primary'><i class='fas fa-sm fa-shopping-cart'></i> vacío</div>";
            }
            for (var i in cartArray) {
                output += `<div class='row border-bottom cart-each-product'>
                        <div class='col-12 col-md-8 texto_articulo mt-2'>`+ cartArray[i].name +`</div>
                        <div class='col-1 offset-4 col-md-2 offset-md-0 align-self-center my-1'>
                            <input type='number' onfocus='this.select();' class='quantity form-control item-count' 
                            data-name='` + cartArray[i].name + `' 
                            data-price='` + (cartArray[i].price).toFixed(2) + `' 
                            min='0' 
                            value='` + cartArray[i].count + `' 
                            name='number'>
                        </div>
                        <div class='col-3 col-md-1 align-self-center'>
                            <i class='fa fa-dollar'>&nbsp;` + ((cartArray[i].price)/cartArray[i].count).toFixed(2) + `</i>
                        </div>
                        <div class='col-3 col-md-1 align-self-center'>
                            <i class='fa fa-dollar'>&nbsp;` + (cartArray[i].price).toFixed(2) + `</i>
                        </div>                                                        
                    </div>`;
                       /*//////////////////////////////*/
                       
                       /*//////////////////////////////*/
            }
            return output;
        },
        _totalCartCost: function () {
            var totalCost = 0;
            for (var i in this.cart) {
                totalCost += this.cart[i].price;
            }
            return totalCost;
        },
        _listCart: function () {
            var cartCopy = [];
            for (var i in this.cart) {
                var item = this.cart[i];
                var itemCopy = {};
                for (var p in item) {
                    itemCopy[p] = item[p];
                }
                cartCopy.push(itemCopy);
            }
            return cartCopy;
        },
        _calGST: function () {
            var GSTPercent = 18;
            var totalcost = this.totalCartCost();
            var calGST = Number((totalcost * GSTPercent) / 100);
            return calGST;
        },
        _saveCart: function () {
            localStorage.setItem("shoppingCart", JSON.stringify(this.cart));
        },
        _loadCart: function () {
            this.cart = JSON.parse(localStorage.getItem("shoppingCart"));
            if (this.cart === null) {
                this.cart = [];
            }
        }
    });
    /* Defining the Structure of the plugin 'simpleCart'*/
    $.fn.simpleCart = function (options) {
        return this.each(function () {
            $.data(this, "simpleCart", new simpleCart(this));
            //console.log($(this, "simpleCart"));
        });
    }
    ;
})(jQuery, window, document);



