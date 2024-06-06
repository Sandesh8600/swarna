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
      
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex flex-row justify-content-between align-items-center" id="dttable"> 
                            <div class="col-8"><h4>Gold Melting Calculation Form</h4></div>                             
                            <div class="col-4 text-right">
                                <a class="mr-3 btn btn-outline-secondary btn-sm" role="button" role="button" 
                                    data-toggle="modal" data-target="#addReceiptModal" data-backdrop="false" 
                                    ><i class="fa fa-plus"></i> Add Receipt</a>
                                <a class="btn btn-outline-secondary btn-sm" role="button" 
                                    data-toggle="modal" data-target="#addPureGoldModal" data-backdrop="false" 
                                    ><i class="fa fa-plus"></i> Add Pure Gold</a>
                            </div>          
                        </div>
                        <div class="card-block mt-3">
                            <form class="form-horizontal" id="addGcal" method="post" action="<?php echo site_url("GoldCalculation/create"); ?>">
                                <div class="col-md-12 table-responsive">
                                    <table id="gmRecords" class="table table-striped table-bordered nowrap" style="width:100%;  font-size:13px;">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Sl.No.</th>
                                                <th>Type</th>
                                                <th>Gold Grams</th>
                                                <th>Std %</th>
                                                <th>%</th>
                                                <th>Diff %</th>
                                                <th>Less in pure gms</th>
                                                <th>Customer</th>
                                                <th>Item</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="details">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td><strong>Copper 8% on pure gold</strong></td>
                                                <td><input type="text" class="form-control" name="copper_for_pure_gold" id="copper_for_pure_gold" readonly required /></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><strong>Less in pure total</strong></td>
                                                <td><input type="text" class="form-control" name="less_in_pure_total" id="less_in_pure_total" required /></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                             <tr>
                                                <td></td>
                                                <td><strong>Final Copper</strong></td>
                                                <td><input type="text" class="form-control" name="final_copper" id="final_copper" onkeyup="gold_calculation();" required /></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><strong>Melting Loss in Grams</strong></td>
                                                <td><input type="text" class="form-control" name="melting_loss_grams" id="melting_loss_grams" onkeyup="gold_calculation();" required /></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><strong>Final Gold</strong></td>
                                                <td><input type="text" class="form-control" name="final_gold_grams" id="final_gold_grams" readonly required /></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="col-md-12 d-flex justify-content-right align-items-end mb-3">
                                    <div class="col-8"></div>
                                    <input type="submit" class="form-control btn btn-outline-secondary btn-sm mr-2" name="submit" id="submit" value="Submit" />
                                    <a class="form-control btn btn-outline-secondary btn-sm" id="cancel" href="<?php echo site_url("GoldCalculation/browse"); ?>">Go Back</a>                                
                                </div>
                            </form>
                        </div>
                    </div><!--End card -->
                </div><!--End col-md-12 -->
            </div><!--End Row -->
        </div><!--End Container fluid -->
    </section>

    <!-- Add Receipt Model -->
    <div class="modal fade" id="addReceiptModal" data-backdrop="static" role="dialog">
      <div class="modal-dialog modal-xl modal-dialog-centered" role="document"><!-- Model Dialog -->
        <div class="modal-content sl-modal-content"><!-- Model Content -->                
          <div class="modal-header sl-modal-header"><!-- Model Header -->
            <h5><i class="fa fa-arrows-v" aria-hidden="true"></i> Gold Receipt Table </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div><!-- \Model Header -->
          <div class="modal-body sl-modal-body"> <!-- Model Body -->
            <div class="row tranModal"> <!-- Row -->                    
              <div class="col-md-12" style='overflow-x:auto;'><!-- col-6 -->
                <table id="dtReceiptpop" class="table table-striped table-bordered nowrap" style="width:100%; font-size:13px;">			
                  <thead>
                    <tr>
                      <th>Receipt ID.</th>					          
                      <th>Order Id</th>
                      <th>Customer</th> 
                      <th>Grams</th>		
                      <th>Melting Loss</th>						
                      <th>Quality %</th>
                      <th>Net Weight</th>
                      <th>Date Received</th>
                      <th>J Items</th>
                      <th>Status</th>
                      <th>Select</th>
                    </tr>
                  </thead>                  
                </table>                                                              
              </div><!-- \col-6 --> 
              <div class="col-md-12 d-flex justify-content-right align-items-end mb-3 mt-3">
                <div class="col-9"></div>
                <div class="col-3 text-right">
                    <button class="btn btn-outline-secondary btn-sm mr-2 addmore" type="button" tabindex="-1"><i class="fa fa-plus"></i> Move to gold calculation</button>
                </div>
              </div>                  
            </div><!-- \Row -->
          </div><!-- \Model Body -->  
        </div><!-- \Model Content -->
      </div><!-- \Model Dialog -->
    </div>
    <!-- \Add receipt Model -->

    <!-- Add pure gold Model -->
    <div class="modal fade" id="addPureGoldModal" data-backdrop="static" role="dialog">
      <div class="modal-dialog modal-xl modal-dialog-centered" role="document"><!-- Model Dialog -->
        <div class="modal-content sl-modal-content"><!-- Model Content -->                
          <div class="modal-header sl-modal-header"><!-- Model Header -->
            <h5><i class="fa fa-arrows-v" aria-hidden="true"></i> Inventory Table </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
          </div><!-- \Model Header -->
          <div class="modal-body sl-modal-body"> <!-- Model Body -->
            <div class="row tranModal"> <!-- Row -->                    
              <div class="col-md-12"><!-- col-6 -->
                <table id="dtInventorypop" class="table table-striped table-bordered nowrap" style="width:100%;  font-size:13px;">			
                  <thead>
                    <tr>
                      <th>Metal Id</th>					          
                      <th>Metal Type</th>
                      <th>Balance Grams</th>
                      <th>Required Grams</th>
                      <th>Action</th>
                    </tr>
                  </thead>                  
                </table>                                                              
              </div><!-- \col-6 --> 
              <div class="col-md-12 d-flex justify-content-right align-items-center mb-3 mt-3">
                <div class="col-9">
                </div>
                <div class="col-3 text-right">
                <button class="btn btn-outline-secondary btn-sm mr-2 addInv" type="button" tabindex="-1"><i class="fa fa-plus"></i> Move to gold calculation</button>
                </div>
              </div>                  
            </div><!-- \Row -->
          </div><!-- \Model Body -->  
        </div><!-- \Model Content -->
      </div><!-- \Model Dialog -->
    </div>
    <!-- \Add Member Model -->
    
<script>
	
  //calculation
  function gold_calculation(){
	  
	total_receipt_gold=0;  
	$('.gold-receipt-item').each(function(){
		
		total_receipt_gold+= parseFloat($(this).val());
		
	});
	
	total_pure_gold=0;  
	$('.pure-gold-item').each(function(){
		
		total_pure_gold+= parseFloat($(this).val());
		
	});
	
	total_less_in_pure=0;  
	$('.less-in-pure-item').each(function(){
		
		total_less_in_pure+= parseFloat($(this).val());
		
	});
	
	actual_pure_gold=0;
	
	$('.pure_gold_check:checked').each(function(){
		
		//total_pure_gold+= parseFloat($(this).val());
		
		gold_grams=$('#goldgrams-'+$(this).val()).val();
		
		actual_pure_gold+=parseFloat(gold_grams);
		
	});
	
	//alert(actual_pure_gold);
	
	copper_needed=actual_pure_gold*8/100;
	
	
	
	balance_copper=copper_needed-total_less_in_pure;
	
	
	
	melting_loss_grams=($('#melting_loss_grams').val());
	
	melting_loss_grams=parseFloat(melting_loss_grams);
	
	melting_loss_grams_val=0;
	
	if(melting_loss_grams>0){
		
		melting_loss_grams_val=melting_loss_grams;
	}
  
  
	final_gold_grams=total_pure_gold+total_receipt_gold+balance_copper+melting_loss_grams_val;
	//final_gold_grams=final_gold_grams.toFixed(3);
	
	total_less_in_pure=total_less_in_pure.toFixed(3);
	
	$('#less_in_pure_total').val(total_less_in_pure);
	
	copper_needed=copper_needed.toFixed(3);
	
	$('#copper_for_pure_gold').val(copper_needed);
	
	balance_copper=balance_copper.toFixed(3);
	
	$('#final_copper').val(balance_copper);
	
	final_gold_grams=final_gold_grams.toFixed(3);
	
	$('#final_gold_grams').val(final_gold_grams);
  }	
	
  $(document).ready(function() {
    //Receipt popup
    var dtReceiptpop = $('#dtReceiptpop').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "columnDefs": [{ targets: [0], className: 'dt-center valign dt-w3' },
                    { targets: [1,2,3,4,5,6,7], className: 'dt-left valign dt-w25' },
                    {targets: [8], className: 'dt-center dt-w10 valign'}],
      dom: 'Bfrtip',
        buttons: [
            {extend:'copy', text:'<i class="fas fa-copy text-info"></i> Copy', titleAttr: 'Copy'}, 
            {extend:'csv', text:'<i class="fas fa-file-excel text-primary"></i> CSV <i class="fas fa-download text-dark"></i>', titleAttr:'csv'}, 
            {extend:'excel', text:'<i class="fas fa-file-excel text-primary"></i> Excel <i class="fas fa-download text-dark"></i>', titleAttr:'excel'}, 
            {extend:'pdf', text:'<i class="fas fa-file-pdf text-danger"></i> PDF <i class="fas fa-download text-dark"></i>', titleAttr:'pdf'}, 
            {extend:'print', text:'<i class="fas fa-print text warning"></i> Print', titleAttr:'print'}
        ],
      "ajax": "dtReceiptpop",
      "order": [] 
    });
    //inventory popup
    var dtInventorypop = $('#dtInventorypop').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "columnDefs": [],
      dom: 'Bfrtip',
        buttons: [
            {extend:'copy', text:'<i class="fas fa-copy text-info"></i> Copy', titleAttr: 'Copy'}, 
            {extend:'csv', text:'<i class="fas fa-file-excel text-primary"></i> CSV <i class="fas fa-download text-dark"></i>', titleAttr:'csv'}, 
            {extend:'excel', text:'<i class="fas fa-file-excel text-primary"></i> Excel <i class="fas fa-download text-dark"></i>', titleAttr:'excel'}, 
            {extend:'pdf', text:'<i class="fas fa-file-pdf text-danger"></i> PDF <i class="fas fa-download text-dark"></i>', titleAttr:'pdf'}, 
            {extend:'print', text:'<i class="fas fa-print text warning"></i> Print', titleAttr:'print'}
        ],
      "ajax": "dtInventorypop",
      "order": [] 
    });   
    //Table functionalities
    var box_html = $('<select><?php echo $val; ?></select>');
    // Handle checkbox selection
    $('#dtReceiptpop tbody').on('change', '.data-checkbox', function() {
      $(this).closest('tr').toggleClass('selected');
    });
    //adds extra table rows
    var i=$('#gmRecords tr').length; 
    //adding rows of datatable to table(receiptpop)
    
    
    
    $(".addmore").on('click',function(){ 
      var selectedRows = dtReceiptpop.rows('.selected').data();
      // $('#dtReceiptpop tbody').empty();
      
       
       
      $.each(selectedRows, function(index, value) {
		  
		  less_in_pure=(value[6]*(92.5-value[5])/100);
		  
		  
        $('#gmRecords tbody').append('<tr>\
            <td>' + i + '<br/>PG <input type="checkbox" class="pure_gold_check" name="pure_gold_check[]"  value="' +i+ '" onclick="gold_calculation();" title="Check if pure gold" ></td>\
            <td>Receipt<input type="hidden" name="receipts['+i+'][receipt_id]" value="' + value[0] + '" ></td>\
            <td><input type="text" class="form-control form-control-sm gold-gram-item gold-receipt-item" name="receipts['+i+'][net_weight]" id="goldgrams-'+i+'" value="' + value[6] + '" onkeyup="gold_calculation();" /></td>\
            <td><input type="text" class="form-control form-control-sm"  id="" value="92.5" /></td>\
            <td><input type="text" class="form-control form-control-sm" name="receipts['+i+'][purity]" id="" value="' + value[5] + '" /></td>\
            <td><input type="text" class="form-control form-control-sm" name="receipts['+i+'][diff_percent]" id="" value="' + (92.5-value[5]) + '" /></td>\
            <td><input type="text" class="form-control form-control-sm less-in-pure-item" name="receipts['+i+'][less_in_pure_grams]" id="" value="'+(less_in_pure.toFixed(3))+'" /></td>\
            <td><input type="text" class="form-control form-control-sm" name="receipts['+i+'][customer]" id="" value="' + value[2] + '" /></td>\
            <td><input type="text" class="form-control form-control-sm" name="receipts['+i+'][j_items]" id="" value="' + value[8] + '" /></td>\
            <td class="text-center"><button type="button" class="btn btn-outline-danger btn-xs remRow" onclick="$(this).closest(\'tr\').remove();"><span class="fa fa-minus"></span></button></td>\
            </tr>');
          // Add other columns as needed
          
          i++;
      });
      
      $('#dtReceiptpop tbody > tr').removeClass('selected');
      $('.data-checkbox').prop('checked', false);
      
      $('#addReceiptModal').hide();     
      
      gold_calculation();
       
    });

    //$('.remRow').on('click', function() {
      // event.preventDefault();
      //console.log("Button Clicked");
      //$(this).closest('tr').remove();
   // });

    // Handle checkbox selection
    $('#dtInventorypop tbody').on('change', '.data-checkbox', function() {
      $(this).closest('tr').toggleClass('selected');
    });
    //adding rows of datatable to table(inventorypop)
    $(".addInv").on('click',function(){ 
      var selectedRowss = dtInventorypop.rows('.selected').data();
      $.each(selectedRowss, function(index, value) {
		 
		required_grams=$('#pure-gold-quantity-'+value[0]).val();
	
		required_grams=parseFloat(required_grams);
		  
        $('#gmRecords tbody').append('<tr>\
            <td>' + i + '<br/>PG <input type="checkbox" class="pure_gold_check" name="pure_gold_check[]"  value="' +i+ '" onclick="gold_calculation();" title="Check if pure gold" ></td>\
            <td>Inventory<input type="hidden" name="pure_gold['+i+'][pure_gold_id]" value="' + value[0] + '" ><input type="hidden" name="pure_gold['+i+'][quantity]" value="' + required_grams + '" ></td>\
            <td><input type="text" class="form-control form-control-sm gold-gram-item pure-gold-item" name="pure_gold['+i+'][grams]" id="goldgrams-'+i+'" value="'+required_grams+'" onkeyup="gold_calculation();" /></td>\
            <td><input type="text" class="form-control form-control-sm" name="" id=""  /></td>\
            <td><input type="text" class="form-control form-control-sm" name="" id="" /></td>\
            <td><input type="text" class="form-control form-control-sm" name="" id="" value="" /></td>\
            <td><input type="text" class="form-control form-control-sm" name="" id="" value="" /></td>\
            <td><input type="text" class="form-control form-control-sm" name="" id="" value="From  Inventory" /></td>\
            <td>Pure Gold</td>\
            <td class="text-center"><button type="button" class="btn btn-outline-danger btn-xs remRow" onclick="$(this).closest(\'tr\').remove();"><span class="fa fa-minus"></span></button></td>\
            </tr>');
            
            $('#pure-gold-quantity-'+value[0]).val(0);
            
            i++;
      });
      
      $('#addPureGoldModal').hide(); 
      $('#dtInventorypop tbody > tr').removeClass('selected');
      $('.data-checkbox').prop('checked', false);
      
      
      gold_calculation();
      
           
    });//end addInv
  });//end doc ready function
  
  
  
</script>
