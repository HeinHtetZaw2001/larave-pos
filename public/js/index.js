
    let productDetailModal = document.getElementById("productDetail");
    let modal = new bootstrap.Modal(productDetailModal);
    let productModalTitle = document.getElementById("productModalTitle");
    let productModalImg = document.getElementById("productModalImg");
    let productModalPrice = document.getElementById("productModalPrice");
    let productModalQuantity = document.getElementById("productModalQuantity");
    let quantityPlus = document.getElementById("quantityPlus");
    let quantityMinus = document.getElementById("quantityMinus");
    let allProductCard = document.querySelectorAll(".product-card");
    let addToVoucher = document.getElementById("addToVoucher");
    let voucherList = document.getElementById("voucherList");
    let productLists= @json($items);
    allProductCard.forEach(function (el){
    el.addEventListener("click",function (){
        let currentId = el.getAttribute("data-id");
        let currentDetail = productLists.find(productList => productList.id == currentId);
        {{--console.log( {{public_path()}});--}}
        productModalTitle.innerText = currentDetail.name
        productModalImg.src ="http://127.0.0.1:8000/storage/item/"+currentDetail.photo

        productModalPrice.innerText = currentDetail.price
        productModalQuantity.setAttribute("price",currentDetail.price)
        modal.show()
    });
});
    function voucherListCreate(title,price,quantity,cost){
    let li = document.createElement("li");
    li.classList.add("list-group-item","d-flex","justify-content-between");
    li.innerHTML = `
        <div class="w-75">
            <h6 class="my-0 text-truncate">${title}</h6>
            <small class="text-muted">
                Price : ${price} x ${quantity}
            </small>
            <i class=" fas fa-trash-alt btn btn-outline-danger btn-sm cart-del-btn"></i>
        </div>
        <div class="text-muted w-25 voncher-cost text-end price">${cost} </div>


    `;

    return li;
}
    function calcCost(){
    currentPrice = Number(productModalQuantity.getAttribute("price"));
    productModalPrice.innerText = productModalQuantity.valueAsNumber * currentPrice
}

    quantityPlus.addEventListener('click',function (){
    productModalQuantity.valueAsNumber += 1
    calcCost()
});

    quantityMinus.addEventListener('click',function (){
    if(productModalQuantity.valueAsNumber > 1){
    productModalQuantity.valueAsNumber -= 1
    calcCost()
}
});

    addToVoucher.addEventListener("click",function (){
    voucherList.append(voucherListCreate(
        productModalTitle.innerText,
        productModalQuantity.getAttribute("price"),
        productModalQuantity.valueAsNumber,
        productModalPrice.innerText
    ));
    modal.hide();
    totalPrice();
    productModalQuantity.valueAsNumber = 1
});
    function totalPrice()
    {
        $("#total").html($(".price").toArray().map(el=>el.innerHTML).reduce((x,y)=>Number(x)+Number(y)));
    };
    $("#voucherList").delegate(".cart-del-btn","click",function () {
    $(this).parentsUntil("#voucherList").remove();
    totalPrice();
});

