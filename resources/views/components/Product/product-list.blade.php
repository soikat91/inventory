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
                    <th>Icon</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Unit</th>
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
    productList()
    // async function productList() {

    //     let url='/product-list'
    //     showLoader()
    //     let res=await axios.get(url); 
    //     hideLoader()
    //     let tableList=$('#tableList');
    //     let tableData=$('#tableData');
    //     res.data.forEach(function(item,index){

    //         let row=`
    //             <tr>
    //                 <td>${index+1}</td>
    //                 <td><img class="w-15" src="/${item.image_url}"></td>
    //                 <td>${item.name}</td>
    //                 <td>${item.price}</td>
    //                 <td>${item.unit}</td>                 
    //                 <td>
    //                     <button data-path="${item.image_url}" data-id=${item.id} class="edit btn btn-sm btn-outline-primary">Edit</button>
    //                     <button data-path="${item.image_url}" data-id=${item.id} class="delete btn btn-sm btn-outline-primary">Delete</button>
                        
    //                 </td>
    //             </tr>

    //         `
    //         tableList.append(row)
            
    //     })

    //     // $('.edit').on('click',function(){

    //     //     let id=$(this).data('id');
    //     //     alert(id)
    //     // })
    //     $('.delete').on('click',function(){

    //         let id=$(this).data('id');
    //         let path=$(this).data('path');

    //         $('#delete-modal').modal('show');
    //          $('#productId').val(id)
    //          $('#imagePath').val(path)
    //        // alert(path)
    //     })


    //     tableData.DataTable({
    //         lengthMenu:[5,10,10,20,30,40,50],
    //             language:{
    //                 paginate:{
    //                     next:'&#8594;',
    //                     previous:'&#8592;',
    //                 }
    //             }
    //     })
        
    // }

    productList()

    async function productList(){
            showLoader()
            let res=await axios.get('/product-list');
            hideLoader()
            let tableData=$('#tableData');//jquery
            let tableList=$('#tableList');//jquery

            tableData.DataTable().destroy()
            tableList.empty()

            res.data.forEach(function(item,index){

                let row=`
                        <tr>
                            <td>${index+1}</td>
                            <td><img class="w-15" src="/${item.image_url}"></td>
                            <td>${item.name}</td>
                            <td>${item.price}</td>
                            <td>${item.unit}</td>                        
                            <td>
                                <button data-path="${item.image_url}" data-id=${item.id} class="edit btn btn-sm btn-outline-primary">Edit</button>
                                <button data-path="${item.image_url}" data-id=${item.id} class="delete btn btn-sm btn-outline-primary">Delete</button>
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
                let path=$(this).data('path');
                // alert(id)
                alert(path)
                productId(id,path)         
                $('#update-modal').modal('show')
            })

            $('.delete').on('click',function(){
                let id=$(this).data('id')
                let path=$(this).data('path');
                //alert(id)
                $('#delete-modal').modal('show')
                $('#productId').val(id)
                $('#imagePath').val(path)

            })


            tableData.DataTable({
                order:[['0','desc']],
                lengthMenu:[5,10,10,20,30,40,50],
                language:{
                    paginate:{
                        next:'&#8594;',
                        previous:'&#8592;',
                    }
                }
            })

        }
</script>
