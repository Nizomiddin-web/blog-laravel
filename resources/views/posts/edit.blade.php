<x-layouts.main>
    <x-slot:title>Post Tahrirlash</x-slot:title>
    <x-pageheader>Post o'zgartirish #{{$post->id}}</x-pageheader>
    <div class="row">
        <div class="col-md-6 offset-3 mt-5">
            <div class="contact-form">
                <div id="success"></div>
                <form action="{{ route('posts.update',["post"=>$post->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-6 control-group mt-2">
                            <input type="text" class="form-control p-4" value="{{ $post->title }}" name="title"
                                placeholder="Enter title" data-validation-required-message="Sarlavhani kiriting!" />

                            @error('title')
                                <p class="help-block text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-sm-6 control-group mt-2">
                            <input type="file" class="form-control p-4" name="photo" placeholder="Enter photo"
                                data-validation-required-message="Please enter your email"/>
                            @error('photo')
                                <p class="help-block text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="control-group mt-2">
                        <input type="text" class="form-control p-4" value="{{ $post->short_content}}"
                            name="short_content" placeholder="short content"
                            data-validation-required-message="Please enter a subject" />
                        @error('short_content')
                            <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="control-group mt-2">
                        <textarea class="form-control p-4" rows="6" name="content"  placeholder="Content"
                            data-validation-required-message="Please enter your message">{{$post->content}}</textarea>
                        @error('content')
                            <p class="help-block text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <button class="btn btn-success mt-2 py-3 px-5" type="submit">O'zgartirish</button>
                        <a class="btn btn-primary py-3 px-5 mt-2" href="{{route("posts.show",["post"=>$post->id])}}">Bekor qilish</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.main>
