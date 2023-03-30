{% extends "admin/admin-template.html" %}

{% block main %}


<div class="admin-dashboard__section-title full-width">
    <a href="/admin/roles" class="admin-dashboard__link margin-divider">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="admin-dashboard_table-icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
        </svg>
    </a>
    <h4 class="admin-dashboard__title">Roles</h4>
</div>
<hr class="divider-minor full-width"/>

<h4 class="admin-role-creation__title margin-separator">Create New Role</h4>

    <form name="role-create-form" method="POST" class="admin-role-creation__form">
        <div class="admin-role-creation__form__labelled-block">
            <label for="rolename" class="admin-role-creation__form__label">Role Name</label>
            <input type="text" id="rolename" name="rolename" class="styles-resetter admin-role-creation__form__input"/>
        </div>
        <div class="admin-role-creation__form__labelled-block">
            <label for="permission" class="admin-role-creation__form__label">Admin Permission</label>
            <div class="admin-role-creation__form__input-radio">
                <input type="radio" id="permission" name="permission" value="0" class="margin-divider" checked/>false
                <input type="radio" id="permission" name="permission" value="1" class="margin-divider"/>true
            </div>
        </div>
        <div class="admin-role-creation__form__btn__btn-block margin-top-divider">
            <button type="submit" class="styles-resetter admin-role-creation__form__btn__btn">Create</button>
        </div>
    </form>

{% if (error) %}

<h4 class="notification-fail">{{ error }}</h4>

{% endif %}

{% endblock %}