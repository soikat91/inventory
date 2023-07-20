<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Sign Up</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email"/>
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
                                <button onclick="onRegistration()" class="btn mt-3 w-100  btn-primary">Complete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

async function onRegistration(){
        let email=document.getElementById('email').value;
        let firstName=document.getElementById('firstName').value;
        let lastName=document.getElementById('lastName').value;
        let mobile=document.getElementById('mobile').value;
        let password=document.getElementById('password').value;

        if(email.length===0){
            errorToast("Email Requird")
        }else if(firstName.length===0){
            errorToast("First Name Requird")
        }else if(lastName.length===0){
            errorToast("Last Name Requird")
        }else if(mobile.length===0){
            errorToast("Mobile Requird")
        }else if(password.length===0){
            errorToast("Password Requird")
        }else{
           
            let url="/user-registration"
            showLoader();
            let response=await axios.post(url,{
                email:email,
                firstName:firstName,
                lastName:lastName,
                mobile:mobile,
                password:password
            })
            hideLoader();

            if(response.status===200 && response.data['status']=="success"){
                successToast("Registration Success")
              
                window.location.href="/login"
            }else{
                // errorToast("Something Went Wrong")
                errorToast(response.data['message']) //backend theke sms show korar jnno object er mordhe message ace tai data use kora hoice
            }

        }
    
    }
</script>