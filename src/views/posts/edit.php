{% extends "posts/template.html" %}

{% block body %}

    <section class="blog-card__large-wrapper">

        <article class="blog-card__large">
            <div>
                <h5 class="blog-card__card-id">#{{ uid }}</h5>
                <hr class="divider-minor"/>
            </div>

            <form name="editPost" method="POST" class="blog-card__edit-form">
                <input id="title" name="title" value="{{ title }}" placeholder="Post Title" class="styles-resetter blog-card__edit-input"/>
                <input id="author" name="author" value="{{ author }}" placeholder="Post Author" class="styles-resetter blog-card__edit-input"/>
                <textarea id="text" name="text" placeholder="Write your post here..." class="styles-resetter blog-card__edit-text-area">{{ text }}</textarea>
                <article class="blog-card__links-block">
                    <a href="/posts/{{ uid }}" class="blog-card__link margin-divider">Back</a>
                    <button type="submit" class="styles-resetter blog-card__edit-btn margin-divider">Update</button>
                </article>
            </form>

            <h4 class="notification-success">{{ notification }}</h4>
        </article>

    </section>

{% endblock %}