<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Expense Tracker</title>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	
  
    <link rel="stylesheet" type="text/css" href="../../src/plugins/datatables/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="../../src/plugins/datatables/css/responsive.bootstrap4.min.css"/>
<!--<link rel="stylesheet" type="text/css" href="../../src/styles/style.css" />-->
<link rel="stylesheet" type="text/css" href="../../src/styles/core.css" />
   
    </head>

<body  >


    <div class="container" >
        <nav class="navbar navbar-expand-sm navbar-dark bg-success">
			<a href="#" class="navbar-brand" style="margin-left: 8px;">EXPENSE TRACKER</a>
			<div class="collapse navbar-collapse justify-content-center" >
				<ul class="navbar-nav" style="font-size: 20px;">
					<li class="nav-item"><a href="{{url('/expense')}}" class="nav-link">Home</a></li>
				</ul>
			</div>
		 </nav>

    </div>	


    <div class="container" id="usr">

    <div class="container">
        <div class="card-box mb-30">
						
						<div class="pb-20" style="margin-top: 20px;">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                            <tr>
                                
                                <th>User Name</th>
                                
                                <th>category</th>
                               
                                <th class="datatable-nosort">View</th>
                                
                            </tr>
							</thead>

                            <tbody>

                            @foreach ($emplyee as $emp)
                                   <tr role="row" class="odd">
                                        
                                        <td>{{ $emp->name }}</td>
                                        
                                        <td>{{ $emp->category }}</td>
                                    
                                        <td>
                                            <a href="#" data-id="{{ $emp->user_id }}" data-date="{{ $emp->date }}" class="btn-block view btn btn-warning btn-sm" type="button">View</a>

                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>

                        </table>
						</div>
					</div>

           </div>



</div>




<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="checkstsmdl" aria-hidden="true"
        style="display: none;" id="checkstsmdl" name="checkstsmdl" data-bs-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"><i class="mdi mdi-floppy me-1">&nbsp;</i> Check Status of Ticket</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                <div class="col-md-12">
                <table class="table table-striped">
                    <tbody>
                        <tr><th>Name</th><td id="usrname"></td></tr>
                        <tr><th>Date</th><td id="usrdate"></td></tr>
                        <tr><th>Total</th><td id="usrtotl"></td></tr>
                        <tr><th>Expense</th><td id="usrexp"></td></tr>
                    </tbody>
                </table>
                </div>
                
                    
                </div>
                <div class="modal-footer">
                    
                    <button type="button" id="close" class="btn btn-primary">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>

    


    

   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    
    
    <script type="text/javascript">


$('#close').on('click', function () {
    $('#checkstsmdl').modal('hide');
});


$('.view').on('click',function(){

    var uid = $(this).data('id');
    var date = $(this).data('date');

    $.ajax({
     type: "GET",
     url: "/api/expense/daily-summary",
     async: false,
     data: { 

         user_id: uid,
         date: date
     },
     
     success: function (data, status) {
         console.log('data',data);
         $("#checkstsmdl").modal("toggle");
     
         if (data) {
             $("#usrname").html(data['name']);
             $("#usrdate").html(data['date']);
             $("#usrtotl").html(data['total']);
             $("#usrexp").html(data['expenses']);
         }
     },

     error: function(xhr, status, error) {
        console.error('Error:', error);
    }

 });

});




    
    </script>
    
   
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>



    <!-- DataTables JS -->
<script src="../../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="../../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="../../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="../../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>

<!-- DataTables Buttons and Export functionality -->
<script src="../../src/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="../../src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
<script src="../../src/plugins/datatables/js/buttons.print.min.js"></script>
<script src="../../src/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="../../src/plugins/datatables/js/buttons.flash.min.js"></script>
<script src="../../src/plugins/datatables/js/pdfmake.min.js"></script>
<script src="../../src/plugins/datatables/js/vfs_fonts.js"></script>

<!-- Datatable Setting JS -->
<script src="../../src/scripts/datatable-setting.js"></script>
    
          
</body>


</html>