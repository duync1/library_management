@extends("../masterlayout")
@section('sidebar')
    <ul class="nav nav-secondary">             
        <li class="nav-item">
            <a href="widgets.html">
                <i class="bi bi-book"></i>
                <p>All Books</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="../../documentation/index.html">
                <i class="fas fa-file"></i>
                <p>Borrowing History</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="../../documentation/index.html">
                <i class="fas fa-file"></i>
                <p>Profile</p>
            </a>
        </li>
    </ul>
@endsection