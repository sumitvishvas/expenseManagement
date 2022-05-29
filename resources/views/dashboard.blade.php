<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <!-- div start -->
                        <div class="page-content">

			<div class="row">
				<div class="col-xs-12">
					<h3 class="header smaller lighter blue">Daybook ledger</h3>

                    <div class="clearfix">
						<div class="pull-right tableTools-container" style="text-align: right;">
						</div>
					</div>
				
					<div class="table-header">
						Results for "Daybook Ledger"
						<div class="widget-toolbar no-border" style="text-align: right;margin: 25px;">
                        <a class="btn btn-xs bigger btn-danger dropdown-toggle" data-bs-toggle="modal" data-bs-target="#addDaybookModal" >
								Add 
								<i class="ace-icon fa fa-plus icon-on-right"></i>
							</a>
						</div>

					</div>

                   

					<!-- div.table-responsive -->

					<!-- div.dataTables_borderWrap -->
					<div>
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>

									<th>Date</th> 
                                    <th>Type</th>
									<th>Particular</th>
								    <th>Recepit No.</th> 
									<th width="100">Debit</th>
									<th width="100">Credit</th>
									
									<th width="100">Balance</th>
									
								</tr>
							</thead>

							<tbody>
							  @php
                              $balance=0;
                              @endphp
                                @if($ledgers!='')
                                @foreach($ledgers as $ledger)
            
                                    <tr>	
                                         <td>{{date("d-m-Y", strtotime($ledger->date))}}</td> 
            
                                         @if($ledger->credit != 0)
            
                                         <td>Income</td>
           
                                       
                                       @else
           
                                       <td>Expense </td>
           
           
                                       
           
                                       @endif
                                       
                                         <td>{{$ledger->particular}}</td>
            
                                       
                                        <td>{{$ledger->recepit_no}} </td>
                                        <td width="100">
                                            @if($ledger->debit != 0){{$ledger->debit}} 
                                        @endif</td>
                                        <td width="100">@if($ledger->credit != 0){{$ledger->credit}} @endif</td>
                                        @php
                                            if($ledger->debit != 0){
                                            $balance=$balance-$ledger->debit;
                                            }
                                            if($ledger->credit != 0){
                                            $balance=$balance+$ledger->credit;
                                            }
                                        @endphp
                                
                                    <td width="100">@if($balance < 0) {{abs($balance)}} Dr @else  {{abs($balance)}} Cr @endif</td>
            
                                    </tr>
                                @endforeach
                                    <tr>
                                      
                                        <td><b>Closing Balance</b></td>
                                        <td></td>
                                        <td ></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td width="100">@if($balance < 0)
            
            
                                         <b class="text-danger">{{abs($balance)}} Dr</b>
            
                                          @else
                                          <b class="text-success"> {{abs($balance)}} Cr  </b>
            
                                        @endif
                                    </td>
                                    </tr>
                            @endif
            
							</tbody>
						</table>
					</div>
				</div>
			</div>




		</div><!-- /.page-content -->


                </div>
            </div>
        </div>
    </div>

    <div class="modal fade in" id="addDaybookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Expense</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
			
      <div class="modal-body">

      <form action="{{URL('add-day-book')}}" method="POST" id="addDaybookForm">
         <div class="row">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
       

        <div class="col-md-6">
            <div class="form-group">
                <label for="expense_type">Type</label>
                <select name="type" id="type" class="form-control " >
                    <option value=""> Select Type </option>
                   
                    <option value="1">Income</option>
                    <option value="2">Expense</option>
                   
                </select>

                <span class="label label-danger" id="add_type_error" style="display: none;"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="payment_mode">Payment Mode</label>
            
                <select class="form-control checkIfValid " name="payment_mode" id="payment_mode" required="required">
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                            <option value="DD">DD</option>
                            <option value="NEFT">NEFT</option>
                            <option value="RTGS">RTGS</option>
                        </select>
                <span class="label label-danger" id="add_payment_mode_error" style="display: none;"></span>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" class="form-control convertHindi" name="amount" id="amount" placeholder="amount">
            </div>
            <span class="label label-danger" id="add_amount_error" style="display: none;"></span>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="bank">Bank</label>
                <select name="bank" id="bank" class="form-control " >
                    <option value=""> Select Bank </option>
                    @foreach ($banks as $bank)
                        
                    
                    <option value="{{$bank->id}}">{{$bank->name}}</option>
                    
                    @endforeach
                </select>
                <span class="label label-danger" id="add_bank_error" style="display: none;"></span>
            </div>
        </div>
        <div class="clearfix"></div>
                <div class="col-md-6">
                <div class="form-group">
                <label for="perticuler">Receipt No</label>
                <input type="text" class="form-control" name="receipt_no" id="receipt_no" placeholder="receipt_no">
                <span class="label label-danger" id="add_receipt_no_error" style="display: none;"></span>
            </div>
            </div>
            
        <div class="col-md-6">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control convertHindi" name="date" id="date" placeholder="Date">
                <span class="label label-danger" id="add_date_error" style="display: none;"></span>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="particular">Particular</label>
                <input type="text" class="form-control convertHindi" name="particular" id="particular" placeholder="perticuler">
                <span class="label label-danger" id="add_particular_error" style="display: none;"></span>
            </div>
        </div>

           
     
    </div>				
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="addDaybookBtn" class="btn btn-primary">Submit</button>
    </div>
</form>
</div>
		</div>
	</div>
</div>

</x-app-layout>
<script>
    jQuery(function($) {
    $('#addDaybookBtn').click(function(e){
                //alert('this is submit funciotn');
                $('.loading-bg').show();
                e.preventDefault();
                
                //console.log("abbre ffjdfkdjfkdfjdklf");
                $.ajax({						
                    url: $('#addDaybookForm').attr('action'),
                    method: 'POST',
                    data: $('#addDaybookForm').serialize(),
                    success: function(data){

                        console.log(data);
                        
                        if(data.flag==false){
                            $(".alert").remove();
                            $.each(data.errors, function (key,val) {

                                $("[name='" + key + "']").after("<div class='alert alert-danger'>" + val+ "</div>");

                            });
                            
                            
                        }else{
                            // window.location.reload();
                        swal({
                            title: "Success!",
                            text: data.message,
                            icon:'success',
                            type: "success"
                        }) .then((value) => {
                            if (value) {
                              window.location.reload();
                            }
                        });
                           

                        }
                    }

                });
            });
        });

</script>