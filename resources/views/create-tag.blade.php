<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>

<div class="container-fluid">
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">مدیریت وبسایت</a>
        </div>
    </nav>

    <div class="col col-10 m-5">
        <form method="post" action="{{ route('panel-saveNewTag') }}" enctype="multipart/form-data" >
            @csrf
            <div class="mb-3">
                <label for="recipient-name " class="col-form-label">کاور تگ</label>
                <input name="cover" class="form-control" type="file" id="formFile">
            </div>
            @error('cover')
                {{ $message }}
            @enderror

            <div class="mb-3">
                <label for="message-text" class="col-form-label">برچسب فارسی</label>
                <input name="label_fa" type="text" class="form-control" id="recipient-name">
            </div>
            @error('label_fa')
            {{ $message }}
            @enderror

            <div class="mb-3">
                <label for="message-text" class="col-form-label">برچسب انگلیسی</label>
                <input name="label_en" type="text" class="form-control" id="recipient-name">
            </div>
            @error('label_en')
            {{ $message }}
            @enderror


            <div class="mb-3">
                <label for="message-text" class="col-form-label">مسیر دسته بندی</label>
                <input name="slug" type="text" class="form-control" id="recipient-name">
            </div>
            @error('slug')
            {{ $message }}
            @enderror

            <div class="mb-3">
                <label for="message-text" class="col-form-label">توضیحات کوتاه فارسی</label>
                <input name="caption_fa" type="text" class="form-control" id="recipient-name">
            </div>
            @error('caption_fa')
            {{ $message }}
            @enderror
            <div class="mb-3">
                <label for="message-text" class="col-form-label">توضیحات کوتاه لاتین</label>
                <input name="caption_en" type="text" class="form-control" id="recipient-name">
            </div>
            @error('caption_en')
            {{ $message }}
            @enderror

            <button class="btn btn-primary" type="submit">ذخیره</button>
        </form>
    </div>
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
</body>
</html>
