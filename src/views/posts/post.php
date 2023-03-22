<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scal=1.0, shrink-to-fit=no">
<meta name="keywords" content="main, page, myblog,, blog, php">
<meta name="description" content="Myblog main page">
<title>Post #{{ uid }}</title>
</head>
<body>
<section>
<article>
<h1>{{ title }}</h1>
</article>
<article>
<h4>{{ author }}</h4>
</article>
<article>
<pre>{{ text }}</pre>
</article>
</section>
<section>
<a href="/posts/{{ uid }}/update">Edit Post</a>
<a href="/posts/{{ uid }}/delete">Delete Post</a>
</section>
</body>
</html>