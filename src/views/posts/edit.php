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

            <form name="editPost" method="POST" class="blog-card__edit-form" enctype="multipart/form-data">
                <input id="title" name="title" value="{{ title }}" placeholder="Post Title" class="styles-resetter blog-card__edit-input"/>
                <input id="author" name="author" value="{{ author }}" placeholder="Post Author" class="styles-resetter blog-card__edit-input"/>
                <input name="MAX_FILE_SIZE" type="hidden" value="3000000"/>
                <input id="file" name="file" type="file" class="styles-resetter blog-card__create-input"/>
                <textarea id="text" name="text" placeholder="Write your post here..." class="styles-resetter blog-card__edit-text-area">{{ text }}</textarea>
                
                {% if (filepath) %}
                <img src="/{{ filepath }}" alt="pic" class="blog-card__img"/>
                {% endif %}
                
                <article class="blog-card__links-block__centered">
                    <a href="/posts/{{ uid }}" class="blog-card__link margin-divider">Back</a>

                    {% if (isAuthor is same as (author)) %}
                    <button type="submit" class="styles-resetter blog-card__edit-btn margin-divider">Update</button>
                    {% endif %}
                    
                </article>
            </form>

            <h4 class="notification-success">{{ notification }}</h4>
        </article>

        {% if (error) %}
        
        <h4 class="notification-fail margin-top-divider">{{ error }}</h4>
        
        {% endif %}
        
    </main>

</div>

{% endblock %}