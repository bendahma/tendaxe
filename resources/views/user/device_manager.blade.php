@extends('layouts.layout')

@section('title', 'Gestionnaire de périphériques')

@section('content')
    <div class="container main">
        <h2 class="text-center">Gestionnaire de périphériques</h2>
        @if ($devices)
            <div style="display: none;">
                {{ Carbon\Carbon::setLocale('fr') }}
            </div>
            <div class="table-responsive-md">
                <table class="table table-hover mt-3">
                    <thead>
                        <tr>
                            <td>périphériques</td>
                            <td>Addresse IP</td>
                            <td style="width:12%">Dernière Activité</td>
                            <td style="width:12%">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($devices as $device)
                            <tr>
                                <td>{{ $device->user_agent }}</td>
                                <td>{{ $device->ip_address }}</td>
                                <td>{{ Carbon\Carbon::createFromTimestamp($device->last_activity)->diffForHumans() }}</td>
                                <td>
                                    @if ($current_session_id == $device->id)
                                        <button class="btn btn-sm btn-info" disabled>Ce périphérique</button>
                                    @else
                                        <form action="{{ route('device_manager.logout.single', $device->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-danger">Déconnecter</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div>Impossible! how did u get here xD</div>
        @endif
        
    </div>
@endsection