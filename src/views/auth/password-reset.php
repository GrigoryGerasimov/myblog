{% extends "template.html" %}

{% block css %}

<link href="/views/auth/css/auth-main.css" rel="stylesheet"/>

{% endblock %}

{% block body %}

<main class="auth-container">

    <h2 class="auth-title">Password Reset</h2>

    <form name="password-reset-form" method="POST" class="password-reset-form">
        <div class="password-reset-form__labelled-block">
            <label for="new-password" class="password-reset-form__label">New Password</label>
            <input type="password" id="new-password" name="new-password" class="styles-resetter password-reset-form__input" required/>
        </div>
        <div class="password-reset-form__labelled-block">
            <label for="confirm-new-password" class="password-reset-form__label">Repeat New Password</label>
            <input type="password" id="confirm-new-password" name="confirm-new-password" class="styles-resetter password-reset-form__input" required/>
        </div>
        <div class="password-reset-form__btn-block">
            <button type="submit" class="styles-resetter password-reset-form__btn">Submit</button>
        </div>
        <div class="login-form__links-block">
            <a href="/login" class="register__link margin-divider">Back to Authorization</a>
        </div>
    </form>
    
    <h4 class="notification-success margin-top-divider">{{ success }}</h4>
    
    <h4 class="notification-fail margin-top-divider">{{ error }}</h4>

</main>

{% endblock %}