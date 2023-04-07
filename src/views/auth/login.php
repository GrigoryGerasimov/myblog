{% extends "template.html" %}

{% block css %}

<link href="/views/auth/css/auth-main.css" rel="stylesheet"/>

{% endblock %}

{% block body %}

<main class="auth-container">

{% if (isAuth) %}

    <h4>You are already successfully logged in</h4>
    
    <div class="login__links-block margin-top-divider">
        <a href="/posts" class="login__link margin-divider">Back</a>
        <a href="/auth/logout" class="login__link margin-divider">Sign Out</a>
    </div>

{% else %}

    <h2 class="auth-title">Authorization</h2>

    <form action="/auth/login" name="login-form" method="POST" class="login-form">
        <div class="login-form__labelled-block">
            <label for="email" class="login-form__label">E-Mail</label>
            <input type="email" id="email" name="email" class="styles-resetter login-form__input" required/>
        </div>
        <div class="login-form__labelled-block">
            <label for="password" class="login-form__label">Password</label>
            <input type="password" id="password" name="password" class="styles-resetter login-form__input" required/>
        </div>
        <div class="login-form__labelled-checkbox-block">
            <label for="rememberme" class="login-form__label">Remember Me</label>
            <input type="checkbox" id="rememberme" name="rememberme" class="styles-resetter margin-divider login-form__checkbox"/>
        </div>
        <div class="login-form__btn-block">
            <button type="submit" class="styles-resetter login-form__btn">Sign In</button>
        </div>
        <div class="login-form__links-block">
            <a href="/register" class="register__link margin-divider">Don't have an account yet?</a>
            <a href="/auth/password" class="register__link margin-divider">I already have an account, but I forgot my password</a>            
        </div>
    </form>
    
    <h4 class="notification-success margin-top-divider">{{ success }}</h4>
    
    <h4 class="notification-fail margin-top-divider">{{ error }}</h4>

{% endif %}

</main>

{% endblock %}