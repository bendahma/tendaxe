@extends('layouts.panel')

@section('title', 'list users')

@section('content')
    <div class="h3">List admins</div>

    <div class="table-responsive">
        @if ($users)
        <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Date inscription</th>
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