@extends('layouts.layout')

@section('title', 'Verification email')

@section('content')
    <div class="container d-flex align-items-center justify-content-center" style="height: 70vh">
        <form class="text-center">
            <div class="display-4 mb-4">Confirmez votre numéro de téléphone</div>
            <div class="d-flex justify-content-center">
                <div class="col-lg-4">
                    <input type="text" class="form-control" name="code">
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-4">Confirmer</button>
        </form>
    </div>
@endsection