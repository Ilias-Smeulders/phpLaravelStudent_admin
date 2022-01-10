@extends('layout.template')
@section('title', 'programmes')
@section('main')
    <h1>Programmes</h1>
    <p>This page displays the programmes</p>
    <h1>Genres</h1>
    @include('shared.alert')
    <p>
        <a href="programmes/create" class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Create new genre
        </a>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Programme name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($programmes as $programme)
                <tr>
                    <td>{{ $programme->id }}</td>
                    <td>{{ $programme->name }}</td>
                    <td>
                        <form action="/programmes/{{ $programme->id }}" method="post">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/programmes/{{ $programme->id }}/edit" class="btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Edit {{ $programme->name }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger deleteGenre"
                                        data-toggle="tooltip"
                                        data-records="{{ $programme->records_count }}"
                                        data-name="{{$programme->name}}"
                                        title="Delete {{ $programme->name }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('script_after')
    <script>
        $('.deleteGenre').click(function () {
            const records = $(this).data('records');
            const name = $(this).data('name');
            let msg = `Delete this ${name}?`;
            if (records > 0) {
                msg += `\nThe ${records} ${name} records will also be deleted!`
            }
            if (confirm(msg)) {
                $(this).closest('form').submit();
            }
        })
    </script>
@endsection
