@if(session()->has('success'))
<div class="alert alert-dark-success alert-dismissible show">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{session('success')}}
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-dark-danger alert-dismissible show">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{session('error')}}
</div>
@endif