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
        

        <div class="table-responsive">
            <table
            id="add-row"
            class="display table table-striped table-hover"
            >
            <thead>
                <tr>
                <th>Id</th>
                <th>Fullname</th>
                <th>Book Title</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th style="width: 10%">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>Edinburgh</td>
                    <td>Edinburgh</td>
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