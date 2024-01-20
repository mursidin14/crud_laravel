<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card norder-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                            
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="form-weight-bold">GAMBAR</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                            @error('image')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label class="form-weight-bold">TITLE</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $post->title) }}" placeholder="Masukkan Judul Post">
                            </div>

                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-group">
                                <label class="form-weight-bold">KONTENT</label>
                                <textarea name="content" rows="5" placeholder="Masukkan konten post"> {{ old('content', $post->content) }} </textarea>
                            </div>

                            @error('content')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'content' );
    </script>
</body>
</html>