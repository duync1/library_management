@extends("admin.main")

@section('content')
    <div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <div class="d-flex align-items-center">
            <h4 class="card-title">Manage Books</h4>
            <button
                class="btn btn-primary btn-round ms-auto"
                data-bs-toggle="modal"
                data-bs-target="#addRowModal"
                >
                <i class="fa fa-plus"></i>
                Add book
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
                    type="button" class="btn btn-danger" data-bs-dismiss="modal" id="closeAddBookModal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <form method="post" action="/admin/books/add" id="addBookForm">
                    <input type="hidden" id="book_id" name="id">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Title</label>
                                <input id="title" type="text" class="form-control" placeholder="fill title" name="title" />
                                <span class="text-danger error-message" id="error-title"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Author</label>
                                <input id="author" type="text" class="form-control" placeholder="fill author" name="author"/>
                                <span class="text-danger error-message" id="error-author"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Published Date</label>
                                <input id="published_date" type="text" class="form-control" placeholder="fill published date" name="published_date"/>
                                <span class="text-danger error-message" id="error-published_date"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Genre</label>
                                <input id="genre" type="text" class="form-control" placeholder="fill genre" name="genre"/>
                                <span class="text-danger error-message" id="error-genre"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Quantity</label>
                                <input id="quantity" type="number" class="form-control" placeholder="fill quantity" name="quantity"/>
                                <span class="text-danger error-message" id="error-quantity"></span>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" id="saveBookButton" class="btn btn-primary">Save</button>
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="deleteBookModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title"><span class="fw-mediumbold">Delete Book</span></h5>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this book?</p>
                    </div>
                    <div class="modal-footer border-0">
                        <form method="POST" id="deleteBookForm">
                            @csrf
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
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
                <th style="width: 10%">Action</th>
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
                            <div class="form-button-action">
                            <button
                                type="button"
                                class="btn btn-link btn-primary btn-lg editBookBtn"
                                data-id="{{ $book->id }}"
                                data-title="{{ $book->title }}"
                                data-author="{{ $book->author }}"
                                data-published_date="{{ $book->published_date }}"
                                data-genre="{{ $book->genre }}"
                                data-quantity="{{ $book->quantity }}"
                                data-bs-toggle="modal"
                                data-bs-target="#addRowModal"
                            >
                                <i class="fa fa-edit"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-link btn-danger deleteBookBtn"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteBookModal"
                                data-id="{{ $book->id }}"
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
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('addRowModal');
    const form = document.getElementById('addBookForm');
    const saveBtn = document.getElementById('saveBookButton');
    const modalTitle = modal.querySelector('.modal-title span');
    const deleteModal = document.getElementById('deleteBookModal');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBookBtn');
    

    let isEditMode = false;

    // Nút Add book
    document.querySelector('[data-bs-target="#addRowModal"]').addEventListener('click', function () {
        isEditMode = false;
        modalTitle.textContent = 'Add new book';
        form.action = '/admin/books/add';
        saveBtn.textContent = 'Add';
        form.reset();
        document.querySelectorAll('.error-message').forEach(e => e.textContent = '');
    });

    // Nút Edit
    document.querySelectorAll('.editBookBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            isEditMode = true;
            modalTitle.textContent = 'Edit book';
            saveBtn.textContent = 'Update';

            document.getElementById('book_id').value = this.dataset.id;
            document.getElementById('title').value = this.dataset.title;
            document.getElementById('author').value = this.dataset.author;
            document.getElementById('published_date').value = this.dataset.published_date;
            document.getElementById('genre').value = this.dataset.genre;
            document.getElementById('quantity').value = this.dataset.quantity;

            form.action = `/admin/books/update/${this.dataset.id}`;
        });
    });

    // Xóa sách
    document.querySelectorAll('.deleteBookBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const bookId = this.dataset.id;
            const form = document.getElementById('deleteBookForm');
            form.action = `/admin/books/delete/${bookId}`;
        });
    });

    // Nút Save
    saveBtn.addEventListener('click', function () {
        const title = document.getElementById('title');
        const author = document.getElementById('author');
        const genre = document.getElementById('genre');
        const quantity = document.getElementById('quantity');

        const errors = {
            title: document.getElementById('error-title'),
            author: document.getElementById('error-author'),
            genre: document.getElementById('error-genre'),
            quantity: document.getElementById('error-quantity')
        };

        Object.values(errors).forEach(e => e.textContent = '');
        let hasError = false;

        if (title.value.trim() === '') { errors.title.textContent = 'Title is required.'; hasError = true; }
        if (author.value.trim() === '') { errors.author.textContent = 'Author is required.'; hasError = true; }
        if (genre.value.trim() === '') { errors.genre.textContent = 'Genre is required.'; hasError = true; }
        if (quantity.value.trim() === '' || parseInt(quantity.value) <= 0) {
            errors.quantity.textContent = 'Quantity must be a positive number.';
            hasError = true;
        }

        if (!hasError) form.submit();
    });

    // Khi modal đóng
    modal.addEventListener('hidden.bs.modal', function () {
        form.reset();
        document.querySelectorAll('.error-message').forEach(e => e.textContent = '');
        document.getElementById('book_id').value = '';
    });

    // Khi bấm nút Close
    document.getElementById('closeAddBookModal').addEventListener('click', function () {
        form.reset();
        document.querySelectorAll('.error-message').forEach(e => e.textContent = '');
        document.getElementById('book_id').value = '';
    });
});
</script>
@endsection