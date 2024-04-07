<x-layouts.main>
    <x-slot:title>Post qo'shish</x-slot:title>
    <div class="row">
        <div class="col-md-6 offset-3 mt-5">
            <div class="contact-form">
                <div id="success"></div>
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-6 control-group">
                            <input type="text" class="form-control p-4" value="{{ old('title') }}" name="title"
                                placeholder="Enter title" data-validation-required-message="Sarlavhani kiriting!" />

                            @error('title')
                                <p class="help-block text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-6 control-group">
                            <input type="file" class="form-control p-4" name="photo" placeholder="Enter photo"
                                required="required" data-validation-required-message="Please enter your email" />
                            @error('photo')
                                <p class="help-block text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="control-group">
                        <input type="text" class="form-control p-4" value="{{ old('short_content') }}"
                            name="short_content" placeholder="short content"
                            data-validation-required-message="Please enter a subject" />
                        @error('short_content')
                            <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="control-group">
                        <select name="category_id" class="form-control mt-2 mb-2">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('short_content')
                            <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="control-group">
                        <textarea class="form-control p-4" rows="6" name="content" value="{{ old('content') }}" placeholder="Content"
                            data-validation-required-message="Please enter your message"></textarea>
                        @error('content')
                            <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <button class="btn btn-primary btn-block py-3 px-5" type="submit">Qo'shish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.main>
