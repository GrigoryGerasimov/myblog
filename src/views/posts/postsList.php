<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scal=1.0, shrink-to-fit=no">
<meta name="keywords" content="main, page, myblog,, blog, php">
<meta name="description" content="Myblog main page">
<link href="/index.css" rel="stylesheet"/>
<title>Posts List</title>
</head>
<body>
<main class="blog-container">
<h3 class="blog-new__link">
<a href="/posts/create" class="blog-card__link">Create New Post</a>
</h3>
<section class="blog-list-wrapper">
{% for post in postsList %}
<ul class="blog-card">
<li class="blog-card__item blog-card__card-id">#{{ post.uid }}</li>
<li class="blog-card__item">Title: <strong>{{ post.title }}</strong></li>
<li class="blog-card__item">Author: <strong>{{ post.author }}</strong></li>
<li class="blog-card__item">
<a href="/posts/{{ post.uid }}" class="blog-card__link">Read more...</a>
</li>
</ul>
{% endfor %}
</section>
</main>
</body>
</html>