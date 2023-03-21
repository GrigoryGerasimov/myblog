<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scal=1.0, shrink-to-fit=no">
<meta name="keywords" content="main, page, myblog,, blog, php">
<meta name="description" content="Myblog main page">
<title>Create</title>
</head>
<body>
<form name="createPost" method="POST">
<div>
<label for="title">Title</label>
<input id="title" name="title" placeholder="Post Title"/>
</div>
<div>
<label for="author">Author</label>
<input id="author" name="author" placeholder="Post Author"/>
</div>
<div>
<label for="text">Text</label>
<textarea id="text" name="text" placeholder="Write your post here..."></textarea>
</div>
<button type="submit">Send</button>

{{ notification }}

</form>
</body>
</html>