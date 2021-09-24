<?php
if(isset($_SESSION['login_info']['email_id']))
{
  $user_name = $_SESSION['login_info']['user_name'];
  $email_id = $_SESSION['login_info']['email_id'];
  

  $this->load->view('include/header.php'); 
?>

<body id="page-top">

    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

    <!-- Page Wrapper -->
    <div id="wrapper">

       <?php $this->load->view('include/sidebar.php');?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php $this->load->view('include/navbar.php');?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php
                    if(isset($result))
                    {
                    ?>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Update Product</h1>
                    <?php
                    }
                    else
                    {
                    ?>
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Add Product</h1>
                    <?php
                    }
                    ?>
                    <div class="card shadow mb-4 container center" style="margin-top: 50px;width: 70%;">
                        <div class="card-header py-3">
                        <?php
                        if(isset($result))
                        {
                        ?>
                        <!-- Page Heading -->
                        <h5 class="m-0 font-weight-bold text-primary">Update Product</h5>
                        <?php
                        }
                        else
                        {
                        ?>
                        <!-- Page Heading -->
                        <h5 class="m-0 font-weight-bold text-primary">Create new Product</h5>
                        <?php
                        }
                        ?>
                        </div>
                        <div class="card-body">
                            <form id="create_product">
                            <div class="row">
                                
                                <div class="col-md-6 form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control form-control-user" autocomplete="off" name="name" id="name" required
                                    value="<?php echo isset($result['name'])? $result['name'] :'';?>">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Price</label>
                                    <input type="text" autocomplete="off" class="form-control form-control-user" name="price" id="price" required onkeypress="return onlyNumberKey(event)"
                                    value="<?php echo isset($result['price'])? $result['price'] :'';?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Product Description</label>
                                    <textarea class="form-control form-control-user" name="description" id="description" required rows="3"><?php if(isset($result['description'])){echo $result['description'];}?></textarea>
                                    <script>
                                      CKEDITOR.replace('description');
                                   </script>
                                </div>
                                <div class="col-md-6"><input type="hidden" id="id" name="id" class="form-control" value="<?php echo isset($result['id'])? $result['id'] :0;?>"></div>
                                <div class="col-md-6 ">
                                <?php
                                if(isset($result))
                                {
                                ?>
                                    <button type="submit" class="btn btn-primary bg-gradient-primary shadow-sm float-right" style="width: 30%;">
                                       Update
                                    </button>
                                <?php
                                }
                                else
                                {
                                ?> 
                                    <button type="submit" class="btn btn-info bg-gradient-info shadow-sm float-right" style="width: 30%;">
                                       Add
                                    </button>
                                <?php
                                }
                                ?>
                                </div>

                            </div>
                        </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo base_url('logout');?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('include/footer.php'); ?>

<script type="text/javascript">

    function onlyNumberKey(evt) { 

      // Only ASCII charactar in that range allowed 
      var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
      if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
        return false; 
      return true; 
    } 
    
    $(document).ready(function(){

        $('#create_product').on('submit',function(e){
            e.preventDefault();
            
            for ( instance in CKEDITOR.instances ) 
            {
                CKEDITOR.instances['description'].updateElement();
            }

            $.ajax({

                    type:'post',
                    url:'<?php echo base_url("add_product");?>',
                    data:new FormData(this),
                    cache:false,
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {
                        if(data=='PRODUCT UPDATED')
                        {
                            alert(data);
                            window.location.replace("<?php echo base_url('dashboard');?>");
                        }
                        else if(data=='FAILED TO UPDATE PRODUCT')
                        {
                            alert(data);
                        }
                        else
                        {
                            alert(data);
                            console.log(data);
                            CKEDITOR.instances['description'].setData('');
                            $('#create_product')[0].reset();
                        }
                        
                    }

            })
        })

    })

</script>

<?php
}
else
{
    $url = base_url('login');
    header("location:$url");
}
?>