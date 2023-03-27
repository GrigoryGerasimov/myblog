{% extends "template.html" %}

{% block css %}

<link href="/views/admin/css/admin-main.css" rel="stylesheet"/>

{% endblock %}


{% block body %}

<div class="admin-container">

{% use "admin/admin-template_header.html" %}

   {% block header %}
       {{ parent() }}
   {% endblock %}

    <div class="admin__large-wrapper">

        <aside class="admin-dashboard__aside">
            <ul class="admin_dashboard__aside-list">
                <li class="admin_dashboard__aside-list-item margin-divider">
                    <a href="/admin/posts" class="admin_dashboard__aside-list-link">Posts</a>
                </li>
                <li class="admin_dashboard__aside-list-item margin-divider">
                    <a href="/admin/users" class="admin_dashboard__aside-list-link">Users</a>
                </li>
                <li class="admin_dashboard__aside-list-item margin-divider">
                    <a href="/admin/roles" class="admin_dashboard__aside-list-link">Roles</a>
                </li>
            </ul>
        </aside>

        <main class="admin-dashboard__main">
            <h1>Dashboard</h1>
        </main>

    </div>
    
</div>

{% endblock %}