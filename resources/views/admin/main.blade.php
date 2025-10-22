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
    <li class="nav-item">
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <p>Logout</p>
        </a>
        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </li>
</ul>
@endsection

