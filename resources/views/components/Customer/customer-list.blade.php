<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Customer</h4>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 btn-sm bg-gradient-primary">Create</button>
                </div>
            </div>
            <hr class="bg-dark "/>
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Customer Name</th>
                    <th>Emnail</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList">
                {{--Table Data--}}
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>
        getCustomer()
        async function getCustomer(){
            showLoader()
            let res=await axios.get('/getCustomer');
            hideLoader()
            let tableData=$('#tableData');//jquery
            let tableList=$('#tableList');//jquery

            tableData.DataTable().destroy()
            tableList.empty()

            res.data.forEach(function(item,index){

                let row=`
                        <tr>
                            <td>${index+1}</td>
                            <td>${item.name}</td>
                            <td>${item.email}</td>
                            <td>${item.mobile}</td>                       
                            <td>
                                <button data-id=${item.id} class="edit btn btn-sm btn-outline-primary"> Edit</button> 
                                <button data-id=${item.id} class="delete btn btn-sm btn-outline-primary"> Delete</button>
                            </td>                       
                        </tr>
                    `
                   // protita customer er alada alad id dhorer jnno data-id  use kra hoice
                tableList.append(row)
            })
            // let editData=${'.edit'}
            // let deleteData=${'.delete'}

            $('.edit').on('click',function(){

                let id=$(this).data('id');
                alert(id)
            })

            $('.delete').on('click',function(){
                let id=$(this).data('id')
                alert(id)
            })


            tableData.DataTable({
                lengthMenu:[1,5,10,10,20,30,40,50],
                language:{
                    paginate:{
                        next:'&#8594;',
                        previous:'&#8592;',
                    }
                }
            })

        }
</script>