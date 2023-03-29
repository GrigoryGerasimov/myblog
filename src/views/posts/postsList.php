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

   <main class="blog-list-wrapper">

   <ul class="blog-card full-width">

    {% for post in postsList %}

    <li class="blog-card__list-item">
        <h5 class="blog-card__card-id">#{{ post.uid }}</h5>
        <h3 class="blog-card__item">{{ post.title }}</h3>
        <h4 class="blog-card__item">{{ post.author }}</h4>
        <p class="blog-card__item">{{ post.description }}...</p>
        <div class="blog-card__links-block">
            <a href="/posts/{{ post.uid }}" class="blog-card__link margin-divider">Read more</a>
            <a href="/posts/{{ post.uid }}/update" class="blog-card__link margin-divider">Edit</a>
            <a href="/posts/{{ post.uid }}/delete" class="blog-card__link margin-divider">Delete</a>
        </div>
    </li>
                
    <hr class="divider-major margin-separator"/>

    {% endfor %}

   </main>
   
</div>

{% endblock %}