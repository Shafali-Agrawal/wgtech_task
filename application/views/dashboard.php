<?php
if(isset($_SESSION['login_info']['email_id']))
{
  $user_name = $_SESSION['login_info']['user_name'];
  $email_id = $_SESSION['login_info']['email_id'];
  

  $this->load->view('include/header.php'); 
?>

<body id="page-top">

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
$param = "add";
?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="<?php echo base_url('products/').$param;?>" class="d-none d-sm-inline-block btn btn-md btn-success bg-gradient-success shadow-sm">  <i class="fas fa-plus"></i> New Product</a>
                    </div>

                    <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Added by</th>
                                            <th>Created date</th>
                                            <th>Updated on</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Added by</th>
                                            <th>Created date</th>
                                            <th>Updated on</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody > 
<?php
$pid = 0;
$sql = "SELECT tproduct.id pid,tproduct.name pname,price,description,created_at,
               updated_at,tuser.name
        FROM products tproduct
        LEFT JOIN user tuser
        ON tproduct.add_by_user = tuser.id
        ORDER BY tproduct.id ";
$qry = $this->db->query($sql);
if($qry->num_rows()>0)
{
    foreach ($qry->result_array() as $key => $value) 
    {
        $pid = $value['pid'];
?>
                                        <tr>
                                            <td><?= $value['pname'];?></td>
                                            <td><?= $value['description'];?></td>
                                            <td><?= $value['price'];?></td>
                                            <td><?= $value['name'];?></td>
                                            <td><?= $value['created_at'];?></td>
                                            <td><?= $value['updated_at'];?></td>
                                            <td>
                                                <a href="<?php echo base_url('products/').$pid;?>" class="btn btn-sm btn-success shadow-sm btn-circle"><i class="fas fa-pencil-alt"></i></a><hr>
                                                <button onclick="dlt_data(<?= $pid;?>)" class="btn btn-sm btn-danger shadow-sm  btn-circle" data-toggle="modal" data-target="#dlt_modal"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>

<?php
    }
}

?>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
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

    <!-- Delete Modal -->
    <div class="modal fade" id="dlt_modal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Product</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure to delete this product?</div>
                <div class="modal-footer">
                    <input type="hidden" name="dlt_id" id="dlt_id">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="button" id="dlt_yes" onclick="delete_data()" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Modal -->

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
    
  function dlt_data(id)
  {
    $('#dlt_id').val(id);
    $('#dlt_modal').show();
  }

  function close_dlt()
  {
    $('#dlt_modal').hide();
  }

  function delete_data()
  {
    var id = $('#dlt_id').val();

    $.ajax({
            type:'post',
            url:"<?php echo base_url('delete_product');?>",
            data:{id:id},
            success: function(data)
            { 
                //alert(data);
                $('#dlt_modal').hide();
                location.reload();
            }
        });
  }

</script>

<?php
}
else
{
    $url = base_url('login');
    header("location:$url");
}
?>