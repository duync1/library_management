@extends("../masterlayout")
@section('sidebar')
    <ul class="nav nav-secondary">
        <li class="nav-item">
            <a href="/admin/books">
                <i class="fa fa-book"></i>
                <p>Manage Books</p>
            </a>
        </li>            
        <li class="nav-item">
            <a href="/admin/borrow-records">
                <i class="fa fa-history"></i>
                <p>Borrow Records</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/admin/users">
                <i class="fas fa-users"></i>
                <p>Manage Users</p>
            </a>
        </li>
    </ul>
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content')

@endsection




