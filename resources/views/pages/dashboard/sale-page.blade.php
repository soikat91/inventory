@extends('layouts.sidenav-layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-4 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <div class="row">
                        <div class="col-8">
                            <span class="text-bold text-dark">BILLED TO </span>
                            <p class="text-xs mx-0 my-1">Name:  <span id="CName"></span> </p>
                            <p class="text-xs mx-0 my-1">Email:  <span id="CEmail"></span></p>
                            <p class="text-xs mx-0 my-1">User ID:  <span id="CId"></span> </p>
                        </div>
                        <div class="col-4">
                            <img class="w-50" src="{{"images/logo.png"}}">
                            <p class="text-bold mx-0 my-1 text-dark">Invoice  </p>
                            <p class="text-xs mx-0 my-1">Date: </p>
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary"/>
                    <div class="row">
                        <div class="col-12">
                            <table class="table w-100" id="invoiceTable">
                                <thead class="w-100">
                                <tr class="text-xs">
                                    <td>Name</td>
                                    <td>Qty</td>
                                    <td>Total</td>
                                    <td>Remove</td>
                                </tr>
                                </thead>
                                <tbody  class="w-100" id="invoiceList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary"/>
                    <div class="row">
                       <div class="col-12">
                           <p class="text-bold text-xs my-1 text-dark"> TOTAL: <i class="bi bi-currency-dollar"></i> <span id="total"></span></p>
                           <p class="text-bold text-xs my-2 text-dark"> PAYABLE: <i class="bi bi-currency-dollar"></i>  <span id="payable"></span></p>
                           <p class="text-bold text-xs my-1 text-dark"> VAT(5%): <i class="bi bi-currency-dollar"></i>  <span id="vat"></span></p>
                           <p class="text-bold text-xs my-1 text-dark"> Discount: <i class="bi bi-currency-dollar"></i>  <span id="discount"></span></p>
                           <span class="text-xxs">Discount(%):</span>
                           <input onkeydown="return false" value="0" min="0" type="number" step="0.25" class="form-control w-40 " id="discountP"/>
                           <p>
                              <button class="btn  my-3 bg-gradient-primary w-40">Confirm</button>
                           </p>
                       </div>
                        <div class="col-12 p-2">

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <table class="table  w-100" id="productTable">
                        <thead class="w-100">
                        <tr class="text-xs text-bold">
                            <td>Product</td>
                            <td>Pick</td>
                        </tr>
                        </thead>
                        <tbody  class="w-100" id="productList">

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <table class="table table-sm w-100" id="customerTable">
                        <thead class="w-100">
                        <tr class="text-xs text-bold">
                            <td>Customer</td>
                            <td>Pick</td>
                        </tr>
                        </thead>
                        <tbody  class="w-100" id="customerList">

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>




    <div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Product</h6>
                </div>
                <div class="modal-body">
                    <form id="add-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">
                                    <label class="form-label">Product ID *</label>
                                    <input type="text" class="form-control" id="PId">
                                    <label class="form-label mt-2">Product Name *</label>
                                    <input type="text" class="form-control" id="PName">
                                    <label class="form-label mt-2">Product Price *</label>
                                    <input type="text" class="form-control" id="PPrice">
                                    <label class="form-label mt-2">Product Qty *</label>
                                    <input type="text" class="form-control" id="PQty">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button  onclick="addProduct()" id="save-btn" class="btn bg-gradient-success" >Add</button>
                </div>
            </div>
        </div>
    </div>


    <script>

customerList()
async function customerList(){

      let cusTable= $('#customerTable')
      let cusbody=$('#customerList')

      cusbody.empty()

      let res=await axios.get('/getCustomer');

      res.data.forEach(function(item,index){

        let row=`<tr>

            <td><i class="fa fa-user"></i> ${item['name']}</td>
            <td><a data-email=${item['email']} data-name=${item['name']} data-id=${item['id']} class="btn btn-sm btn-outline-dark addCustomer">Add</a></td>
            </tr>`

            cusbody.append(row)
      })

      $('.addCustomer').on('click',function(){

        let CName=$(this).data('name');
        let CEmail=$(this).data('email');
        let CId=$(this).data('id');

       $('#CName').text(CName)
       $('#CEmail').text(CEmail)
       $('#CId').text(CId)
      })

}


// function addProduct(id,name,price){
//     document.getElementById('PId').value=id
//     document.getElementById('PName').value=name
//     document.getElementById('PPrice').value=price
//     $('#create-modal').modal('show');
// }

ProductList()
async function ProductList(){

    let productTable=$('#productTable')
    let productList=$('#productList')
    productList.empty()

    let res= await axios.get('/product-list');
    
    res.data.forEach(function(item){

        let row=`<tr>
                    <td><i class="fa fa-user" aria-hidden="true"></i> ${item['name']}</td>
                    <td><a data-name="${item['name']}" data-id="${item['id']}" data-price="${item['price']}"  class="btn btn-sm btn-outline-dark addProduct">Add</a></td>
            </tr>
                  `
        productList.append(row)
    })


    $('.addProduct').on('click',function(){

        let productId=$(this).data('id')
        let productName=$(this).data('name')
        let productPrice=$(this).data('price')

        // addProduct(productId,productName,productPrice) ---?function add kore kora jay
        document.getElementById('PId').value=productId
        document.getElementById('PName').value=productName
        document.getElementById('PPrice').value=productPrice
        $('#create-modal').modal('show');

    })

}

function addProduct(){

let productName=document.getElementById('PName').value;
let productPrice=document.getElementById('PPrice').value;
let productQty=document.getElementById('PQty').value;
let TotalSale=(parseFloat(productPrice) * parseFloat(productQty)).toFixed(2);

if(productName.lenght===0){
    errorToast("Name is Required")

}elseif(productPrice.lenght===0){
    errorToast("Price is Required")
}elseif(productQty.lenght===0){
    errorToast("QTY is Required")
}
}


</script>




@endsection
