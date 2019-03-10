@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible" style="margin-bottom:0 !important;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{Session::get('success')}}!</strong>
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible" style="margin-bottom:0 !important;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{Session::get('success')}}!</strong>
    </div>
@endif
