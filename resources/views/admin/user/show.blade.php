@extends("admin.main")

@section('content')
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <div class="d-flex align-items-center">
            <h4 class="card-title">Add Row</h4>
            <button
            class="btn btn-primary btn-round ms-auto"
            data-bs-toggle="modal"
            data-bs-target="#addRowModal"
            >
            <i class="fa fa-plus"></i>
            Add Row
            </button>
        </div>
        </div>
        <div class="card-body">
        <!-- Modal -->
        <div
            class="modal fade"
            id="addRowModal"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold">Add new book</span>
                </h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form>
                    <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group form-group-default">
                        <label>Title</label>
                        <input
                            id="addName"
                            type="text"
                            class="form-control"
                            placeholder="fill name"
                        />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group form-group-default">
                        <label>Author</label>
                        <input
                            id="addName"
                            type="text"
                            class="form-control"
                            placeholder="fill name"
                        />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group form-group-default">
                        <label>Publisher</label>
                        <input
                            id="addName"
                            type="text"
                            class="form-control"
                            placeholder="fill name"
                        />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group form-group-default">
                        <label>Genre</label>
                        <input
                            id="addName"
                            type="text"
                            class="form-control"
                            placeholder="fill name"
                        />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group form-group-default">
                        <label>Quantity</label>
                        <input
                            id="addName"
                            type="number"
                            class="form-control"
                            placeholder="fill name"
                        />
                        </div>
                    </div>
                    </div>
                </form>
                </div>
                <div class="modal-footer border-0">
                <button
                    type="button"
                    id="addRowButton"
                    class="btn btn-primary"
                >
                    Add
                </button>
                <button
                    type="button"
                    class="btn btn-danger"
                    data-dismiss="modal"
                >
                    Close
                </button>
                </div>
            </div>
            </div>
        </div>

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
                            <button
                                type="button"
                                data-bs-toggle="tooltip"
                                title=""
                                class="btn btn-link btn-primary btn-lg"
                                data-original-title="Edit Task"
                            >
                                <i class="fa fa-edit"></i>
                            </button>
                            <button
                                type="button"
                                data-bs-toggle="tooltip"
                                title=""
                                class="btn btn-link btn-danger"
                                data-original-title="Remove"
                            >
                                <i class="fa fa-times"></i>
                            </button>
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