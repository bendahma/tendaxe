@extends('layouts.panel')

@section('title', 'add user')

@section('content')

    <h2 class="text-center bold">Ajouter un representant</h2>

    @if(count($errors)>0)
    @foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
        {{$error}}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endforeach
    @endif

    <div class="bg-white p-3 border my-4">
        <form action="{{ route('admin.user.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bg-white border p-3" id="first">
                <h6 class="bold mb-3">Les information de représentant de l’établissment</h6>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="nom">Nom</label>
                        <input class="form-control bg-light" type="text" name="nom" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="prenom">Prenom</label>
                        <input class="form-control bg-light" type="text" name="prenom" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email">Email</label>
                        <input class="form-control bg-light" type="email" name="email" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="phone">Telephone</label>
                        <input class="form-control bg-light" type="phone" name="phone" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Mot de passe</label>
                        <input class="form-control bg-light" type="password" name="password" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Repeter votre mot de passe</label>
                        <input class="form-control bg-light" type="password" name="password_confirmation" required>
                    </div>
                </div>
            </div>
            <div class="bg-white border p-3" id="last">
                <h6 class="bold mb-3">Les informations sur l’établissment</h6>
                <div class="row">
                    <div class="col-md-6 form-group" id="nom_etab" style="display: none;">
                        <label for="nom_etab">Nom Etablissement</label>
                        <input class="form-control bg-light" type="text" name="nom_etab">
                    </div>
                    <div class="col-md-6 form-group" id="logo_etab" style="display: none;">
                        <label for="">logo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="logo" id="customFile">
                            <label class="custom-file-label bg-light" for="customFile">Choisir un logo</label>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Category</label>
                        <select name="category" required class="form-control mb-2 selectpicker" onchange="categ(this)" data-live-search="true">
                            <option value="APC" data-tokens="APC">APC</option>
                            <option value="DTP" data-tokens="DTP">DTP</option>
                            <option value="DUCH" data-tokens="DUCH">DUCH</option>
                            <option value="OPGI" data-tokens="OPGI">OPGI</option>
                            <option value="DLEP" data-tokens="DLEP">DLEP</option>
                            <option value="AUTRE" data-tokens="AUTRE">AUTRE</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Wilaya</label>
                        <select onchange="test()" name="wilaya_etab" required class="wil1 form-control mb-2 selectpicker" data-live-search="true"></select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Commune</label>
                        <div class="com-container2">
                            <select name="commune_etab" required class="form-control mb-2 selectpicker com1" data-live-search="true"></select>
                        </div>
                    </div>
                   
                    <div class="col-md-6 form-group">
                        <label for="email">Email ou siteweb</label>
                        <input class="form-control bg-light" type="email" name="email_etab">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="fix">Telephone fix</label>
                        <input class="form-control bg-light" type="text" name="fix">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="phone">Fax</label>
                        <input class="form-control bg-light" type="text" name="fax">
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        wilaya1();
        $('.com1').selectpicker();

        function test() {
            var t = $('.wil1').find(":selected").data("id");
            $(".com-container2").html('<select name="commune_etab" required class="form-control mb-2 selectpicker com1" data-live-search="true"></select>');
            commune11(t);
            $('.com1').selectpicker();
        }

        function categ(e) {
                if(e.value === "AUTRE"){
                    $("#nom_etab").show();
                    $("#logo_etab").show();
                }else{
                    $("#nom_etab").hide();
                    $("#logo_etab").hide();
                }
                //alert(e.value);
            }
    </script>
@endsection