@extends('layouts.panel')

@section('title', 'list users')

@section('content')
    <div class="h3">List users</div>

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
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Date inscription</th>
                <th scope="col">Date expiration</th>
                <th scope="col">Commentaire</th>
                <th scope="col">user type</th>
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
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ ($user->current_abonnement) ? $user->current_abonnement->date_fin : ''}}</td>
                    <td>{{ $user->note }}</td>
                    <td>{{ $user->type_user }}</td>
                    
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