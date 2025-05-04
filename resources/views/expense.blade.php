<!DOCTYPE html>
<html lang="en">
    <head>
        <title>EXPENSE TRACKER</title>
	
    

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<!-- Include Flatpickr CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    </head>

<style>

    span.error-message {
        color: red !important;
        font-size: 0.875rem;
        margin-top: 5px;
    }
    
</style>

<body  >


    <div class="container" >
        <nav class="navbar navbar-expand-sm navbar-dark bg-success">
			<a href="#" class="navbar-brand" style="margin-left: 8px;">EXPENSE TRACKER</a>
			<div class="collapse navbar-collapse justify-content-center" >
				<ul class="navbar-nav" style="font-size: 20px;">
					<li class="nav-item"><a href="{{url('/expense')}}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{url('/userlist')}}" class="nav-link">Users</a></li>
				</ul>
			</div>
		 </nav>

    </div>	


    <div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            User Details
        </div>
        <div class="card-body">
            <form action="" name="form" id="form" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">User Name</label>
                    <input type="text" class="form-control" id="name" name="name" value=""  required>
                </div>

                <div class="mb-3">
                    <label for="amnt" class="form-label">Amount</label>
                    <input type="text" class="form-control" id="amnt" name="amnt" value="" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Category</label>
                    <select class="form-control form-select form-select-sm" id="ctg" name="ctg" aria-label=".form-select-sm example">
                        <option selected>Open this select menu</option>
                        <option value="Food">Food</option>
                        <option value="Travel">Travel</option>
                        <option value="Health">Health</option>
                        <option value="Entertainment">Entertainment</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-3">
                <label for="date" class="form-label">Date:</label>
                <input type="text" name="date" id="date" class="form-control" required>
                </div>


                <button type="button" id="submitbtn" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</div>

    


    

   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    
    
    <script type="text/javascript">

    flatpickr("#date", {
        dateFormat: "Y-m-d", // Format compatible with MySQL date type
    });

  
    $(function() {
    //Start mfrm form bvalidation
    $("#form").validate({
        onsubmit: false,
        onkeyup: false,
        onkeydown:false,
        onclick: false,
        onkeypress:false,
        onblur:true,
        ignore: [],
        rules: {

        
            name: {
                required: true
              
            },

            amnt: {
                required: true,   
                amntval: true  
            },

            ctg: {
                required: true,
            },

            date: {
                required: true,
            },

        
        },
        
        messages: {


            name: {
                required: "please enter name",
                  
            },

            amnt: {
                required: "please enter amount",
               
                
            },
        
            ctg: {
                required: "please enter category",
            },

            date: {
                required: "please select date",
            },

        },

        errorPlacement: function(error, element) {
            if(element.hasClass('form-select')){
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
    
            errorElement: "span",
          errorClass: "error-message"
    });



           $.validator.addMethod('amntval', function(value) {    
               
                if (value > 500) {
                    return false;
                }else{
                    return true;
                }
               
                 
           }, 'Amount should not be exceeded $500');

          
 });




 $(function() {
  
  $('#submitbtn').click(function(e) {
      if ($('#form').valid()) {
          
        sendAjax();
        
      }
      else {
          
          return false;
      }
  });
  
});


function sendAjax() {
 
 $.ajax({
     type: "POST",
     url: "/api/expenses",
     async: false,
     data: { 

         name : $('#name').val(),
         amnt : $('#amnt').val(),
         ctg: $("#ctg").val(),
         date: $("#date").val(),
     },
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     success: function (data, status) {
         console.log('data',data);
     
         if (data) {
             alert(data['message']);
             if (data['status'] == 'Success') {
                $('#form')[0].reset();
             }
             
         }
     },
 });
}

    
    </script>
    

   
   
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>


    
          
</body>


</html>