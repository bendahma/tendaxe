@extends('layouts.panel')

@section('title', 'Phone Verification Notification')

@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-message">
                <svg id="SvgjsSvg1012" width="25" height="25" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><defs id="SvgjsDefs1013"></defs><g id="SvgjsG1014"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="25" height="25"><g data-name="Layer 2" fill="#16da16" class="color000 svgShape"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm4.3 7.61-4.57 6a1 1 0 0 1-.79.39 1 1 0 0 1-.79-.38l-2.44-3.11a1 1 0 0 1 1.58-1.23l1.63 2.08 3.78-5a1 1 0 1 1 1.6 1.22z" data-name="checkmark-circle-2" fill="#16da16" class="color000 svgShape"></path></g></svg></g></svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="h3">Liste des personnes en attente vérification N° Téléphone</div>

    <div class="table-responsive my-5">
        <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Date inscription</th>
                <th scope="col">user type</th>
                <th scope="col" class="d-flex justify-content-center">user status</th>
                <th scope="col" class="">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($adminPhoneNotification as $key => $u)
                <tr>
                    <td>
                        {{ $key = $key + 1 }}
                    </td>
                    <td>
                        <a href="{{ route('admin.users.detail', $u->user->id) }}">
                            {{ $u->user->nom . ' ' . $u->user->prenom }}
                        </a>
                    </td>
                    {{-- <td>{{ $user->email }}</td> --}}
                    <td>{{ $u->user->phone }}</td>
                    <td>{{ $u->user->created_at }}</td>
                    <td>{{ $u->user->type_user }}</td>
                    <td class="d-flex justify-content-center">
                        <svg id="SvgjsSvg1030" width="25" height="25" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><defs id="SvgjsDefs1031"></defs><g id="SvgjsG1032"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="25" height="25"><rect width="256" height="256" fill="none"></rect><path d="M128,24A104,104,0,1,0,232,128,104.12041,104.12041,0,0,0,128,24Zm37.65625,130.34375a7.99915,7.99915,0,1,1-11.3125,11.3125L128,139.3125l-26.34375,26.34375a7.99915,7.99915,0,0,1-11.3125-11.3125L116.6875,128,90.34375,101.65625a7.99915,7.99915,0,0,1,11.3125-11.3125L128,116.6875l26.34375-26.34375a7.99915,7.99915,0,0,1,11.3125,11.3125L139.3125,128Z" fill="#ff0000" class="color000 svgShape"></path></svg></g></svg>
                    </td>
                    <td>
                        <a href="{{route('phone.confirmation',$u->user->id)}}" class=" d-flex align-items-center">
                        <span class="mx-1">
                            <svg id="SvgjsSvg1012" width="20" height="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><defs id="SvgjsDefs1013"></defs><g id="SvgjsG1014"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><path fill="none" d="M0 0h24v24H0V0z"></path><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.88-11.71L10 14.17l-1.88-1.88c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41l2.59 2.59c.39.39 1.02.39 1.41 0L17.3 9.7c.39-.39.39-1.02 0-1.41-.39-.39-1.03-.39-1.42 0z" fill="#0bcc14" class="color000 svgShape"></path></svg></g></svg>
                        </span>
                        Confirmé
                        </a>
                    </td>
                </tr>
                    
                @endforeach             
            </tbody>
        </table>
            {{ $adminPhoneNotification->links() }}
       
        
    </div>

@endsection