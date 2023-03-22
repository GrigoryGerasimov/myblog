<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scal=1.0, shrink-to-fit=no">
<meta name="keywords" content="main, page, myblog,, blog, php">
<meta name="description" content="Myblog main page">
<title>Edit Post # {{ uid }}</title>
</head>
<body>
<form name="editPost" method="POST">
<div>
<label for="title">Title</label>
<input id="title" name="title" value="{{ title }}" placeholder="Post Title"/>
</div>
<div>
<label for="author">Author</label>
<input id="author" name="author" value="{{ author }}" placeholder="Post Author"/>
</div>
<div>
<label for="text">Text</label>
<textarea id="text" name="text" placeholder="Write your post here...">{{ text }}</textarea>
</div>
<button type="submit">Update</button>
</form>
{{ notification }}
</body>
</html>