<!DOCTYPE html>
<html lang="en">
    <head>


    </head>

    <body id="app-body">

        <div class="content-page shadow">

            <div id="body">{!! $content !!}</div>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-AMS-MML_SVG"></script>

        <script>
            MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
        </script>

    </body>

</html>