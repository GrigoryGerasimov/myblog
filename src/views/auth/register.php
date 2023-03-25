{% extends "auth/template.html" %}

{% block body %}

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

    <form name="register-form" method="POST" class="register-form">
        <div class="register-form__labelled-block">
            <label for="email" class="register-form__label">E-Mail</label>
            <input type="email" id="email" name="email" class="styles-resetter register-form__input" required/>
        </div>
        <div class="register-form__labelled-block">
            <label for="password" class="register-form__label">Password</label>
            <input type="password" id="password" name="password" class="styles-resetter register-form__input" required/>
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
    
{% endif %}

{% endblock %}