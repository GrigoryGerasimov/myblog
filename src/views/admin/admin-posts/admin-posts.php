{% extends "admin/admin-template.html" %}

{% block main %}

<h5 class="admin-dahsboard__section-title full-width">Posts</h5>
<hr class="divider-minor full-width"/>
            
<ul class="admin-dashboard__list full-width">

    {% for post in adminPostsList %}

    <li class="admin-dashboard__list-item">
        <h3 class="admin-dashboard__list-info">{{ post.title }}</h3>
        <h4 class="admin-dashboard__list-info">{{ post.author }}</h4>
        <p class="admin-dashboard__list-info">{{ post.description }}...</p>
        <div class="admin-dashboard__list-links-block">
            <a href="/posts/{{ post.uid }}" class="admin-dashboard__list-link margin-divider">Read more</a>
            <a href="/posts/{{ post.uid }}/update" class="admin-dashboard__list-link margin-divider">Edit</a>
            <a href="/posts/{{ post.uid }}/delete" class="admin-dashboard__list-link margin-divider">Delete</a>
        </div>
    </li>
                
    <hr class="divider-major margin-separator"/>

    {% endfor %}
                
</ul>

{% endblock %}