<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"
          integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
</head>
<body>
<div id="app">
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">


                </ul>

            </div>
        </nav>

        <div class="row mt-3">
            <div class="col-lg-3 col-md-3 col-sm-12 px-5">
                @yield('button')

                <div class="nav flex-column nav-pills shadow-lg">
                    <a class="nav-link @if(!$filter || $filter===null) active @endif" href="{{ route('discussion') }}">All Threads</a>
                    <a class="nav-link @if($filter && $filter==='my-threads') active @endif" href="{{ route('discussion',['filter'=>'my-threads']) }}">My Threads</a>
                    <a class="nav-link @if($filter && $filter==='participated') active @endif" href="{{ route('discussion',['filter'=>'participated']) }}">My Participation</a>
                    <a class="nav-link @if($filter && $filter==='popular') active @endif" href="{{ route('discussion',['filter'=>'popular']) }}">Popular This Week</a>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 px-5">
            @yield('content')
            </div>

        </div>

    </div>





</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"
        integrity="sha512-XKa9Hemdy1Ui3KSGgJdgMyYlUg1gM+QhL6cnlyTe2qzMCYm4nAZ1PsVerQzTTXzonUR+dmswHqgJPuwCq1MaAg==" crossorigin="anonymous"></script>
<script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
<script src="https://unpkg.com/turndown/dist/turndown.js"></script>
<script>
    var easyMDE = new EasyMDE({
        autoDownloadFontAwesome: false,
        element: document.getElementById('editor'),
        toolbar: false,
        status: true,

        forceSync: true,
    });

    $('#previewThis').on('change',function(){
        window.easyMDE.togglePreview();
    })

</script>
@yield('script')
</body>
</html>
