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

            <form name="deletePost" method="POST" class="blog-card__delete-form">
                <input id="title" name="title" value="{{ title }}" placeholder="Post Title" class="styles-resetter blog-card__delete-input" readonly/>
                <input id="author" name="author" value="{{ author }}" placeholder="Post Author" class="styles-resetter blog-card__delete-input" readonly/>
                <textarea id="text" name="text" placeholder="Write your post here..." class="styles-resetter blog-card__delete-text-area" readonly>{{ text }}</textarea>
                
                {% if (filepath) %}
                <img src="/{{ filepath }}" alt="pic" class="blog-card__img"/>
                {% endif %}
                
                <article class="blog-card__links-block__centered">
                    <a href="/posts" class="blog-card__link margin-divider">Back</a>

                    {% if (isAuthor is same as (author)) %}
                    <button type="submit" class="styles-resetter blog-card__delete-btn margin-divider">Delete</button>
                    {% endif %}

                </article>
            </form>

            <h4 class="notification-success">{{ notification }}</h4>
        </article>

    </main>
    
</div>

{% endblock %}