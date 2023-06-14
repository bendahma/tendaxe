<?php

use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Collection;

use App\Models\Wilaya;

$currenttime = date('Y-m-d');

$daystoadd = 15;

$datefinpub = date('Y-m-d', strtotime($currenttime . "+ $daystoadd days"));

/*$currentPage = 1;

$collect_pictures = collect($Array_pictures);

$offset = ($currentPage - 1) * 10;

$paginatedPicture = $collect_pictures->slice($offset, 10);



$pic = new LengthAwarePaginator($paginatedPicture, $collect_pictures->count(), 10, $currentPage);*/

?>

@extends('layouts.panel')



@section('title', 'add offer')



@section('content')

    <h2 class="text-center bold">List des offers non publié</h2>



    @if (session('error'))
        <div class="alert alert-danger" role="alert">

            {{ session('error') }}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>
    @endif



    @if (count($errors) > 0)

        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">

                {{ $error }}



                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>
        @endforeach

    @endif



    @if (Auth::user()->type_user === 'content' && Auth::user()->etat === 'desactive')

        <div class="alert alert-warning alert-dismissible" role="alert">

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            <div class="alert-message">

                <strong>Compte desactivé</strong> Veillez contacter Administration pour l'activé.

            </div>

        </div>
    @else
        @foreach ($penddingOffers as $key => $offer)
            <form action="{{ route('admin.offers.addoffergroup') }}" method="POST" enctype=multipart/form-data>
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"  style="width: 120px">Titre</span>
                                    </div>
                                    <input type="text" name="wilaya" class="form-control" value="{{ $offer->titre }}">
                                </div>
                                
                            </div>
                            <div class="col-md-6 text-right">
                                <img src="{{ asset('img/1.png') }}" alt="Logo" style="height: 40px">
                            </div>
                        </div>
<br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white" style="width: 120px">Annonceur</span>
                                    </div>
                                    <input type="text" name="annonceur" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"  style="width: 140px">Secteur</span>
                                    </div>
                                    <input type="text" name="secteur" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"  style="width: 120px">Journal</span>
                                    </div>
                                    <input type="text" name="journal" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"  style="width: 120px">Status</span>
                                    </div>
                                    <input type="text" name="status" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"  style="width: 140px">Date publication</span>
                                    </div>
                                    <input type="date" name="date_publication" class="form-control" id="datePublication">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"  style="width: 120px">Descritpuion</span>
                                    </div>
                                    <input type="text" name="description" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"  style="width: 120px">Wilaya</span>
                                    </div>
                                    <input type="text" name="wilaya" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white"  style="width: 140px">Date d'échéance</span>
                                    </div>
                                    <input type="date" name="date_echeance" class="form-control" id="dateEcheance">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 text-right">
                                <input type="submit" class="btn btn-primary" value="Enregistre">
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="{{ '#fullscreenModal' . $key }}">Voire</button>
                                <div class="modal fade" id="{{ 'fullscreenModal' . $key }}" tabindex="-1" role="dialog"
                                    aria-labelledby="fullscreenModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <img src="{{ asset('storage/'.$offer->titre) }}" alt="" style="max-width: 100%; max-height: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        @endforeach



        <div class="text-right">

            <button class="btn btn-info">Publier</button>





            <script type="text/javascript">
                wilaya1();

                //commune11();

                $('.com1').selectpicker();



                function test() {

                    var t = $('#wilaya_etab').find(":selected").data("id");

                    $(".com-container").html(

                        '<select name="commune_etab"  class="form-control mb-2 com1" data-live-search="true"></select>');

                    if (t == 0) {

                        $(".com1").html('<option data-id="0" selected>Aucun</option>');

                    } else {

                        commune11(t);

                    }

                    $('.com1').selectpicker();

                }



                function categ(e) {

                    if (e.value === "AUTRE") {

                        $("#nom_etab").show();

                        $("#logo_etab").show();

                    } else {

                        $("#nom_etab").hide();

                        $("#logo_etab").hide();

                    }

                }



                function loadEtab(e) {

                    if (e.value == 0) {

                        $('#last').show()

                    } else {

                        $('#last').hide()

                    }

                }



                function ar(e) {

                    if (e.value == 0) {

                        $('#journal_ar').show()

                    } else {

                        $('#journal_ar').hide()

                    }

                }



                function fr(e) {

                    if (e.value == 0) {

                        $('#journal_fr').show()

                    } else {

                        $('#journal_fr').hide()

                    }

                }



                var loadFile = function(event, lang) {

                    if (lang == 'ar') {

                        var output = document.getElementById('img_ar');

                    } else {

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

@section('script')
<script type="text/javascript">
    function addDaysToDate() {
        var inputX = document.getElementById('datePublication');
        var dateX = new Date(inputX.value);
        var dateY = new Date(dateX.getTime() + (15 * 24 * 60 * 60 * 1000));
        var inputZ = document.getElementById('dateEcheance');
        inputZ.value = formatDate(dateY);
    }

    function formatDate(date) {
        var year = date.getFullYear();
        var month = (date.getMonth() + 1).toString().padStart(2, '0');
        var day = date.getDate().toString().padStart(2, '0');
        return year + '-' + month + '-' + day;
    }

    var inputX = document.getElementById('datePublication');
    inputX.addEventListener('change', addDaysToDate);
</script>


@endsection