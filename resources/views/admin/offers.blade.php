@extends('layouts.panel')

@section('title', 'list offers')

@section('content')
    <div class="text-center h3">List offers</div>

	@if (session('success'))
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		<div class="alert-message">
			{{ session('success') }}
		</div>
	</div>
	@endif

	@if (session('error'))
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		<div class="alert-message">
			{{ session('error') }}
		</div>
	</div>
	@endif

    <div class="bg-white p-3">
        @if ($offres)
            @foreach ($offres as $offer)
                <x-offre :exp="false" :offre="$offer" />
            @endforeach
            {{ $offres->links() }}
        
        <!-- delete modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        Voulez vous supprimer cet offre?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">non</button>
	        <form method="POST" action="{{ (Auth::user()->type_user !== 'content') ? route('admin.offre.destroy') : route('rep.offre.destroy') }}">
                @csrf
                @method('DELETE')
                <input type="number" name="offre" id="offre_id" hidden>
                <button class="btn btn-primary">Oui</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

    <script type="text/javascript">

        $('#exampleModalCenter').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var id = button.data('id') 
            
			$('#offre_id').val(id);
		});
    </script>

        @else
            <div class="h4 text-center">no offers found</div>
        @endif
    </div>
@endsection