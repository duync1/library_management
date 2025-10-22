@extends("user.main")

@section('content')
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <div class="d-flex align-items-center">
            <h4 class="card-title">All Books</h4>
        </div>
        </div>
        <div class="card-body">
        <!-- Modal -->
        <!-- Borrow Confirmation Modal -->
            <div class="modal fade" id="borrowBookModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5 class="modal-title">
                                <span class="fw-mediumbold">Confirm Borrow</span>
                            </h5>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to borrow this book?</p>
                        </div>
                        <div class="modal-footer border-0">
                            <form method="POST" id="borrowBookForm">
                                @csrf
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Confirm Borrow</button>
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
                        <th>Id</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Published Date</th>
                        <th>Genre</th>
                        <th>Quantity</th>
                        <th style="width: 10%">Borrow</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->published_date }}</td>
                            <td>{{ $book->genre }}</td>
                            <td>{{ $book->quantity }}</td>
                            <td>
                                <button 
                                    type="button" 
                                    class="btn btn-success btn-sm borrowBookBtn" 
                                    data-id="{{ $book->id }}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#borrowBookModal">
                                    <i class="fa fa-book"></i> Borrow Book
                                </button>
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
  <script>
    document.querySelectorAll('.borrowBookBtn').forEach(btn => {
    btn.addEventListener('click', function () {
            const bookId = this.dataset.id;
            const borrowForm = document.getElementById('borrowBookForm');
            borrowForm.action = `/user/borrow/${bookId}`;
        });
    });
  </script>
@endsection