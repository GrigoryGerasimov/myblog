{% extends "auth/template.html" %}

{% block body %}

{% if (isAuth) %}

    <h4>You are already successfully logged in</h4>
    
    <div class="login__links-block">
        <a href="/posts" class="login__link margin-divider">Back</a>
        <a href="/auth/logout" class="login__link margin-divider">Sign Out</a>
    </div>

{% else %}

    <form action="/auth/login" name="login-form" method="POST" class="login-form">
        <div class="login-form__labelled-block">
            <label for="email" class="login-form__label">E-Mail</label>
            <input type="email" id="email" name="email" class="styles-resetter login-form__input" required/>
        </div>
        <div class="login-form__labelled-block">
            <label for="password" class="login-form__label">Password</label>
            <input type="password" id="password" name="password" class="styles-resetter login-form__input" required/>
        </div>
        <div class="login-form__btn-block">
            <button type="submit" class="styles-resetter login-form__btn">Sign In</button>
        </div>
        <div class="login-form__links-block">
            <p>
               <a href="/register" class="register__link margin-divider">Don't have an account yet?</a>
            </p>
        </div>
    </form>
    
    <h4 class="notification-fail">{{ notification }}</h4>

{% endif %}

{% endblock %}