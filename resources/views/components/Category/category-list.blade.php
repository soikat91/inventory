<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Category</h4>
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
                    <th>Category</th>
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
    getList()
    async function getList(){

       showLoader()
        let res=await axios.get("/list-category")
       hideLoader()

       //full table k dhora hoice    
        let tableData=$("#tableData")//jquery style a likha
        // table body k dhora hoice
        let tableList=$("#tableList")//jquery style a likha
        
        // table ta k mane data table k distroy or empty kore tarpor loop ghurabo

        tableData.DataTable().destroy();
        tableList.empty();
        res.data.forEach(function(item,index){//call back function ....eknae 2 ta jinsh pabo 
            //let row=document.getElementById('tableList');
              let row =`<tr>
                        <td>${index+1}</td>
                        <td>${item.name}</td>
                        <td>
                            <button data-id=${item.id} class="edit btn btn-sm btn-outline-primary">Edit</button>
                            <button data-id=${item.id} class="delete btn btn-sm btn-outline-primary">Delete</button>
                        </td>
                    </tr>`
              tableList.append(row)
        })        

      //specific row er id dhorte hobe ---post back kore korbo na----id diye dhre kj krbo
        //jquery work kora hoice karon data tables use krbo
      $('.edit').on('click',function(){
            let id=$(this).data('id')
            alert(id);

      })

      $('.delete').on('click',function(){

        let id=$(this).data('id')
        alert(id)

      })
      //datatable work
      tableData.DataTable({
        lengthMenu:[1,5,10,10,20,30,40,50],
        language:{
            paginate:{
                next:'&#8594;',
                previous:'&#8592;',
            }
        }
      });
     }

  


</script>