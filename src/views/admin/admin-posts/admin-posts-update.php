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

<h4 class="admin-post-edit__title margin-separator">Edit Post</h4>

<article class="admin-dashboard__post">
    <form name="post-edit-form" method="POST" class="admin-post-edit__form">
        <input id="title" name="title" value="{{ title }}" placeholder="Title" class="styles-resetter admin-post-edit__form__input" required/>
        <input id="author" name="author" value="{{ author }}" placeholder="Author" class="styles-resetter admin-post-edit__form__input" required/>
        <textarea id="text" name="text" placeholder="Write your post here..." class="styles-resetter admin-post-edit__form__text-area" required>{{ text }}</textarea>
        <article class="admin-post-edit__form__btn__btn-block">
            <button type="submit" class="styles-resetter admin-post-edit__form__btn__btn margin-divider">Update</button>
        </article>
    </form>

</article>

{% endif %}

{% endblock %}