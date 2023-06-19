@extends('layouts.panel')

@section('title', 'add offer')

@section('content')
<h2 class="text-center bold">Add offers group </h2>

@if (session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

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

@if (Auth::user()->type_user === "content" && Auth::user()->etat === "desactive")
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-message">
            <strong>Compte desactivé</strong> Veillez contacter Administration pour l'activé.
        </div>
    </div>
@else
<a class="btn btn-info" href="{{ route('admin.offers.penddingOffers') }}">Pending group offers ({{ $groupOffersCount }})</a>
    <div class="bg-white p-3 border my-4">
        <form style="padding: 20px 0px; " action="{{  route('admin.offers.addoffergrouplist')  }}" method="POST" enctype= multipart/form-data>
            @csrf
            <div style="margin: 8px 0px;" class="form-group" style="margin: 20px 0px;">
                <label for="">Inserer les photos</label>
                <input  class="form-control" type="file" name="images[]" required multiple>
            </div>

            <div class="text-right">
                <button class="btn btn-info">Publier</button>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        wilaya1();
        //commune11();
        $('.com1').selectpicker();

        function test() {
            var t = $('#wilaya_etab').find(":selected").data("id");
            $(".com-container").html('<select name="commune_etab" required class="form-control mb-2 com1" data-live-search="true"></select>');
            if(t == 0){
                $(".com1").html('<option data-id="0" selected>Aucun</option>');
            }else{
                commune11(t);
            }
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
        }

        function loadEtab(e) {
            if(e.value == 0){
                $('#last').show()
            }else{
                $('#last').hide()
            }
        }

        function ar(e) {
            if(e.value == 0){
                $('#journal_ar').show()
            }else{
                $('#journal_ar').hide()
            }
        }

        function fr(e) {
            if(e.value == 0){
                $('#journal_fr').show()
            }else{
                $('#journal_fr').hide()
            }
        }

        var loadFile = function(event, lang) {
            if(lang == 'ar'){
                var output = document.getElementById('img_ar');
            }else{
                var output = document.getElementById('img_fr');
            }
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

    </script>
@endif

@endsection
