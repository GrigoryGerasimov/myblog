{% extends "posts/template.html" %}

{% block body %}

    <section class="blog-card__large-wrapper">

        <article class="blog-card__large">
            <div>
                <h5 class="blog-card__card-id">#{{ uid }}</h5>
                <hr class="divider-minor"/>
            </div>

            <h1>{{ title }}</h1>
            <hr class="divider-major"/>
            <h4>{{ author }}</h4>
            <pre class="blog-card__text-block">{{ text }}</pre>
        </article>

        <article class="blog-card__links-block">
            <a href="/posts" class="blog-card__link margin-divider">Back</a>
            <a href="/posts/{{ uid }}/update" class="blog-card__link margin-divider">Edit</a>
            <a href="/posts/{{ uid }}/delete" class="blog-card__link margin-divider">Delete</a>
        </article>

    </section>

{% endblock %}