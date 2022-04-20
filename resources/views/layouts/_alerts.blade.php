@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fa fa-fw fa-circle-check"></i>
    <span>{{Session::get('success')}}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fa fa-fw fa-circle-exclamation"></i>
    <span>{{Session::get('error')}}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (Session::has('info'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <i class="fa fa-fw fa-circle-info"></i>
    <span>{{Session::get('info')}}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (Session::has('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <i class="fa fa-fw fa-circle-exclamation"></i>
    <span>{{Session::get('warning')}}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif