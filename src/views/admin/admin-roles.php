{% extends "admin/admin-template.html" %}

{% block main %}

<h5 class="admin-dahsboard__section-title full-width">Roles</h5>
<hr class="divider-minor full-width"/>
            
<ul class="admin-dashboard__list full-width">

    {% for role in adminRolesList %}

    <li class="admin-dashboard__list-item">
        <h3 class="admin-dashboard__list-info">{{ role.id }}</h3>
        <h4 class="admin-dashboard__list-info">{{ role.role_name }}</h4>
        <p class="admin-dashboard__list-info">{{ role.permission }}...</p>
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