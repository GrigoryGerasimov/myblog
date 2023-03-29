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

<article class="admin-dashboard__post">
    <h1>{{ title }}</h1>
    <hr class="divider-major"/>
    <h4>{{ author }}</h4>
    <div class="admin-dashboard__text-block">{{ text }}</div>
</article>

{% endif %}

{% endblock %}