<html>
<head>

    <link href="{{ $includes_path }}css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ $includes_path }}css/styles.css" rel="stylesheet">

    <style>

    </style>

</head>

<body>

    <div class="course-title">
        <!-- course title -->
    </div>

    <div class="flex-container">
        <div class="flex-item">
            <div class="item-tree">
                <ul>
                    {!! $menu !!}
                </ul>
            </div>
        </div>
        <div class="flex-item">
            <div class="content-body">
                {!! $content !!}
            </div>
        </div>
    </div>





    <script src="{{ $includes_path }}javascript/jquery-3.3.1.min.js"></script>
    <script src="{{ $includes_path }}javascript/bootstrap.min.js"></script>
    <script src="{{ $includes_path }}packages/mathjax/MathJax.js?config=TeX-AMS-MML_SVG"></script>
    <script src="{{ $includes_path }}javascript/layout.js"></script>

    {!! $javascript !!}

</body>
</html>