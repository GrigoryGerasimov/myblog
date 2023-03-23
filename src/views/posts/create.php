<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scal=1.0, shrink-to-fit=no">
<meta name="keywords" content="main, page, myblog,, blog, php">
<meta name="description" content="Myblog main page">
<link href="/index.css" rel="stylesheet"/>
<title>Create New Post</title>
</head>
<body>
<main class="blog-container">
<section class="blog-card__large-wrapper">
<article class="blog-card__large">
<form name="createPost" method="POST" class="blog-card__create-form">
<input id="title" name="title" placeholder="Title" class="blog-card__create-input"/>
<input id="author" name="author" placeholder="Author" class="blog-card__create-input"/>
<textarea id="text" name="text" placeholder="Write your post here..." class="blog-card__create-text-area"></textarea>
<article class="blog-card__links-block">
<a href="/posts/{{ uid }}" class="blog-card__link margin-divider">Back</a>
<button type="submit" class="blog-card__create-btn margin-divider">Send</button>
</article>
</form>
<h4 class="notification-success">{{ notification }}</h4>
</article>
</section>
</main>
</body>
</html>