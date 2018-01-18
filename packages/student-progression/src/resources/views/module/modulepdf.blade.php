<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="{{ url($course->template->file_path) }}" />
</head>
<body>
<div class="container">
<div class="row">    
<ul style="list-style-type:none">    
@each('student-progression::module.items', $items, 'item','eon.storyline2::student.partials.none')
</ul>
</div>
</div>    
<footer class="row">
   
</footer> 
</body>
</html>
