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
            <a class="navbar-brand" href="{{ route('panel-admin') }}">مدیریت وبسایت</a>
        </div>
    </nav>

    <div class="col col-10 m-5">
        <form method="post" action="{{ route('panel-updatePost' , $post->id) }}" enctype="multipart/form-data" >
            @csrf
            <div class="mb-3">
                <label for="recipient-name " class="col-form-label">کاور پست</label>
                <input name="cover" class="form-control" type="file" id="formFile" value="{{ $post->cover }}">
            </div>
            @error('cover')
            {{ $message }}
            @enderror

            <div class="mb-3">
                <label for="message-text" class="col-form-label">عنوان فارسی</label>
                <input name="title_fa" type="text" class="form-control" id="recipient-name"  value="{{ $post->title_fa }}">
            </div>
            @error('title_fa')
            {{ $message }}
            @enderror
            <div class="mb-3">
                <label for="message-text" class="col-form-label">عنوان لاتین</label>
                <input name="title_en" type="text" class="form-control" id="recipient-name"  value="{{ $post->title_en }}">
            </div>
            @error('title_en')
            {{ $message }}
            @enderror

            <div class="mb-3">
                <label for="message-text" class="col-form-label">مسیر</label>
                <input name="slug" type="text" class="form-control" id="recipient-name" value="{{ $post->slug }}">
            </div>
            @error('slug')
            {{ $message }}
            @enderror


            <div class="mb-3">
                <label for="message-text" class="col-form-label">توضیحات کوتاه فارسی</label>
                <input name="description_fa" type="text" class="form-control" id="recipient-name"  value="{{ $post->caption_fa }}">
            </div>
            @error('description_fa')
            {{ $message }}
            @enderror

            <div class="mb-3">
                <label for="message-text" class="col-form-label">توضیحات کوتاه لاتین</label>
                <input name="description_en" type="text" class="form-control" id="recipient-name" value="{{ $post->caption_en }}">
            </div>
            @error('description_en')
            {{ $message }}
            @enderror

            <div class="mb-3">
                <label for="message-text" class="col-form-label">کلمات کلیدی فارسی</label>
                <input name="keywords_fa" type="text" class="form-control" id="recipient-name" value="{{ $post->keywords_fa }}">
            </div>
            @error('keywords_fa')
            {{ $message }}
            @enderror

            <div class="mb-3">
                <label for="message-text" class="col-form-label">کلمات کلیدی لاتین</label>
                <input name="keywords_en" type="text" class="form-control" id="recipient-name" value="{{ $post->keywords_en }}">
            </div>
            @error('keywords_en')
            {{ $message }}
            @enderror

            <div class="mb-3">
                <label for="message-text" class="col-form-label">محتویات فارسی</label>
                <textarea name="body_fa" id="content_fa" class="text-dark">{{ $post->body_fa }}</textarea>
            </div>
            @error('body_fa')
            {{ $message }}
            @enderror

            <div class="mb-3">
                <label for="message-text" class="col-form-label">محتویات لاتین</label>
                <textarea name="body_en" id="content_en" class="text-dark">{{ $post->body_en }}</textarea>
            </div>
            @error('body_en')
            {{ $message }}
            @enderror


            <div class="mb-3 col-12">
                <label for="message-text" class="col-form-label">تگ ها ( دسته بندی ها )</label>
                @if(!$tags->isEmpty())
                    <select class="js-example-basic-multiple col col-12" name="tags[]" multiple="multiple">
                        @foreach($tags as $tag)
                                <option value="{{ $tag->id }}"
                                        @foreach($post->tags as $postTag)
                                            @if($tag->id == $postTag->id)
                                                selected="selected"
                                           @endif
                                        @endforeach
                                >{{ $tag->label_fa }}</option>
                        @endforeach
                    </select>
                @else
                    <p>متاسفانه دسته بندی وجود ندارد ! ابتدا یک دسته بندی ایجاد کنید !</p>
                @endif
            </div>
            @error('tags')
            {{ $message }}
            @enderror
            <div class="mb-3 d-flex align-items-center">
                <label for="message-text" class="col-form-label">نمایش دهد ؟</label>
                <input name="disable" class="form-check-input m-2" type="checkbox" value="true" id="flexCheckIndeterminate"
                    @if(!$post->disable) checked @endif
                >
            </div>
            @error('disable')
            {{ $message }}
            @enderror
            <button class="btn btn-primary" type="submit">ذخیره</button>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.0.0/ckeditor.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    const setting = {
        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        toolbar: {
            items: [
                'exportPDF','exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        language: 'fa',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: 'Welcome to CKEditor 5!',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        // The "super-build" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'CKBox',
            'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType
            'MathType'
        ] ,
    };
    ClassicEditor.create( document.querySelector( '#content_fa' ) , setting)
        .catch( error => {
            console.error( error );
        } );
    ClassicEditor.create( document.querySelector( '#content_en' ) , setting)
        .catch( error => {
            console.error( error );
        } );
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });

</script>
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
