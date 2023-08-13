<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                </div>
                <div class="modal-body">
                    <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="UpdateProductCategory">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="updateProductName">
                                
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control" id="updateProductPrice">
                                <label class="form-label">Unit</label>
                                <input type="text" class="form-control" id="updateProductUnit">

                                <br/>
                                {{-- default image naoya hoice and akne preview image show korbe tar jnno javeScript Use kora hoice --}}
                                <img class="w-15" id="oldImg" src="{{asset('images/default-image.png')}}"/>
                                <br/>

                                <label class="form-label">Image</label>
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="updateProductImg">
                                <input type="text" class="form-control" id="productID">
                                <input type="text" class="form-control" id="imagePATH">

                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="UpdateProduct()" id="save-btn" class="btn btn-sm  btn-success" >Update</button>
                </div>
            </div>
    </div>
</div>

<script>


      async function ProductCategoryUdate(){

        let res=await axios.get('/list-category')

        res.data.forEach(function(item){

            let category=`<option value="${item.id}">${item.name}</option> `
            $('#UpdateProductCategory').append(category)

        })
        
      }

        async function productId(id,path){

            document.getElementById('productID').value=id
            document.getElementById('imagePATH').value=path
            document.getElementById('oldImg').src=path  //existing image show korar jnno use kora hoice old image er src use kore path niye show kora hoice
           showLoader();
            await ProductCategoryUdate()
            let res=await axios.post('/product-by-id',{id:id})
            hideLoader();
            document.getElementById('UpdateProductCategory').value=res.data['category_id']
            document.getElementById('updateProductName').value=res.data['name']
            document.getElementById('updateProductPrice').value=res.data['price']
            document.getElementById('updateProductUnit').value=res.data['unit']
          

        }        


      async function UpdateProduct(){

            let UpdateProductCategory=document.getElementById('UpdateProductCategory').value
            let updateProductName=document.getElementById('updateProductName').value
            let updateProductPrice=document.getElementById('updateProductPrice').value
            let updateProductUnit=document.getElementById('updateProductUnit').value
            let productID=document.getElementById('productID').value
            let imagePATH=document.getElementById('imagePATH').value
            let updateProductImg=document.getElementById('updateProductImg').files[0];
            

            if(updateProductName.length===0){
                errorToast('Name Requird')
            }else if(UpdateProductCategory.length===0){
                errorToast('Category Requird')
            }else if(updateProductPrice.length===0){
                errorToast('Price Requird')
            }else if(updateProductUnit.length===0){
                errorToast('Unit Requird')
            }else{

                $('#update-modal').modal('hide')
                let formData=new FormData();
                formData.append('img',updateProductImg) 
                formData.append('id',productID)   
                formData.append('name',updateProductName)
                formData.append('category_id',UpdateProductCategory)
                formData.append('price',updateProductPrice)
                formData.append('unit',updateProductUnit)         
                formData.append('file_path',imagePATH)   
                     

                let configuer={
                    headers:{
                        'content-type':'multipart/form-data'
                    }
                }
                showLoader()
                let res=await axios.post('/product-update',formData,configuer)
                hideLoader()
                if(res.status===200 && res.data===1){
                    successToast("Product Updated")                
                    document.getElementById("update-form").reset();
                    await productList()
                }else{
                    errorToast("Request Failed")
                }

            }
        
      }


</script>
