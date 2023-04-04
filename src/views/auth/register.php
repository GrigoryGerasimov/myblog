{% extends "template.html" %}

{% block css %}

<link href="/views/auth/css/auth-main.css" rel="stylesheet"/>

{% endblock %}

{% block body %}

<main class="auth-container">

{% if (isRegistered) %}

    <h4>You are already registered under the given credentials</h4>
    
    <div class="register__links-block">
        <a href="/login" class="register__link margin-divider">Back</a>
    </div>
    
{% elseif (isAuth) %}

    <h4 class="height-divider">You are already registered in the system and currently logged in</h4>
    <h4 class="height-divider">To register under new credentials please first sign out</h4>
    
    <div class="register__links-block">
        <a href="/posts" class="register__link margin-divider">Back</a>
        <a href="/auth/logout" class="register__link margin-divider">Sign Out</a>
    </div>

{% else %}

    <h2 class="auth-title">Registration</h2>

    <form name="register-form" method="POST" class="register-form">
        <div class="register-form__labelled-block">
            <label for="email" class="register-form__label">E-Mail</label>
            <input type="email" id="email" name="email" class="styles-resetter register-form__input" required/>
        </div>
        <div class="register-form__labelled-block">
            <label for="password" class="register-form__label">Password</label>
            <input type="password" id="password" name="password" class="styles-resetter register-form__input" required/>
        </div>
        <div class="register-form__labelled-block">
            <label for="username" class="register-form__label">Username</label>
            <input type="text" id="username" name="username" class="styles-resetter register-form__input" required/>
        </div>
        <div class="register-form__labelled-block">
            <label for="firstname" class="register-form__label">First Name</label>
            <input type="text" id="firstname" name="firstname" class="styles-resetter register-form__input" required/>
        </div>
        <div class="register-form__labelled-block">
            <label for="lastname" class="register-form__label">Last Name</label>
            <input type="text" id="lastname" name="lastname" class="styles-resetter register-form__input" required/>
        </div>
        <div class="register-form__labelled-block">
            <input type="hidden" id="defaultrole" name="role" class="styles-resetter register-form__input" value="0" required/>
        </div>
        <div class="register-form__btn-block">
            <button type="submit" class="styles-resetter register-form__btn">Sign Up</button>
        </div>
        <div class="register-form__links-block">
            <p>
               <a href="/login" class="login__link margin-divider">Already have an account?</a>
            </p>
        </div>
    </form>
    
    <h4 class="notification-fail">{{ notification }}</h4>
    
{% endif %}

</main>

{% endblock %}