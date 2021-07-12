@if($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <strong>
        <p>{{$error}}</p>
    </strong>
    @endforeach
</div>
@endif
@if (session()->has('message'))

<div class="alert alert-success">
    <strong>
        <p>{{session('message')}}</p>
    </strong>
</div>
@endif