@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row  ">
        <div class="col-md-8">
             <div class="jumbotron m-0 p-0 bg-transparent">
		<div class="row m-0 p-0 position-relative">
		  <div class="col-12 p-0 m-0 position-absolute" style="right: 0px;">
			<div class="card border-0 rounded" style="box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.10), 0 6px 10px 0 rgba(0, 0, 0, 0.01); overflow: hidden; height: 60vh;">

			  <div class="card-header p-1 bg-light border border-top-0 border-left-0 border-right-0" style="color: rgba(96, 125, 139,1.0);">
				
				<img class="rounded float-left" style="width: 50px; height: 50px;" src="https://via.placeholder.com/50x50" />
				
				<h6 class="float-left" style="margin: 0px; margin-left: 10px;"> {{ ucfirst($user->name) }} <br> <small>{{ $user->email }}</small> </h6>
					
			 
					
			  </div>
			
				<div class="card bg-sohbet border-0 m-0 p-0" style="height: 100vh;">
			  <div id="sohbet" class="card border-0 m-0 p-0 position-relative bg-transparent" style="overflow-y: auto; height: 46vh;">
            
              

           
			         
              </div>
              
			  </div>

			  <div class="w-100 card-footer p-0 bg-light border border-bottom-0 border-left-0 border-right-0">
				
				 
    
					  <div class="row m-0 p-0">
						<div class="col-9 m-0 p-1">
						
							<input id="text" class="mw-100 border rounded form-control" type="text" name="text" title="Type a message..." placeholder="Type a message..."  >
						  
						</div>
						<div class="col-3 m-0 p-1">
						
							<button type="button" id="send" class="btn btn-outline-secondary rounded border w-100" title=" " style="padding-right: 16px;">Send</button>
									
						</div>
					  </div>
				
		 
					
			  </div>

			</div><span class="typing"></span>
		  </div>
		  
		</div>
		
	  </div>

 
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Active Users</div>

                <div class="card-body" id ="active_users">
               
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
