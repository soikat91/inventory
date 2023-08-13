
<div class="modal" id="delete-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="width: 450px;">

            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Once delete, you can't get it back.</p>
                <input type="text" id="productId">
                <input type="text" id="imagePath">
            </div>

            <!-- Modal footer -->
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="model-close" class="btn shadow-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="deleteData()" type="button" id="confirmDelete" class="btn shadow-sm btn-danger" >Delete</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>

    async function deleteData(){

        let productId=document.getElementById("productId").value
        let imagePath=document.getElementById("imagePath").value
        document.getElementById('model-close').click();
        showLoader();   
        let res=await axios.post('/product-delete',{id:productId,img_path:imagePath});
        hideLoader();
        if(res.data===1){
            successToast("Delete SuccessFull")
            await productList()
        }else{
            errorToast("Request Failed")
        }

    }
</script>