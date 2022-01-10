@extends('layout.template')
@section('title', 'Courses')
@section('main')
    <h1>Courses Shop</h1>
    <form method="get" action="/courses" id="searchForm">
        <div class="row">
            <div class="col-sm-8 mb-2">
                <input type="text" class="form-control" name="coursename" id="coursename"
                       value="{{ request()->coursename }}" placeholder="Filter title or description">
            </div>
            <div class="col-sm-4 mb-2">
                <select class="form-control" name="programme" id="programme">
                    <option value="%">All courses</option>
                    @foreach($programmes as $programme)
                        <option value="{{ $programme->id }}"
                            {{ (request()->programme ==  $programme->id ? 'selected' : '') }}>{{ $programme->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
    <hr>
    @if ($courses->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show">
            Can't find any Course with <b>'{{ request()->coursename }}'</b> for this term
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif
    {{ $courses->withQueryString()->links() }}
    <div class="row">
        @foreach($courses as $course)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3 d-flex">
                <div class="card cardShopMaster" data-id="{{ $course->id }}">
                    <div class="card-body" style="position: relative; height: 200px">
                        <h5 class="card-title">{{ $course->name }}</h5>
                        <p class="card-text mt-4">{{ $course->description }}</p>
                        <a href="#" class="card-link" style="bottom:25px; position: absolute;">{{$course->programme->name}}</a>
                    </div>
                    @auth
                        <div class="card-footer d-flex justify-content-between">
                            <a href="courses/{{ $course->id }}" class="btn btn-outline-info btn-sm btn-block">Manage students</a>
                        </div>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
    {{ $courses->withQueryString()->links() }}
@endsection
@section('script_after')
    <script>
        $(function () {
            // Get record id and redirect to the detail page
            $('.card').click(function () {
                const course_id = $(this).data('id');
                $(location).attr('href', `/courses/${course_id}`); //OR $(location).attr('href', '/shop/' + record_id);
            });

            // Add shadow to card on hover
            $('.card').hover(function () {
                $(this).addClass('shadow');
            }, function () {
                $(this).removeClass('shadow');
            });

            $('#coursename').blur(function () {
                $('#searchForm').submit();
            });

            $('#programme').change(function () {
                $('#searchForm').submit();
            });
        })
    </script>
@endsection
