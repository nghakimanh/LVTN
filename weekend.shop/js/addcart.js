

document.getElementsById('messenger').innerHTML="Vui lòng nhập thông tin bắt buộc"


var addcart =document.getElementById('add-cart-btn');
addcart.addEventListener('click',()=>{       //click thêm vào giỏ hàng
    cartNumbers()  
})

function cartNumbers(){
    var quantityCart=localStorage.getItem('cartNumbers');
    quantityCart=parseInt(quantityCart); 
    var productNumsCart=document.getElementById('num-cart-input').value //só lượng sản phẩm đã chọn
    if( productNumsCart !=''){
        productNumsCart=parseInt(productNumsCart);
    
        if(quantityCart){
            localStorage.setItem('cartNumbers',quantityCart+productNumsCart);
            document.getElementById('cart-num').textContent=quantityCart+ productNumsCart;
        }
        else{
            localStorage.setItem('cartNumbers',1) ;  
            document.getElementById('cart-num').textContent=1;
        }
    }
    
   

}


function onLoadCartNumbers(){
    var quantityCart=localStorage.getItem('cartNumbers');  
    if(quantityCart){
        document.getElementById('cart-num').textContent=quantityCart; //ghi lại số lượng của giỏ hàng
    }
}
onLoadCartNumbers();

