{% extends "template.html" %}

{% block css %}

<link href="/views/auth/css/auth-main.css" rel="stylesheet"/>

{% endblock %}

{% block body %}

<main class="auth-container">

    <h2 class="auth-title">Trigger Password Reset</h2>

    <form name="password-reset-form" method="POST" class="password-reset-form">
        <div class="password-reset-form__labelled-block">
            <label for="password-request-email" class="password-reset-form__label">Email</label>
            <input type="email" id="password-request-email" name="password-request-email" class="styles-resetter password-reset-form__input" required/>
        </div>
        <div class="password-reset-form__btn-block">
            <button type="submit" class="styles-resetter password-reset-form__btn">Request</button>
        </div>
        <div class="login-form__links-block">
            <a href="/login" class="register__link margin-divider">Back to Authorization</a>
        </div>
    </form>
    
    <h4 class="notification-success margin-top-divider">{{ success }}</h4>
    
    <h4 class="notification-fail margin-top-divider">{{ error }}</h4>

</main>

{% endblock %}