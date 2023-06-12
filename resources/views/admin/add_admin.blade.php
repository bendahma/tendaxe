@extends('layouts.panel')

@section('title', 'add admin')

@section('content')
    <h3 class="text-center">Add admin</h3>
    <form class="bg-white p-3 my-3" action="{{ route('admin.admins.add') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="">nom</label>
                <input class="form-control" type="text" name="nom" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="">prenom</label>
                <input class="form-control" type="text" name="prenom" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="">email</label>
                <input class="form-control" type="email" name="email" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="">phone</label>
                <input class="form-control" type="text" name="phone" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="">password</label>
                <input class="form-control" type="password" name="password" required>
            </div>
            <div class="col-md-6 form-group">
                <label for="">password</label>
                <input class="form-control" type="password" name="password_confirmation" required>
            </div>
            <div class="col-md-6 form-group">
                <select class="form-control selectpicker" name="type_admin" id="">
                    <option value="admin" selected>Admin</option>
                    <option value="publisher">publisher</option>
                </select>
            </div>
            <div class="text-right">
                <button class="btn btn-info">Ajouter</button>
            </div>
        </div>
    </form>
@endsection