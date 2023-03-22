<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scal=1.0, shrink-to-fit=no">
<meta name="keywords" content="main, page, myblog,, blog, php">
<meta name="description" content="Myblog main page">
<title>Posts List</title>
</head>
<body>
<ul>
{% for post in postsList %}
<li>Post #{{ post.uid }}</li>
<li>Post Title {{ post.title }}</li>
<li>Post Author {{ post.author }}</li>
<li>
<a href="/posts/{{ post.uid }}">Go to the Post</a>
</li>
{% endfor %}
</ul>
</body>
</html>