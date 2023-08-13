<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form id="updateData">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name *</label>
                                <input type="text" class="form-control" id="categoryNameupdate">
                                <input type="text" class="form-control" id="categoryID">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="update-model-close" class="btn  btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button  type="submit" class="btn btn-sm  btn-success" >Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>

    async function getCategoryId(id) {

        document.getElementById('categoryID').value=id;        
        showLoader()
        let res=await axios.post('/get-category-id',{id:id})
        document.getElementById('categoryNameupdate').value=res.data['name']
        hideLoader()
        
    }

    // async function Update(){

    //     let categoryNameupdate=document.getElementById('categoryNameupdate').value
    //     let categoryID=document.getElementById('categoryID').value

    //     if(categoryNameupdate.length===0){
    //         errorToast('Name Required')
    //     }else{            
    //         document.getElementById('update-model-close').click()

    //         showLoader()
    //         let res=await axios.post('/update-category',{name:categoryNameupdate,id:categoryID})
    //         hideLoader()
    //         if(res.status===200 && res.data===1){
    //             successToast("Update Success")
    //         }else{
    //             errorToast("Failed Request")
    //         }

    //     }
    // }
    $('#updateData').on('submit',async function(e){
        e.preventDefault()
        let categoryNameupdate=document.getElementById('categoryNameupdate').value
        let categoryID=document.getElementById('categoryID').value
        if(categoryNameupdate.length===0){
            errorToast('Name Required')
        }else{          
            $('#update-modal').modal('hide') 
            // document.getElementById('update-model-close').click()        
            showLoader()
            let res=await axios.post('/update-category',{name:categoryNameupdate,id:categoryID})
            hideLoader()
            if(res.status===200 && res.data===1){
                successToast("Update Success")
                $('#update-modal').trigger("reset") //form reset korar jnno use kora hoice trigger holo jquery cls
                    await getList()
            }else{
                errorToast("Failed Request")
            }
            
        }

    })
</script>
