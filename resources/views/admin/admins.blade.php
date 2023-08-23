@extends('layouts.panel')

@section('title', 'list users')

@section('content')
    <div class="h3">List admins</div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="alert-message">
                <svg id="SvgjsSvg1012" width="25" height="25" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><defs id="SvgjsDefs1013"></defs><g id="SvgjsG1014"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="25" height="25"><g data-name="Layer 2" fill="#16da16" class="color000 svgShape"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm4.3 7.61-4.57 6a1 1 0 0 1-.79.39 1 1 0 0 1-.79-.38l-2.44-3.11a1 1 0 0 1 1.58-1.23l1.63 2.08 3.78-5a1 1 0 1 1 1.6 1.22z" data-name="checkmark-circle-2" fill="#16da16" class="color000 svgShape"></path></g></svg></g></svg>
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="table-responsive">
        @if ($users)
        <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                {{-- <th scope="col">Email</th> --}}
                <th scope="col">Phone</th>
                <th scope="col">Date inscription</th>
                <th scope="col">user type</th>
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
                    <td>{{ $user->type_user }}</td>
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