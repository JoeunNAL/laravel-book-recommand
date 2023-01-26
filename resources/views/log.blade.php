@extends('layout')

@section('content')
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h2 class='modal-title my-4' id='exampleModalLabel'>로그내역</h2>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close' onclick='location.href = "{{ route('home.index') }}"'></button>
      </div>
      <div class='modal-body'>
        <table class='table table-hover'>
          <thead>
            <tr>
              <td>일/시</td>
              <td>내역</td>
            </tr>
          </thead>
          <tbody class='table-group-divider'>
            @foreach($logs as $log)
              <tr>
                <td>{{ $log -> created_at }}</td>
                <td>{{ $log -> history }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection