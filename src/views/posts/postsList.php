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

   </main>
   
</div>

{% endblock %}