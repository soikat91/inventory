<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form id="updateData">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name *</label>
                                <input type="text" class="form-control" id="customerNameUpdate">
                                <input type="text" class="form-control" id="customerID">
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Email *</label>
                                <input type="text" class="form-control" id="customerEmailUpdate">
                                
                            </div>
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Mobile*</label>
                                <input type="text" class="form-control" id="customerMobileUpdate">
                                
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
      
      async function getCustomerId(id){
            
        document.getElementById('customerID').value=id;
        
        let res = await axios.post('/customer-by-id',{ id:id })
       // let res=await axios.post('/customer-by-id',{id:id})
        document.getElementById('customerNameUpdate').value=res.data['name']
        document.getElementById('customerEmailUpdate').value=res.data['email']
        document.getElementById('customerMobileUpdate').value=res.data['mobile']

      }

      $('#updateData').on('submit',async function(e){
        e.preventDefault();
        // alert('hi')
        let customerNameUpdate=document.getElementById('customerNameUpdate').value
        let customerEmailUpdate=document.getElementById('customerEmailUpdate').value
        let customerMobileUpdate=document.getElementById('customerMobileUpdate').value
        let customerID=document.getElementById('customerID').value
        
        if(customerNameUpdate.length===0){
            errorToast('Name Required')

        }else if(customerEmailUpdate.length===0){

            errorToast('Email Required')
        }else if(customerMobileUpdate.length===0){

            errorToast('Mobile Required')             
        }else{
            $('#update-modal').modal('hide')
            showLoader()
            let res=await axios.post('/update-customer',{
                id:customerID,
                name:customerNameUpdate,
                email:customerEmailUpdate,
                mobile:customerMobileUpdate
            })
            hideLoader()

            if(res.data===1){
                
                successToast('Updated Success')
                $('#update-modal').trigger("reset")
                getCustomer()
                
            }else{

                errorToast("Request Failed")    
            }
        }

      
       

      })



</script>