<?php $this->load->view('include/header.php'); ?>

<body class="bg-gradient-primary">

    <div class="container" style="margin-top:140px;">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" id="register_form">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="firstname" name="firstname" required placeholder="First Name" autocomplete="off">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="lastname" name="lastname" required placeholder="Last Name" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email" required placeholder="Email Address" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <p style="color: red;" id="error_email"></p>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="password" required 
                                            id="password" placeholder="Password" minlength="5">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="repeatpassword" required id="repeatpassword" placeholder="Repeat Password" minlength="5">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p style="color: red;" id="error_msg"></p>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?php echo base_url('login'); ?>">Already have an account? Login!</a>
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

        $('#register_form').on('submit',function(e){
            e.preventDefault();

            $.ajax({

                type:'post',
                url:'<?php echo base_url("register_form"); ?>',
                data:new FormData(this),
                cache:false,
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if(data=='password_error')
                    {
                        $('#error_msg').html("Please make sure your passwords match.").delay('slow').fadeOut(15000);
                        $('#password').val("");
                        $('#repeatpassword').val("");
                    }
                    else if(data=='email_exists')
                    {
                        $('#error_email').html("Email already exists.").delay('slow').fadeOut(15000);
                        $('#email').val("");
                    }
                    else if(data=='register successfull')
                    {
                        $('#register_form')[0].reset();
                        alert('Registration completed successfully.\nPlease Login.');
                        window.location.replace("<?php echo base_url('login');?>");
                    }
                    else
                    {
                        alert('Something went wrong.Please try again.');
                        $('#register_form')[0].reset();
                    }
                }

            })
        })
    })

</script>
