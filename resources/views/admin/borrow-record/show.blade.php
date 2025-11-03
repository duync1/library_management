@extends("admin.main")

@section('content')
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <div class="d-flex align-items-center">
        <h4 class="card-title">Manage Borrow Records</h4>
      </div>
    </div>

    <div class="card-body">
      <!-- Borrow Confirmation Modal -->
      <div class="modal fade" id="borrowBookModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header border-0">
              <h5 class="modal-title">
                <span class="fw-mediumbold">Confirm Approval</span>
              </h5>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to approve borrowing this book?</p>
            </div>
            <div class="modal-footer border-0">
              <form method="POST" id="borrowBookForm">
                @csrf
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Confirm Approval</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="returnBookModal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header border-0">
                      <h5 class="modal-title">
                          <span class="fw-mediumbold">Confirm Return</span>
                      </h5>
                  </div>
                  <div class="modal-body">
                      <p>Are you sure you want to return this book?</p>
                  </div>
                  <div class="modal-footer border-0">
                      <form method="POST" id="returnBookForm">
                          @csrf
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-success">Confirm Return</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>

      <!-- Finalize Borrow Modal -->
      <div class="modal fade" id="finalizeBorrowModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header border-0">
              <h5 class="modal-title">
                <span class="fw-mediumbold">Finalize Borrow</span>
              </h5>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to finalize this borrowing process?</p>
            </div>
            <div class="modal-footer border-0">
              <form method="POST" id="finalizeBorrowForm">
                @csrf
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Finalize Borrow</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table id="add-row" class="display table table-striped table-hover">
          <thead>
            <tr>
              <th>STT</th>
              <th>Full Name</th>
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
              <td>{{ $record->user->fullname }}</td>
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
                    class="btn btn-success btn-sm borrowBookBtn" 
                    data-id="{{ $record->id }}" 
                    data-bs-toggle="modal" 
                    data-bs-target="#borrowBookModal">
                    Approve Borrow
                    </button>

                    <button 
                    type="button" 
                    class="btn btn-primary btn-sm finalizeBorrowBtn mt-1"
                    data-id="{{ $record->id }}" 
                    data-bs-toggle="modal" 
                    data-bs-target="#finalizeBorrowModal">
                    Finalize Borrow
                    </button>
                </td>
              @elseif($record->status == 'borrowed')
                <td>
                    <button 
                        type="button" 
                        class="btn btn-success btn-sm returnBookBtn" 
                        data-id="{{ $record->id }}" 
                        data-bs-toggle="modal" 
                        data-bs-target="#returnBookModal">
                        <i class="fa fa-book"></i> Return Book
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
  document.addEventListener('DOMContentLoaded', function() {
    // Khi nhấn nút Approve Borrow
    document.querySelectorAll('.borrowBookBtn').forEach(btn => {
      btn.addEventListener('click', function() {
        const recordId = this.dataset.id;
        const form = document.getElementById('borrowBookForm');
        form.action = `/admin/approveBorrowRequest/${recordId}`;
      });
    });

    // Khi nhấn nút Finalize Borrow
    document.querySelectorAll('.finalizeBorrowBtn').forEach(btn => {
      btn.addEventListener('click', function() {
        const recordId = this.dataset.id;
        const form = document.getElementById('finalizeBorrowForm');
        form.action = `/admin/finalizeBorrowRequest/${recordId}`;
      });
    });

    document.querySelectorAll('.returnBookBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            const recordId = this.dataset.id;
            const returnForm = document.getElementById('returnBookForm');
            returnForm.action = `/admin/return/${recordId}`;
            console.log("Return action:", returnForm.action);
        });
    });
  });
</script>
@endsection
