@extends("admin.main")

@section('content')
    <div class="col-md-12">
    <div class="card">
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
                @foreach($borrowRecords as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->user->fullname }}</td>
                    <td>{{ $record->book->title }}</td>
                    <td>{{ $record->borrowed_at }}</td>
                    <td>{{ $record->returned_at }}</td>
                    <td>{{ $record->status }}</td>
                    <td></td>
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