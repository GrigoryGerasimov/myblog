{% extends "admin/admin-template.html" %}

{% block main %}

<h4 class="admin-dashboard__title__single full-width">Posts</h4>
<hr class="divider-minor full-width"/>
            
<ul class="admin-dashboard__list full-width">
    
<table class="admin-dashboard__table">
        <thead>
            <tr class="admin-dashboard__table-header">
                <th class="admin-dashboard__table-cell">Post ID</th>
                <th class="admin-dashboard__table-cell">Title</th>
                <th class="admin-dashboard__table-cell">Author</th>
                <th class="admin-dashboard__table-cell">Description</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>

{% for post in adminPostsList %}

<tr>
    <td>{{ post.uid }}</td>
    <td>{{ post.title }}</td>
    <td>{{ post.author }}</td>
    <td>{{ post.description }}</td>
    <td>
        <a href="/admin/posts/{{ post.uid }}" class="admin-dashboard__list-link margin-left-divider margin-divider-small">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="admin-dashboard_table-icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
        </a>
    </td>
    <td>
        <a href="/admin/posts/{{ post.uid }}/update" class="admin-dashboard__list-link margin-divider-small">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="admin-dashboard_table-icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
        </a>
        
    </td>
    <td>
        <a href="/admin/posts/{{ post.uid }}/delete" class="admin-dashboard__list-link margin-divider-small">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="admin-dashboard_table-icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>
    </td>

</tr>

{% endfor %}

        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">
                    <a href="/admin/posts/create" class="admin-dashboard__list-link admin-dashboard__list-link__compound">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="admin-dashboard_table-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span>Create New Post</span>
                    </a>
                </th>
            </tr>
            
        </tfoot>
    </table>
                
    <hr class="divider-major margin-separator"/>

</ul>

{% endblock %}