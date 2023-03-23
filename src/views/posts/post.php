<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scal=1.0, shrink-to-fit=no">
<meta name="keywords" content="main, page, myblog,, blog, php">
<meta name="description" content="Myblog main page">
<link href="/index.css" rel="stylesheet"/>
<title>Post #{{ uid }}</title>
</head>
<body>
<main class="blog-container">
<section class="blog-card__large-wrapper">
<article class="blog-card__large">
<div>
<h5 class="blog-card__card-id">#{{ uid }}</h5>
<hr class="divider-minor"/>
</div>
<h1>{{ title }}</h1>
<hr class="divider-major"/>
<h4>{{ author }}</h4>
<pre class="blog-card__text-block">{{ text }}</pre>
</article>
<article class="blog-card__links-block">
<a href="/posts" class="blog-card__link margin-divider">Back</a>
<a href="/posts/{{ uid }}/update" class="blog-card__link margin-divider">Edit</a>
<a href="/posts/{{ uid }}/delete" class="blog-card__link margin-divider">Delete</a>
</article>
</section>
</main>
</body>
</html>