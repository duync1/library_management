@extends("admin.main")

@section('content')
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Manage Users</h4>
            </div>
        </div>
        <div class="card-body">
        <!-- Modal -->
        <div class="table-responsive">
            <table
            id="add-row"
            class="display table table-striped table-hover"
            >
            <thead>
                <tr>
                <th>Id</th>
                <th>Email</th>
                <th>Fullname</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Address</th>
                <th style="width: 10%">History</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->fullname }}</td>
                        <td>{{ $user->date_of_birth }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->address }}</td>
                        <td>
                            <div class="form-button-action">
                                <a 
                                    href="{{ url('/admin/borrow-details/' . $user->id) }}" 
                                    class="btn btn-link btn-primary btn-lg"
                                    data-bs-toggle="tooltip"
                                    title="View Borrow History"
                                >
                                    <i class="fa fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
  <script src="{{ asset('js/plugin/datatables/datatables.min.js') }}"></script>
@endsection