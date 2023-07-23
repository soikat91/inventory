<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>User Profile</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" readonly placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="mobile"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onUpdate()" class="btn mt-3 w-100  btn-primary">Save Change</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

  profileDetails();

  async function profileDetails(){

      showLoader();
      let res=await axios.get("/user-profile-details");
      hideLoader();

      if(res.status===200 && res.data['status']==="success"){
          let data=res.data['data'];
          document.getElementById('email').value=data['email'];
          document.getElementById('firstName').value=data['firstName'];
          document.getElementById('lastName').value=data['lastName'];
          document.getElementById('mobile').value=data['mobile'];
          document.getElementById('password').value=data['password'];
      }
      else{
          errorToast(res.data['message']);
      }
  }


  async function onUpdate(){

        let firstName=document.getElementById('firstName').value
        let lastName=document.getElementById('lastName').value
        let mobile=document.getElementById('mobile').value
        let password=document.getElementById('password').value

        if(firstName.lenght===0){
            errorToast("FirstName Required")
        }else if(lastName.lenght===0){
            errorToast("lastName Required")
        }else if(mobile.lenght===0){
            errorToast("mobile Required")
        }else if(password.lenght===0){
            errorToast("password Required")
        }else{

            showLoader();
            let res=await axios.post('/profile-update',{
                firstName:firstName,
                lastName:lastName,
                mobile:mobile,
                password:password,
        });
            hideLoader();
            if(res.status===200){
                successToast(res.data['message'])
               // await profileDetails();//reflesh er jnno call kora hoice
            }else{
                errorToast("false")
            }
        }
    
  }



    // async function onUpdate() {

    //     let password=document.getElementById('password').value;
    //     let firstName=document.getElementById('firstName').value;
    //     let lastName=document.getElementById('lastName').value;
    //     let mobile=document.getElementById('mobile').value;

    //      if(password.length===0){
    //         errorToast("Password Required !")
    //     }
    //     else if(firstName.length===0){
    //         errorToast("First Name Required")
    //     }
    //     else if(lastName.length===0){
    //         errorToast("Last Name Required")
    //     }
    //     else if(mobile.length===0){
    //         errorToast("Mobile Number Required !")
    //     }
    //     else{
    //         showLoader();
    //         let res=await axios.post("/user-update", {firstName:firstName, lastName:lastName,password:password, mobile:mobile})
    //         hideLoader();
    //         if(res.status===200 && res.data['status']==="success"){
    //             successToast(res.data['message']);
    //             await profileDetails();
    //         }
    //         else{
    //             errorToast(res.data['message']);
    //         }
    //     }
    // }
</script>
