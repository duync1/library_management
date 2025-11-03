@extends("user.main")

@section('content')
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <div class="d-flex align-items-center">
            <h4 class="card-title">Borrow History</h4>
        </div>
        </div>
        <div class="card-body">
        <!-- Modal -->
        <!-- Borrow Confirmation Modal -->
            

            <div class="modal fade" id="cancelBorrowModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">
                                <span class="fw-mediumbold">Confirm Cancel</span>
                            </h5>
                            </h5>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to cancel this borrow request?</p>
                        </div>
                        <div class="modal-footer border-0">
                            <form method="POST" id="cancelBorrowForm">
                                @csrf
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Confirm Cancel</button>
                            </form>
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
                        <th>STT</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Genre</th>
                        <th>Borrowed At</th>
                        <th>Returned At</th>
                        <th>Status</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($borrowRecords as $record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            <td>{{ $record->book->title }}</td>
                            <td>{{ $record->book->author }}</td>
                            <td>{{ $record->book->genre }}</td>
                            <td>{{ $record->borrowed_at }}</td>
                            <td>{{ $record->returned_at }}</td>
                            <td>{{ $record->status }}</td>
                        
                            @if($record->status == 'pending')
                                <td>
                                    <button 
                                        type="button" 
                                        class="btn btn-success btn-sm cancelBorrowBtn" 
                                        data-id="{{ $record->id }}" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#cancelBorrowModal">
                                        <i class="fa fa-book"></i> Cancel Borrow
                                    </button>
                                </td>
                            @else
                                <td></td>
                            @endif
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
  <script>

    document.querySelectorAll('.cancelBorrowBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const bookId = this.dataset.id;
            const cancelForm = document.getElementById('cancelBorrowForm');
            cancelForm.action = `/user/cancel-borrow/${bookId}`;
        });
    });

    
  </script>
@endsection