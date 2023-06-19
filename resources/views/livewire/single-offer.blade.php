<div>
    @if(!$dismiss)
        <form wire:submit.prevent="submit">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <span class="mr-2">{{ $image }}</span>
                            <img src="{{ asset('img/1.png') }}" alt="Logo" style="height: 40px">
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white" style="width: 140px">Titre</span>
                                </div>
                                <input type="text" wire:model="titre" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="row my-2">
                        <div class="col-md-6" wire:ignore>
                            <div class="input-group d-flex">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white" style="width: 140px">Annonceur</span>
                                </div>
                                <select wire:model="etablissement" class="form-control selectpicker"
                                    data-live-search="true" data-size="5" id="" title="etablissement">
                                    <option value="0">Autre</option>
                                    @foreach (App\Models\Adminetab::All() as $etab)
                                        <option value="{{ $etab->id }}">
                                            {{ \Illuminate\Support\Str::limit($etab->nom_etablissement, 50, $end = '...') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal fade" id="{{ 'fullscreenModal' . $offer->id }}" tabindex="-1"
                            role="dialog" aria-labelledby="fullscreenModalLabel" aria-hidden="true" wire:ignore>
                            <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <img src="{{ asset('storage/' . $offer->titre) }}" alt=""
                                            style="max-width: 100%; max-height: 100%;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" wire:ignore>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white" style="width: 140px">Wilaya</span>
                                </div>
                                <div class="" style="width: 70%;">
                                    <select wire:model="wilaya" class="form-control selectpicker" id="wilaya_offre"
                                        data-live-search="true" data-size="5" style="width: 100%">
                                        <option data-id="0" value="etab" selected>Wilaya d'etablissement
                                        </option>
                                        @foreach (App\Models\Wilaya::All() as $wilaya)
                                            <option value="{{ $wilaya->id }}">{{ $wilaya->wilaya }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-6" wire:ignore>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white" style="width: 140px">Status</span>
                                </div>
                                <select wire:model="status" class="form-control mb-2 selectpicker" title="statut"
                                    data-live-search="true" data-size="5" required>
                                    <option value="status" selected>Status</option>
                                    <option value="Appel d'offres & Consultation"
                                        data-tokens="Appel d'offres & Consultation" selected>Appel d'offres &
                                        Consultation</option>
                                    <option value="Attribution de marché" data-tokens="Attribution de marché">
                                        Attribution de marché</option>
                                    <option value="Sous-traitance" data-tokens="Sous-traitance">Sous-traitance
                                    </option>
                                    <option value="Prorogation de délai" data-tokens="Prorogation de délai">
                                        Prorogation de délai</option>
                                    <option value="Annulation" data-tokens="Annulation">Annulation</option>
                                    <option value="Infructuosité" data-tokens="Infructuosité">Infructuosité</option>
                                    <option value="Adjudication" data-tokens="Adjudication">Adjudication</option>
                                    <option value="Vente aux enchères" data-tokens="Vente aux enchères">Vente aux
                                        enchères</option>
                                    <option value="Mise en demeure et résiliation"
                                        data-tokens="Mise en demeure et résiliation">Mise en demeure et résiliation
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" wire:ignore>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white" style="width: 140px">Secteur</span>
                                </div>
                                <select wire:model="secteur" class="form-control mb-2 selectpicker" multiple
                                    title="Secteur" data-live-search="true" data-size="5">
                                    @foreach (App\Models\Secteur::All() as $sect)
                                        <option value="{{ $sect->id }}" data-tokens="{{ $sect->secteur }}">
                                            {{ \Illuminate\Support\Str::limit($sect->secteur, 50, $end = '...') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row my-2">
                        <div class="col-md-6" wire:ignore>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white" style="width: 140px">Date
                                        publication</span>
                                </div>
                                <input type="date" wire:model="date_publication" class="form-control"
                                    id="datePublication">
                            </div>


                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white" style="width: 140px">Date
                                        d'échéance</span>
                                </div>
                                <input type="date" class="form-control" id="dateEcheance"
                                    wire:model="date_echeance">
                            </div>
                        </div>
                        <div class="col-md-1" wire:ignore>
                            <div class="input-group">
                                <select wire:model="date_after" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-6" wire:ignore>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white" style="width: 140px">Journal FR</span>
                                </div>
                                <select wire:model="journalA" class="form-control selectpicker" id="journalAr"
                                    data-live-search="true" data-size="5">
                                    <option value="-1" selected>Aucun</option>
                                    <option value="0">Autre</option>
                                    @foreach (App\Models\Journalfr::All() as $journ)
                                        <option value="{{ $journ->id }}" data-tokens="{{ $journ->nom }}">
                                            {{ $journ->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" wire:ignore>
                            <div class="input-group d-flex ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white" style="width: 140px">Journal AR</span>
                                </div>
                                <select wire:model="journalF" class="form-control selectpicker" id="journalFr"
                                    data-live-search="true" data-size="5">
                                    <option value="-1" selected>Aucun</option>
                                    <option value="0">Autre</option>
                                    @foreach (App\Models\Journalar::All() as $journ)
                                        <option value="{{ $journ->id }}" data-tokens="{{ $journ->nom }}">
                                            {{ $journ->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row my-2">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white"
                                        style="width: 140px">Description</span>
                                </div>
                                <textarea type="text" wire:model="description" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-success" >Publié</button>
                            <button type="button" class="btn btn-secondary" data-toggle="modal"
                                data-target="{{ '#fullscreenModal' . $offer->id }}" wire:ignore>Voir</button>
                            <div class="modal fade" id="{{ 'fullscreenModal' . $offer->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="fullscreenModalLabel" aria-hidden="true"
                                wire:ignore>
                                <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img src="{{ asset('storage/' . $offer->titre) }}" alt=""
                                                style="max-width: 100%; max-height: 100%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif

    <script type="text/javascript">
    
    document.addEventListener('livewire:load', function () {
        $('select').selectpicker();
    });
    document.addEventListener('livewire:update', function () {
        $('select').selectpicker();
    });

    </script>

</div>

