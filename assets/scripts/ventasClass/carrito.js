class Carrito{

    carrito = [];

    constructor(codigo,cantidad,nombre,kilos,precio,importe){
        this.code = codigo;
        this.quantity = cantidad;
        this.name = nombre;
        this.kilos = kilos;
        this.price = precio;
        this.amount = importe;
    }
     addCarrito(){
         let item={
             code: this.code,
             name: this.name,
             quantity: this.quantity,
             kilos: this.kilos,
             price: this.price,
             amount: this.amount

         }
         this.carrito.push(item);
     }
     getCarrito(){
         return this.carrito;
     }
}//end of class

const product = new Carrito('123d45ghnm',1,'procesado',3,123,369);
product.addCarrito();
console.log(product.getCarrito());