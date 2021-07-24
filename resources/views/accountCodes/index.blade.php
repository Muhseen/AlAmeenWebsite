@extends('layouts.soft')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <a href="/accountCodes/create" class="btn btn-info">Add New Account Code</a></div>
    </div>
    <table class="table table-responsive table-striped table-bordered table-hover">
        <tr>
            <th>Code</th>
            <th>Description</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach ($accountCodes as $ac)
        <tr>
            <td>{{$ac->Code}}</td>
            <td>{{$ac->Description}}</td>
            <td><a href="/accountCodes/{{$ac->id}}/edit" class="btn btn-info"> <i class="fa fa-edit"
                        aria-hidden="true">Edit</i> </a></td>
            <td>
                <form method="POST" action="/accountCodes/{{$ac->id}}"> @csrf @method('DELETE')<button
                        class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true">Delete</i> </button></form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection