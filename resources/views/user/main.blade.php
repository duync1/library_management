@extends("../masterlayout")
@section('sidebar')
    <ul class="nav nav-secondary">             
        <li class="nav-item">
            <a href="/user/books">
                <i class="fa fa-book"></i>
                <p>All Books</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/user/borrow-history">
                <i class="fa fa-history"></i>
                <p>Borrowing History</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/user/profile">
                <i class="fa fa-user"></i>
                <p>Profile</p>
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

