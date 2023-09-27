<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hallo Dwi Purnomo..</div>
                  <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}  
                        </div>
                    @endif
                   {!! $body !!}
               </div>
           </div>
       </div>
   </div>
</div>