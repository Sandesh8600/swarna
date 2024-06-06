<style>
    .center {
    margin-top:50px;   
}

.modal-header {
	padding-bottom: 5px;
}

.modal-footer {
    	padding: 0;
	}
    
.modal-footer .btn-group button {
	height:40px;
	border-top-left-radius : 0;
	border-top-right-radius : 0;
	border: none;
	border-right: 1px solid #ddd;
}
	
.modal-footer .btn-group:last-child > button {
	border-right: 0;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Inventory</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary" id="dttable">
                            <h5>Add Inventory</h5>
                            <span>Fill the form to add new Inventory. All fields are mandatory.</span>   
                            <div class="card-header-right" style="float:right;">
                                <a class="mr-3 text-white btn btn-danger btn-sm" role="button" href="browse"><i class="fas fa-back-arrow"></i> Go Back</a>
                            </div>          
                        </div>
                        <div class="card-block tab-icon">
                            <form class="form-horizontal" id="addInv" method="post" action="addInventory">
                                <div class="col-md-12">
                                    <div class="row p-3">
                                        <div class="col-sm-4 mt-3">
                                            <div class="form-group">
                                                <label for="metal_type" class="control-label">Metal Type</label>
                                                <select class="form-control" name="metal_type" id="metal_type">
                                                    <option value="0">Not Selected</option>
                                                    <option value="gold">Gold</option>
                                                    <option value="silver">Silver</option>
                                                    <option value="platinum">Platinum</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mt-3">
                                            <div class="form-group">
                                                <label for="metal_shape" class="control-label">Metal Shape</label>
                                                <select class="form-control" name="metal_shape" id="metal_shape">
                                                    <option value="0">Not Selected</option>
                                                    <option value="bar">Bar</option>
                                                    <option value="biscuit">Biscuit</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mt-3">
                                            <div class="form-group">
                                                <label for="metal_purity" class="control-label">Metal Purity %</label>
                                                <input type="number" step="0.01" class="form-control" id="metal_purity" name="metal_purity" placeholder="%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pl-3 pr-3">
                                        <div class="col-sm-4 mt-3">
                                            <div class="form-group">
                                                <label for="gpu" class="control-label">Grams Per Unit</label>
                                                <input type="number" step="0.01" class="form-control" id="gpu" name="gpu" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mt-3">
                                            <div class="form-group">
                                                <label for="quantity" class="control-label">Quantity</label>
                                                <input type="number" step="0.01" class="form-control" id="quantity" name="quantity" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mt-3">
                                            <div class="form-group">
                                                <label for="shop_name" class="control-label">Shop Name</label>
                                                <input type="text" class="form-control" id="shop_name" name="shop_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-4 text-right">
                                        <div class="col-md-12">                                            
                                            <button type="submit" name="submitapp" id="submitapp" class="btn btn-outline-dark" tabindex="-1">Submit</button>
                                            <a href="appointment" class="btn btn-outline-dark">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!--End card -->
                </div><!--End col-md-12 -->
            </div><!--End Row -->
        </div><!--End Container fluid -->
    </section>
    
    <script>
    //To Select the Image And Save the Data
    $(document).ready(function(){
        $("#submitapp").on('click', function(e) {                
            // remove the error 
            $(".form-group").removeClass('has-error').removeClass('has-success');
            $(".text-danger").remove();
            $("#addInv").unbind('submit').bind('submit', function() {
            $(".text-danger").remove();
            var form = $(this);
            // validation                 
            var metal_type = $("#metal_type").val();
            var metal_shape = $("#metal_shape").val();
            var metal_purity = $("#metal_purity").val();
            var gpu = $("#gpu").val();
            var quantity = $("#quantity").val();
            var shop_name = $("#shop_name").val();

            if(metal_type == "0") {
                    $("#metal_type").closest('.form-group').addClass('has-error');
                    $("#metal_type").after('<p class="text-danger error-text">Please select metal type!</p>');
            } else {
                    $("#metal_type").closest('.form-group').removeClass('has-error');
                    $("#metal_type").closest('.form-group').addClass('has-success');                   
            }    
            if(metal_shape == "0") {
                    $("#metal_shape").closest('.form-group').addClass('has-error');
                    $("#metal_shape").after('<p class="text-danger error-text">Please select metal shape!</p>');
            } else {
                    $("#metal_shape").closest('.form-group').removeClass('has-error');
                    $("#metal_shape").closest('.form-group').addClass('has-success');                   
            }   
            if(metal_purity == "") {
                    $("#metal_purity").closest('.form-group').addClass('has-error');
                    $("#metal_purity").after('<p class="text-danger error-text">Please enter metal purity!</p>');
            } else {
                    $("#metal_purity").closest('.form-group').removeClass('has-error');
                    $("#metal_purity").closest('.form-group').addClass('has-success');                   
            } 
            if(gpu == "") {
                    $("#gpu").closest('.form-group').addClass('has-error');
                    $("#gpu").after('<p class="text-danger error-text">Please enter grams per unit!</p>');
            } else {
                    $("#gpu").closest('.form-group').removeClass('has-error');
                    $("#gpu").closest('.form-group').addClass('has-success');                   
            } 
            if(quantity == "") {
                    $("#quantity").closest('.form-group').addClass('has-error');
                    $("#quantity").after('<p class="text-danger error-text">Please enter quantity!</p>');
            } else {
                    $("#quantity").closest('.form-group').removeClass('has-error');
                    $("#quantity").closest('.form-group').addClass('has-success');                   
            } 
            if(shop_name == "") {
                    $("#shop_name").closest('.form-group').addClass('has-error');
                    $("#shop_name").after('<p class="text-danger error-text">Please enter shop name!</p>');
            } else {
                    $("#shop_name").closest('.form-group').removeClass('has-error');
                    $("#shop_name").closest('.form-group').addClass('has-success');                   
            } 

            if(metal_type && metal_shape && metal_purity && gpu && quantity && shop_name) {
                $.ajax({
                url : form.attr('action'),
                type : form.attr('method'),
                data : form.serialize(),
                dataType : 'json',
                success:function(response) {
                    // remove the error 
                    $(".form-group").removeClass('has-error').removeClass('has-success');

                    if(response.success == true) {
                    // reset the form
                    $("#addInv")[0].reset();
                    $(function() {
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top',
                        target: '#addModal',
                        showConfirmButton: false,
                        timer: 3000
                        });
                        Toast.fire({
                        icon: 'success',
                        title: 'Inventory Added Successfully'
                        });
                    }); 
                                 
                    } else {
                        $(function() {
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top',
                        target:"#addModal",
                        showConfirmButton: false,
                        timer: 3000
                        });
                        Toast.fire({
                        icon: 'error',
                        title: 'Ooops! something went wrong. Please retry'
                        });
                    });
                    }  // /else
                } // success  
                }); // ajax subit   
            }
            return false;
            });    
        });
    });
</script>