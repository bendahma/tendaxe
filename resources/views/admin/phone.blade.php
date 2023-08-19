@extends('layouts.panel')

@section('title', 'Phone Verification Notification')

@section('content')

    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="h3">Phone Verification Notification</div>

    <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($adminPhoneNotification as $key => $notif)
                    <tr>
                        <td>
                            {{ $key = $key + 1 }}
                        </td>
                        <td>
                            
                                {{ $notif->user->nom . ' ' . $notif->user->prenom }}
                            
                        </td>
                        <td>{{ $notif->user->phone }}</td>
                        <td>
                            <a href="{{ route('phone.confirmation',$notif->user->id) }}" class="btn btn-outline-success btn-small ">Confirmé N° Téléphone</a>
                        </td>                  
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="h3 text-center">No new notification exists.</div>
                            </td>
                        </tr>
                    @endforelse             
                </tbody>
            </table>
            {{ $adminPhoneNotification->links() }}
       
        
    </div>

@endsection