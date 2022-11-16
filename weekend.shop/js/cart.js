if(document.readyState=='loading'){
    document.addEventListener('DOMContentLoaded',ready)
}else{
    ready()
}

function ready(){
    var removeItem=document.getElementsByClassName("btn-trash")
    for(var i=0;i<removeItem.length;i++){
        var button=removeItem[i]
        button.addEventListener('click',removeItemCart)
    }
    var quantityInputs=document.getElementsByClassName('quantity-cart')
    for(var i=0;i<quantityInputs.length;i++){
        var input=quantityInputs[i]
        input.addEventListener('change',quantityChange)
    }
}

function removeItemCart(event){
    var btnClicked=event.target
    btnClicked.parentElement.parentElement.parentElement.remove()
    updateCartTotal()
}

function quantityChange(event){
    var input=event.target
    if(isNaN(input.value)|| input.value<=0)
        input.value=1;
    updateCartTotal()
}

function updateCartTotal(){
    var listCart=document.getElementsByClassName('list-cart')[0]
    var cartRows=listCart.getElementsByClassName('row-cart')
    var total=0
    //console.log(total)
    for (var i=0;i< cartRows.length; i++){
        var cartRow=cartRows[i]
        var priceElm=cartRow.getElementsByClassName('price-cart')[0]
        var quantityElm=cartRow.getElementsByClassName('quantity-cart')[0]
        var price=parseFloat(priceElm.innerText)
        var quantity=quantityElm.value
        document.getElementsByClassName('total-item-cart')[0].innerText=(price*quantity)
        total=total+(price*quantity)
    }
    document.getElementsByClassName('total-cart')[0].innerText=total
}


