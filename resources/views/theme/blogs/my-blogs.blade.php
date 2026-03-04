@extends('theme.master')
@section('title', 'My blogs')

@section('content')
    @include('theme.partisal.hero', [
        'title' => 'My blogs',
    ])

    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (session('BlogDeleteStatus'))
                        <div class="alert alert-success">
                            {{ session('BlogDeleteStatus') }}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col" width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($blogs) > 0)
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td>
                                            <a href="{{ route('blogs.show', ['blog' => $blog]) }}"
                                                target="_blank">{{ $blog->name }}</a>
                                        </td>
                                        <td> <a href="{{ route('blogs.edit', ['blog' => $blog]) }}"
                                                class="btn btn-sm btn-primary mr-2">Edit</a>

                                            <form action="{{ route('blogs.destroy', ['blog' => $blog]) }}"
                                                id="delete_form_{{ $blog->id }}" class="d-inline" method="POST">
                                                @method('delete')
                                                @csrf

                                                <button type="button" class="btn btn-sm btn-danger mr-2"
                                                    onclick="deleteBlog({{ $blog->id }})">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach

                            @endif
                        </tbody>
                    </table>
                    @if (count($blogs) > 0)
                        {{ $blogs->render('pagination::bootstrap-4') }}
                    @endif
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            function deleteBlog(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this blog!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete_form_' + id).submit();
                    }
                });
            }
        </script>
    </section>
    <!-- ================ contact section end ================= -->

@endsection
