<?php $this->load->view('include/header.php'); ?>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9 main-block">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form id="user_login" class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" name="email_id" 
                                                id="email_id" aria-describedby="emailHelp" autocomplete="off" required 
                                                placeholder="Enter Email Id">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" required
                                                id="password" placeholder="Password">
                                        </div>
                                        <button type="submit" name="login_btn" id="login_btn" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url('register'); ?>">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

<?php $this->load->view('include/footer.php');?>

<script type="text/javascript">
    $(document).ready(function(){

            $('#user_login').on('submit',function(e){
                e.preventDefault();

                $.ajax({

                        type:'post',
                        url:'<?php echo base_url("user_login");?>',
                        data:new FormData(this),
                        cache:false,
                        contentType:false,
                        processData:false,
                        success:function(data)
                        {
                            $('#user_login')[0].reset();
                            if(data=='success')
                            {
                                window.location.replace("<?php echo base_url('dashboard');?>");
                            }
                            else if(data=="user not found")
                            {
                             alert('The username or Password entered is not correct.');
                                location.reload();
                            }
                            else
                            {
                                alert('Something went wrong.Please try again.');
                            }
                        }
                        
                })
            })

    })
</script>