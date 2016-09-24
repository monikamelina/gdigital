@extends('layouts.app')

@section('content')
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Users</h3>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Admin</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key => $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->isAdmin() }}</td>
                    <td>
                    <a class="btn btn-xs btn-info" href="{{ url('admin/users/' . $user->id) }}">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    <a class="btn btn-xs btn-success" href="{{ url('admin/users/' . $user->id . '/edit') }}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <a class="btn btn-xs btn-danger" href="#" onclick="event.preventDefault(); document.getElementById('del-user').submit();">
                        <i class="fa fa-trash-o"></i>
                    </a>
                    <form id="del-user" action="{{ url('admin/users/' . $user->id) }}" method="POST" style="display: none;">
                        <input type="hidden" name="_method" value="DELETE">
                        {{ csrf_field() }}
                    </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop