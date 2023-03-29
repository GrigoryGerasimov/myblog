{% extends "admin/admin-template.html" %}

{% block main %}

{% if (error) %}

<h4 class="notification-fail margin-separator">{{ error }}</h4>
<a href="/admin/posts" class="admin-dashboard__link margin-divider">Back</a>

{% else %}

<div class="admin-dashboard__section-title full-width">
    <a href="/admin/posts" class="admin-dashboard__link margin-divider">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="admin-dashboard_table-icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
        </svg>
    </a>
    <h4 class="admin-dashboard__title">Post #{{ uid }}</h4>
</div>
<hr class="divider-minor full-width"/>

<h4 class="admin-post-delete__title margin-separator">Delete Post</h4>

<article class="admin-dashboard__post">
    <form name="post-delete-form" method="POST" class="admin-post-delete__form">
        <input id="title" name="title" value="{{ title }}" placeholder="Title" class="styles-resetter admin-post-delete__form__input" readonly/>
        <input id="author" name="author" value="{{ author }}" placeholder="Author" class="styles-resetter admin-post-delete__form__input" readonly/>
        <textarea id="text" name="text" placeholder="Write your post here..." class="styles-resetter admin-post-delete__form__text-area" readonly>{{ text }}</textarea>
        <article class="admin-post-delete__form__btn__btn-block">
            <button type="submit" class="styles-resetter admin-post-delete__form__btn__btn margin-divider">Delete</button>
        </article>
    </form>

</article>

{% endif %}

{% endblock %}