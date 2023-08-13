<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="productCategory">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="productName">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control" id="productPrice">
                                <label class="form-label">Unit</label>
                                <input type="text" class="form-control" id="productUnit">

                                <br/>
                                {{-- default image naoya hoice and akne preview image show korbe tar jnno javeScript Use kora hoice --}}
                                <img class="w-15" id="newImg" src="{{asset('images/default-image.png')}}"/>
                                <br/>

                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="productImg">


                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="InsertProduct()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>

<script>
         ProductCategory()
      async function ProductCategory(){

        let res=await axios.get('/list-category')

        res.data.forEach(function(item){

            let category=`<option value="${item.id}">${item.name}</option> `
            $('#productCategory').append(category)

        })
        
      }


      async function InsertProduct(){

            let productCategory=document.getElementById('productCategory').value
            let productName=document.getElementById('productName').value
            let productPrice=document.getElementById('productPrice').value
            let productUnit=document.getElementById('productUnit').value
            let productImg=document.getElementById('productImg').files[0]

            if(productName.length===0){
                errorToast('Name Requird')
            }else if(productCategory.length===0){
                errorToast('Category Requird')
            }else if(productPrice.length===0){
                errorToast('Price Requird')
            }else if(productUnit.length===0){
                errorToast('Unit Requird')
            }else if(!productImg){
                errorToast('Image Requird')
            }else{
                $('#create-modal').modal('hide')

                let formData=new FormData();
                
                formData.append('name',productName)
                formData.append('category_id',productCategory)
                formData.append('price',productPrice)
                formData.append('unit',productUnit)
                formData.append('img',productImg)

                let configuer={
                    headers:{
                        'content-type':'multipart/form-data'
                    }
                }
                showLoader()
                let res=await axios.post('/product-create',formData,configuer)
                hideLoader()
                if(res.status===201){
                    successToast("Product Success")
                    document.getElementById('save-form').reset()
                   $('#create-modal').trigger("reset")
                    await productList()
                }else{
                    errorToast("Request Failed")
                }

            }
        
      }


</script>
