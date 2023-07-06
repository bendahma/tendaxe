@extends('layouts.panel')

@section('title', 'add offer')

@section('content')
<h2 class="text-center bold">Add group of offers</h2>

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
@if ($groupOffersCount > 0)
    <a class="btn btn-info align-items-center" href="{{ route('admin.offers.penddingOffers') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader align-middle"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
    <span> Pending group offers ({{ $groupOffersCount }}) </span>
    </a>
@else
    <button class="btn btn-info align-items-center disabled " >
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader align-middle"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
    <span> Pending group offers ({{ $groupOffersCount }}) </span>
    </button>
@endif

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
