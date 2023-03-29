{% extends "admin/admin-template.html" %}

{% block main %}

<div class="admin-dashboard__section-title full-width">
    <h4 class="admin-dashboard__title__single">Users</h4>
</div>
<hr class="divider-minor full-width"/>
            
<ul class="admin-dashboard__list full-width">

    <table class="admin-dashboard__table">
        <thead>
            <tr class="admin-dashboard__table-header">
                <th class="admin-dashboard__table-cell">User ID</th>
                <th class="admin-dashboard__table-cell">E-Mail</th>
                <th class="admin-dashboard__table-cell">Password</th>
                <th class="admin-dashboard__table-cell">Username</th>
                <th class="admin-dashboard__table-cell">First Name</th>
                <th class="admin-dashboard__table-cell">Last Name</th>
                <th class="admin-dashboard__table-cell">Role</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>

{% for user in adminUsersList %}

<tr>
    <td>{{ user.id }}</td>
    <td>{{ user.email }}</td>
    <td>{{ user.password }}</td>
    <td>{{ user.username }}</td>
    <td>{{ user.firstname }}</td>
    <td>{{ user.lastname }}</td>
    <td>{{ user.role }}</td>
    <td>
        <a href="/admin/users/{{ user.id }}/update" class="admin-dashboard__list-link">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="admin-dashboard_table-icon margin-divider-small">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
        </a>
        
    </td>
    <td>
        <a href="/admin/users/{{ user.id }}/delete" class="admin-dashboard__list-link">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="admin-dashboard_table-icon margin-divider-small">
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
                    <a href="/admin/users/create" class="admin-dashboard__list-link admin-dashboard__list-link__compound">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="admin-dashboard_table-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span>Create New User</span>
                    </a>
                </th>
            </tr>
            
        </tfoot>
    </table>
                
    <hr class="divider-major margin-separator"/>

</ul>

{% endblock %}