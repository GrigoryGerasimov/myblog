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
            <div>
                <h5 class="blog-card__card-id">#{{ uid }}</h5>
                <hr class="divider-minor"/>
            </div>

            <h1>{{ title }}</h1>
            <hr class="divider-major"/>
            <h4>{{ author }}</h4>
            <div class="blog-card__text-block">{{ text }}</div>

            {% if (filepath) %}
            <img src="/{{ filepath }}" alt="pic" class="blog-card__img"/>
            {% endif %}

        </article>

        <article class="blog-card__links-block__centered">
            <a href="/posts" class="blog-card__link margin-divider">Back</a>

            {% if (isAuthor is same as (author)) %}
            <a href="/posts/{{ uid }}/update" class="blog-card__link margin-divider">Edit</a>
            <a href="/posts/{{ uid }}/delete" class="blog-card__link margin-divider">Delete</a>
            {% endif %}

        </article>

    </main>
    
</div>

{% endblock %}