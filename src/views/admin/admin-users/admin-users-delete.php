{% extends "admin/admin-template.html" %}

{% block main %}

<h5 class="admin-dashboard__section-title full-width">Users</h5>
<hr class="divider-minor full-width"/>

<h4 class="admin-user-delete__title margin-separator">Delete User #{{ id }}</h4>

    <form name="user-delete-form" method="POST" class="admin-user-delete__form">
        <div class="admin-user-delete__form__labelled-block">
            <label for="email" class="admin-user-delete__form__label">E-Mail</label>
            <input type="email" id="email" name="email" value="{{ email }}" class="styles-resetter admin-user-delete__form__input" required/>
        </div>
        <div class="admin-user-delete__form__labelled-block">
            <label for="password" class="admin-user-delete__form__label">Password</label>
            <input type="password" id="password" name="password" value="{{ password }}" class="styles-resetter admin-user-delete__form__input" required/>
        </div>
        <div class="admin-user-delete__form__labelled-block">
            <label for="username" class="admin-user-delete__form__label">Username</label>
            <input type="text" id="username" name="username" value="{{ username }}" class="styles-resetter admin-user-delete__form__input" required/>
        </div>
        <div class="admin-user-delete__form__labelled-block">
            <label for="firstname" class="admin-user-delete__form__label">First Name</label>
            <input type="text" id="firstname" name="firstname" value="{{ firstname }}" class="styles-resetter admin-user-delete__form__input" required/>
        </div>
        <div class="admin-user-delete__form__labelled-block">
            <label for="lastname" class="admin-user-delete__form__label">Last Name</label>
            <input type="text" id="lastname" name="lastname" value="{{ lastname }}" class="styles-resetter admin-user-delete__form__input" required/>
        </div>
        <div class="admin-user-delete__form__labelled-block">
            <label for="role" class="admin-user-delete__form__label">User's Persona</label>
            <div class="admin-user-delete__form__input-radio">
                {% if (role) %}
                <input type="radio" id="role" name="role" value="0" class="margin-divider" required/>user
                <input type="radio" id="role" name="role" value="1" class="margin-divider" required checked/>admin
                {% else %}
                <input type="radio" id="role" name="role" value="0" class="margin-divider" required checked/>user
                <input type="radio" id="role" name="role" value="1" class="margin-divider" required/>admin
                {% endif %}
            </div>
        </div>
        <div class="admin-user-delete__form__btn__btn-block">
            <button type="submit" class="styles-resetter admin-user-delete__form__btn__btn">Delete</button>
        </div>
    </form>

{% endblock %}