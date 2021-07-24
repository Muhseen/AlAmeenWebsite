@if($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <p style="color:white;">
        <strong>
            {{$error}}
        </strong>
    </p>
    @endforeach
</div>
@endif
@if (session()->has('message'))

<div class="alert alert-success">
    <strong>
        <p style="color:white;">{{session('message')}}</p>
    </strong>
</div>
@endif