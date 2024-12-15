@if ($errors->any())
<div role="alert" class="alert alert-danger alert-dismissible">
    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
    <span class="icon"><i class="fa fa-times fa-fw fa-2x "></i></span>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</div>
@endif

@if (Session::has('fail'))
<div role="alert" class="alert alert-danger alert-dismissible">
    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
    <span class="icon"><i class="fa fa-times fa-fw fa-2x"></i></span>
    {{ Session::get('fail') }}
</div>
@endif
@if (Session::has('success'))
    <div role="alert" class="alert alert-success alert-dismissible">
        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
        <span class="icon"><i class="fa fa-check fa-fw fa-2x"></i></span>
        {{ Session::get('success')}}
    </div>
@endif
