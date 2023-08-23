@extends('layouts.panel')

@section('title', 'list users')

@section('content')
    <div class="h3">List users</div>
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-message">
                <svg id="SvgjsSvg1012" width="25" height="25" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><defs id="SvgjsDefs1013"></defs><g id="SvgjsG1014"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="25" height="25"><g data-name="Layer 2" fill="#16da16" class="color000 svgShape"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm4.3 7.61-4.57 6a1 1 0 0 1-.79.39 1 1 0 0 1-.79-.38l-2.44-3.11a1 1 0 0 1 1.58-1.23l1.63 2.08 3.78-5a1 1 0 1 1 1.6 1.22z" data-name="checkmark-circle-2" fill="#16da16" class="color000 svgShape"></path></g></svg></g></svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="bg-white p-4 rounded">
        <form class="row" action="{{ route('admin.users') }}" method="GET">
            <div class="col-md-4">
                <input class="form-control" type="text" placeholder="search" name="keyword" value="{{ old('keyword') }}">
            </div>
            <div class="col-md-4">
                <select class="col-md-4 form-control" name="type_user" id="">
                    <option value="all" selected>tout</option>
                    <option value="abonné" {{ (old('type_user') === 'abonné') ? 'selected' : '' }}>abonné</option>
                    <option value="content" {{ (old('type_user') === 'content') ? 'selected' : '' }}>representant</option>
                </select>
            </div>
           <div class="col-md-4">
               <button class="btn btn-info">Search</button>
           </div>
        </form>
    </div>
    <div class="table-responsive">
        @if ($users)
        <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">Name</th>
                {{-- <th scope="col">Email</th> --}}
                <th scope="col">Phone</th>
                <th scope="col">Date inscription</th>
                <th scope="col">Date expiration</th>
                <th scope="col">Commentaire</th>
                <th scope="col">Etat abonnement</th>
                <th scope="col">user status</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                
                <tr>
                    <td>
                        {{ $key = $key + 1 }}
                    </td>
                    <td>
                        <a href="{{ route('admin.users.detail', $user) }}">
                            {{ $user->nom . ' ' . $user->prenom }}
                        </a>
                    </td>
                    {{-- <td>{{ $user->email }}</td> --}}
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ ($user->current_abonnement) ? $user->current_abonnement->date_fin : ''}}</td>
                    <td>{{ $user->note }}</td>
                    
                    <td>
                        @php
                            $subscriptionDate = DateTime::createFromFormat('Y-m-d', $user->abonnement_latest[0]->date_fin);
                            $today = new DateTime();
                            $isPast = $subscriptionDate < $today;
                        @endphp

                        @if($user->abonnement_latest[0]->nom_abonnement == 'gratuit' && $isPast &&  $user->abonnement_payant->count() == 0)
                            <svg id="SvgjsSvg1016" width="35" height="35" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><defs id="SvgjsDefs1017"></defs><g id="SvgjsG1018"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="35" height="35"><path fill="#ff0000" d="M17.564,37.251a1,1,0,0,1-1-1v-8.5a1,1,0,0,1,1-1h4.6a1,1,0,0,1,0,2h-3.6v7.5A1,1,0,0,1,17.564,37.251Z" class="coloref5350 svgShape"></path><path fill="#ff0000" d="M20.851 33H17.564a1 1 0 0 1 0-2h3.287a1 1 0 0 1 0 2zM30.252 37.251a.993.993 0 0 1-.679-.266l-2.917-2.7v1.963a1 1 0 0 1-2 0v-8.5a1 1 0 0 1 1-1h2.47A3.126 3.126 0 0 1 28.209 33l2.722 2.519a1 1 0 0 1-.679 1.733zM26.656 31h1.47a1.126 1.126 0 1 0 0-2.251h-1.47zM38.344 37.251h-4.6a1 1 0 0 1-1-1v-8.5a1 1 0 0 1 1-1h4.6a1 1 0 0 1 0 2h-3.6v6.5h3.6a1 1 0 0 1 0 2z" class="coloref5350 svgShape"></path><path fill="#ff0000" d="M36.976 33H33.748a1 1 0 1 1 0-2h3.228a1 1 0 0 1 0 2zM46.436 37.251h-4.6a1 1 0 0 1-1-1v-8.5a1 1 0 0 1 1-1h4.6a1 1 0 0 1 0 2h-3.6v6.5h3.6a1 1 0 0 1 0 2z" class="coloref5350 svgShape"></path><path fill="#ff0000" d="M45.067,33H41.84a1,1,0,0,1,0-2h3.227a1,1,0,1,1,0,2Z" class="coloref5350 svgShape"></path><path fill="#ff0000" d="M32,60.246a1,1,0,0,1-.773-.366l-5.048-6.163-7.453,2.816a1,1,0,0,1-1.341-.775l-1.28-7.864L8.24,46.614a1,1,0,0,1-.774-1.341l2.817-7.452L4.12,32.773a1,1,0,0,1,0-1.546l6.163-5.048L7.467,18.726a1,1,0,0,1,.774-1.34l7.865-1.281,1.28-7.864a1,1,0,0,1,1.341-.775l7.452,2.817L31.227,4.12a1.033,1.033,0,0,1,1.546,0l5.048,6.163,7.453-2.816a1,1,0,1,1,.707,1.871l-8.125,3.07a1,1,0,0,1-1.127-.3L32,6.332l-4.729,5.774a1,1,0,0,1-1.127.3L19.164,9.77l-1.2,7.367a1,1,0,0,1-.826.826l-7.368,1.2,2.637,6.981a1,1,0,0,1-.3,1.127L6.332,32l5.774,4.729a1,1,0,0,1,.3,1.127L9.77,44.836l7.368,1.2a1,1,0,0,1,.826.826l1.2,7.368,6.981-2.638a1,1,0,0,1,1.127.3L32,57.668l4.729-5.774a1,1,0,1,1,1.547,1.267l-5.5,6.719A1,1,0,0,1,32,60.246Z" class="coloref5350 svgShape"></path><path fill="#ff0000" d="M45.627,56.6a1.011,1.011,0,0,1-.354-.064l-8.124-3.071a1,1,0,0,1,.707-1.871l6.98,2.638,1.2-7.367a1,1,0,0,1,.827-.826l7.367-1.2-2.637-6.981a1,1,0,0,1,.3-1.127L57.668,32l-5.774-4.729a1,1,0,0,1-.3-1.127l2.638-6.98-7.368-1.2a1,1,0,1,1,.323-1.974l8.575,1.4a1,1,0,0,1,.774,1.341l-2.817,7.452,6.163,5.048a1,1,0,0,1,0,1.546l-6.163,5.048,2.816,7.453a1,1,0,0,1-.775,1.341L47.894,47.9l-1.28,7.864a1,1,0,0,1-.987.839Z" class="coloref5350 svgShape"></path></svg></g></svg>
                        @endif
                        @if($user->abonnement_latest[0]->nom_abonnement == 'gratuit' && !$isPast &&  $user->abonnement_payant->count() == 0)
                            <svg id="SvgjsSvg1016" width="35" height="35" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><defs id="SvgjsDefs1017"></defs><g id="SvgjsG1018"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="35" height="35"><path fill="#199e07" d="M17.564,37.251a1,1,0,0,1-1-1v-8.5a1,1,0,0,1,1-1h4.6a1,1,0,0,1,0,2h-3.6v7.5A1,1,0,0,1,17.564,37.251Z" class="coloref5350 svgShape"></path><path fill="#199e07" d="M20.851 33H17.564a1 1 0 0 1 0-2h3.287a1 1 0 0 1 0 2zM30.252 37.251a.993.993 0 0 1-.679-.266l-2.917-2.7v1.963a1 1 0 0 1-2 0v-8.5a1 1 0 0 1 1-1h2.47A3.126 3.126 0 0 1 28.209 33l2.722 2.519a1 1 0 0 1-.679 1.733zM26.656 31h1.47a1.126 1.126 0 1 0 0-2.251h-1.47zM38.344 37.251h-4.6a1 1 0 0 1-1-1v-8.5a1 1 0 0 1 1-1h4.6a1 1 0 0 1 0 2h-3.6v6.5h3.6a1 1 0 0 1 0 2z" class="coloref5350 svgShape"></path><path fill="#199e07" d="M36.976 33H33.748a1 1 0 1 1 0-2h3.228a1 1 0 0 1 0 2zM46.436 37.251h-4.6a1 1 0 0 1-1-1v-8.5a1 1 0 0 1 1-1h4.6a1 1 0 0 1 0 2h-3.6v6.5h3.6a1 1 0 0 1 0 2z" class="coloref5350 svgShape"></path><path fill="#199e07" d="M45.067,33H41.84a1,1,0,0,1,0-2h3.227a1,1,0,1,1,0,2Z" class="coloref5350 svgShape"></path><path fill="#199e07" d="M32,60.246a1,1,0,0,1-.773-.366l-5.048-6.163-7.453,2.816a1,1,0,0,1-1.341-.775l-1.28-7.864L8.24,46.614a1,1,0,0,1-.774-1.341l2.817-7.452L4.12,32.773a1,1,0,0,1,0-1.546l6.163-5.048L7.467,18.726a1,1,0,0,1,.774-1.34l7.865-1.281,1.28-7.864a1,1,0,0,1,1.341-.775l7.452,2.817L31.227,4.12a1.033,1.033,0,0,1,1.546,0l5.048,6.163,7.453-2.816a1,1,0,1,1,.707,1.871l-8.125,3.07a1,1,0,0,1-1.127-.3L32,6.332l-4.729,5.774a1,1,0,0,1-1.127.3L19.164,9.77l-1.2,7.367a1,1,0,0,1-.826.826l-7.368,1.2,2.637,6.981a1,1,0,0,1-.3,1.127L6.332,32l5.774,4.729a1,1,0,0,1,.3,1.127L9.77,44.836l7.368,1.2a1,1,0,0,1,.826.826l1.2,7.368,6.981-2.638a1,1,0,0,1,1.127.3L32,57.668l4.729-5.774a1,1,0,1,1,1.547,1.267l-5.5,6.719A1,1,0,0,1,32,60.246Z" class="coloref5350 svgShape"></path><path fill="#199e07" d="M45.627,56.6a1.011,1.011,0,0,1-.354-.064l-8.124-3.071a1,1,0,0,1,.707-1.871l6.98,2.638,1.2-7.367a1,1,0,0,1,.827-.826l7.367-1.2-2.637-6.981a1,1,0,0,1,.3-1.127L57.668,32l-5.774-4.729a1,1,0,0,1-.3-1.127l2.638-6.98-7.368-1.2a1,1,0,1,1,.323-1.974l8.575,1.4a1,1,0,0,1,.774,1.341l-2.817,7.452,6.163,5.048a1,1,0,0,1,0,1.546l-6.163,5.048,2.816,7.453a1,1,0,0,1-.775,1.341L47.894,47.9l-1.28,7.864a1,1,0,0,1-.987.839Z" class="coloref5350 svgShape"></path></svg></g></svg>
                        @endif

                        @if($user->abonnement_latest[0]->nom_abonnement != 'gratuit' && $isPast)
                            <svg id="SvgjsSvg1096" width="20" height="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><defs id="SvgjsDefs1097"></defs><g id="SvgjsG1098"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" width="20" height="20"><path fill="none" fill-rule="evenodd" stroke="#ff0606" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 1 1 13M1 1l12 12" class="colorStroke000 svgStroke"></path></svg></g></svg>                        @endif
                        @if($user->abonnement_latest[0]->nom_abonnement != 'gratuit' && !$isPast)   
                            <svg id="SvgjsSvg1073" width="30" height="30" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><defs id="SvgjsDefs1074"></defs><g id="SvgjsG1075"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30"><g data-name="Layer 2" fill="#13ce08" class="color000 svgShape"><g data-name="checkmark-square" fill="#13ce08" class="color000 svgShape"><rect width="24" height="24" opacity="0" fill="#13ce08" class="color000 svgShape"></rect><path d="M20 11.83a1 1 0 0 0-1 1v5.57a.6.6 0 0 1-.6.6H5.6a.6.6 0 0 1-.6-.6V5.6a.6.6 0 0 1 .6-.6h9.57a1 1 0 1 0 0-2H5.6A2.61 2.61 0 0 0 3 5.6v12.8A2.61 2.61 0 0 0 5.6 21h12.8a2.61 2.61 0 0 0 2.6-2.6v-5.57a1 1 0 0 0-1-1z" fill="#13ce08" class="color000 svgShape"></path><path d="M10.72 11a1 1 0 0 0-1.44 1.38l2.22 2.33a1 1 0 0 0 .72.31 1 1 0 0 0 .72-.3l6.78-7a1 1 0 1 0-1.44-1.4l-6.05 6.26z" fill="#13ce08" class="color000 svgShape"></path></g></g></svg></g></svg>                        
                        @endif
                        
                    </td>

                    <td>
                        @if($user->phoneVerified)
                            <svg id="SvgjsSvg1012" width="25" height="25" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><defs id="SvgjsDefs1013"></defs><g id="SvgjsG1014"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="25" height="25"><g data-name="Layer 2" fill="#16da16" class="color000 svgShape"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm4.3 7.61-4.57 6a1 1 0 0 1-.79.39 1 1 0 0 1-.79-.38l-2.44-3.11a1 1 0 0 1 1.58-1.23l1.63 2.08 3.78-5a1 1 0 1 1 1.6 1.22z" data-name="checkmark-circle-2" fill="#16da16" class="color000 svgShape"></path></g></svg></g></svg>
                        @else                 
                            <svg id="SvgjsSvg1030" width="25" height="25" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><defs id="SvgjsDefs1031"></defs><g id="SvgjsG1032"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="25" height="25"><rect width="256" height="256" fill="none"></rect><path d="M128,24A104,104,0,1,0,232,128,104.12041,104.12041,0,0,0,128,24Zm37.65625,130.34375a7.99915,7.99915,0,1,1-11.3125,11.3125L128,139.3125l-26.34375,26.34375a7.99915,7.99915,0,0,1-11.3125-11.3125L116.6875,128,90.34375,101.65625a7.99915,7.99915,0,0,1,11.3125-11.3125L128,116.6875l26.34375-26.34375a7.99915,7.99915,0,0,1,11.3125,11.3125L139.3125,128Z" fill="#ff0000" class="color000 svgShape"></path></svg></g></svg>
                        @endif
                    </td>
                    
                </tr>
                    
                @endforeach             
            </tbody>
        </table>

        {{ $users->links() }}
        @else
            <div class="h3 text-center">No users found</div>
        @endif
        
    </div>
    
@endsection