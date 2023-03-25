{% extends "template.html" %}

{% block css %}

<link href="/views/posts/css/posts-main.css" rel="stylesheet"/>

{% endblock %}

{% block body %}

<div class="blog-container">

{% use "template_header.html" %}

   {% block header %}
       {{ parent() }}
   {% endblock %}

    <main class="blog-card__large-wrapper">

        <article class="blog-card__large">
            <form name="createPost" method="POST" class="blog-card__create-form">
                <input id="title" name="title" placeholder="Title" class="styles-resetter blog-card__create-input"/>
                <input id="author" name="author" placeholder="Author" class="styles-resetter blog-card__create-input"/>
                <textarea id="text" name="text" placeholder="Write your post here..." class="styles-resetter blog-card__create-text-area"></textarea>
                <article class="blog-card__links-block">
                    <a href="/posts/{{ uid }}" class="blog-card__link margin-divider">Back</a>
                    <button type="submit" class="styles-resetter blog-card__create-btn margin-divider">Send</button>
                </article>
            </form>

            <h4 class="notification-success">{{ notification }}</h4>
        </article>

    </main>
    
</div>

{% endblock %}