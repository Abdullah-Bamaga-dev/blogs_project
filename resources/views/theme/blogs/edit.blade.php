@extends('theme.master')
@section('title', 'Edit blog')

@section('content')
    @include('theme.partisal.hero', [
        'title' => $blog->name,
    ])

    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (session('BlogEditStatus'))
                        <div class="alert alert-success">
                            {{ session('BlogEditStatus') }}
                        </div>
                    @endif
                    <form action="{{ route('blogs.update' , ['blog' => $blog]) }}" class="form-contact contact_form" method="post"
                        novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <input class="form-control border" name="name" type="text" placeholder="Enter your name"
                                value="{{ $blog->name }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label for="customImage" class="form-control border"
                                style="cursor: pointer; padding-top: 10px; color: #777;">
                                📁 Choose an image...
                            </label>

                            <input id="customImage" name="image" type="file" style="display: none;">

                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <select class="form-control border" name="category_id" placeholder="Enter email address"
                                value="{{ old('category_id') }}">
                                <option value="">Select Category</option>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if ($category->id == $blog->category_id)
                                            selected
                                        @endif>{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <textarea class="w-100 border" name="description" placeholder="Enter your name" rows="5">{{ $blog->description }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="form-group text-center text-md-right mt-3">
                            <button type="submit" class="button button--active button-contactForm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            let inputImage = document.getElementById('customImage');

            let label = document.querySelector('label[for="customImage"]');

            inputImage.addEventListener('change', function(e) {

                if (e.target.files.length > 0) {
                    let fileName = e.target.files[0].name;

                    label.innerText = '📁 ' + fileName;

                    label.style.color = '#333';
                }
            });
        </script>
    </section>
    <!-- ================ contact section end ================= -->

@endsection
