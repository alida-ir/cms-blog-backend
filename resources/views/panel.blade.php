<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="container-fluid">
    <nav class="navbar bg-light navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('panel-admin') }}">مدیریت وبسایت</a>
        </div>
        <div class="d-flex bg-danger justify-content-center rounded">
            <a class="p-2 text-white text-center" href="{{ route('logout-admin') }}">خروج</a>
        </div>
    </nav>

    <div class="col col-12">
        <div class="col col-6 d-flex p-1">
            <div class="m-5">
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#postCollapse" aria-expanded="false" aria-controls="postCollapse">
                    پست ها
                </button>
            </div>
            <div class="m-5">
                <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#tagCollapse" aria-expanded="false" aria-controls="tagCollapse">
                    تگ ها
                </button>
            </div>
            <div class="m-5">
                <button onclick="openDialog()" class="btn btn-secondary" type="button" >
                    آپلود عکس
                </button>
                <form id="uploadImg" method="post" action="{{ route('upload.file') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="file" hidden id="fileUploader" name="file">
                </form>
            </div>
        </div>
    </div>

    <div class="collapse m-5" id="postCollapse">
        <div class="card card-body">
            <div class="col col-12">
                <a href="{{ route("panel-createNewPost") }}" class="btn btn-primary">افزودن پست</a>
            </div>
            <div class="col col-12">
                @if(!$posts->isEmpty())
                <table class="table table-light table-hover mt-4">
                    <thead>
                    <tr>
                        <th scope="col">شمار</th>
                        <th scope="col">کاور</th>
                        <th scope="col">عنوان فارسی</th>
                        <th scope="col">عنوان لاتین</th>
                        <th scope="col">تاریخ ایجاد</th>
                        <th scope="col">دسته بندی</th>
                        <th scope="col">نمایش</th>
                        <th scope="col">ویرایش</th>
                        <th scope="col">حذف</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td><img src="{{ $post->cover }}" width="100px" alt="{{ $post->title }}"></td>
                            <td>{{ $post->title_fa }}</td>
                            <td>{{ $post->title_en }}</td>
                            <td>{{ verta($post->created_at)->format('Y/m/d') }}</td>
                            <td>
                                @foreach($post->tags as $tag)
                                    <span>{{ $tag->label_fa }}</span> ,
                                @endforeach
                            </td>
                            <td>{{ $post->disable ? "بله" : "خیر" }}</td>
                            <td><a href="{{ route('panel-editPost' , $post->id) }}" style="cursor: pointer;text-decoration: none">&DDotrahd;</a></td>
                            <td><span onclick="document.getElementById('deletePost').submit()" style="cursor: pointer">&bigotimes;</span></td>
                            <form id="deletePost" action="{{ route('panel-deletePost' , $post->id) }}" method="post">@method('DELETE') @csrf</form>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
                @else
                <p class="text-danger mt-4">هیچ پستی برای نمایش وجود ندارد !</p>
                @endif
            </div>
        </div>
    </div>
    <div class="collapse m-5" id="tagCollapse">
        <div class="card card-body">
            <div class="col col-12">
                <a href="{{ route("panel-createNewTag") }}" class="btn btn-primary">افزودن تگ ( دسته بندی )</a>
            </div>
            <div class="col col-12">
                @if(!$tags->isEmpty())
                <table class="table table-light table-hover mt-4">
                    <thead>
                    <tr>
                        <th scope="col">شمار</th>
                        <th scope="col">کاور</th>
                        <th scope="col">عنوان فارسی</th>
                        <th scope="col">عنوان لاتین</th>
                        <th scope="col">توضیحات فارسی</th>
                        <th scope="col">توضیحات لاتین</th>
                        <th scope="col">مسیر</th>
                        <th scope="col">تاریخ ایجاد</th>
                        <th scope="col">ویرایش</th>
                        <th scope="col">حذف</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($tags as $tag)
                        <tr>
                            <th scope="row">{{ $tag->id }}</th>
                            <td><img src="{{ $tag->img }}" width="100px" alt="{{ $tag->title }}"></td>
                            <td>{{ $tag->label_fa }}</td>
                            <td>{{ $tag->label_en }}</td>
                            <td>{{ $tag->caption_fa }}</td>
                            <td>{{ $tag->caption_en }}</td>
                            <td><a href="{{ $tag->slug }}">{{ $tag->slug }}</a></td>
                            <td>{{ verta($tag->created_at)->format('Y/m/d') }}</td>
                            <td><a href="{{ route('panel-editTag' , $tag->id) }}" style="cursor: pointer;text-decoration: none">&DDotrahd;</a></td>
                            <td><span onclick="document.getElementById('deleteTag').submit()" style="cursor: pointer">&bigotimes;</span></td>
                            <form id="deleteTag" action="{{ route('panel-deleteTag' , $tag->id) }}" method="post">@method('DELETE') @csrf</form>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
                @else
                <p class="text-danger mt-4">هیچ تگ ( دسته بندی ) برای نمایش وجود ندارد !</p>
                @endif
            </div>
        </div>
    </div>
    @if(\Illuminate\Support\Facades\Session::has('fileImg'))
        <div class="card card-body">
            <div class="col col-12">
                <div class="danger">
                    <span>{{ \Illuminate\Support\Facades\Session::get('fileImg') }}</span>
                </div>
                <img src="{{ \Illuminate\Support\Facades\Session::get('fileImg') }}" width="120px" />
            </div>
        </div>
    @endif

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<style>
    @font-face {
        font-family: 'customFont';
        src: url('https://cdn.fontcdn.ir/Fonts/Vazir/ad3cd4cbda94aee8578c1b622b9002f9dfe345c05870eb375a02da853d08f072.woff2');
        font-style: normal;
    }

    body {
        font-family: 'customFont', arial, sans-serif;
    }
</style>
<script>
    function openDialog () {
        document.getElementById('fileUploader').click();
    }
    document.getElementById('fileUploader').addEventListener('change', submitForm);
    function submitForm() {
        document.getElementById('uploadImg').submit();
    }
</script>
</body>
</html>
