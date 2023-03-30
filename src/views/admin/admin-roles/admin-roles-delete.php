{% extends "admin/admin-template.html" %}

{% block main %}

{% if (error) %}

<h4 class="notification-fail margin-separator">{{ error }}</h4>
<a href="/admin/roles" class="admin-dashboard__link margin-divider">Back</a>

{% else %}

<div class="admin-dashboard__section-title full-width">
    <a href="/admin/roles" class="admin-dashboard__link margin-divider">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="admin-dashboard_table-icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
        </svg>
    </a>
    <h4 class="admin-dashboard__title">Role #{{ id }}</h4>
</div>
<hr class="divider-minor full-width"/>

<h4 class="admin-role-delete__title margin-separator">Delete Role</h4>

    <form name="role-delete-form" method="POST" class="admin-role-delete__form">
        <div class="admin-role-delete__form__labelled-block">
            <label for="rolename" class="admin-role-delete__form__label">Role Name</label>
            <input type="text" id="rolename" name="rolename" value="{{ rolename }}" class="styles-resetter admin-role-delete__form__input" readonly/>
        </div>
        <div class="admin-role-delete__form__labelled-block">
            <label for="permission" class="admin-role-delete__form__label">Admin Permission</label>
            <div class="admin-role-delete__form__input-radio">
                {% if (permission) %}
                <input type="radio" id="permission" name="permission" value="0" class="margin-divider"/>false
                <input type="radio" id="permission" name="permission" value="1" class="margin-divider" checked/>true
                {% else %}
                <input type="radio" id="permission" name="permission" value="0" class="margin-divider" checked/>false
                <input type="radio" id="permission" name="permission" value="1" class="margin-divider"/>true
                {% endif %}
            </div>
        </div>
        <div class="admin-role-delete__form__btn__btn-block margin-top-divider">
            <button type="submit" class="styles-resetter admin-role-delete__form__btn__btn">Delete</button>
        </div>
    </form>

{% endif %}

{% endblock %}