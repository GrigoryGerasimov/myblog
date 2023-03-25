{% extends "posts/template.html" %}

{% block body %}

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

{% endblock %}