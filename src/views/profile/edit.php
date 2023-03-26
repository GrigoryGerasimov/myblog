{% extends "template.html" %}

{% block css %}

<link href="/views/profile/css/profile-main.css" rel="stylesheet"/>

{% endblock %}


{% block body %}
    
{% if (isAuth) %}

<div class="profile-container">

{% use "profile/profile-template_header.html" %}

   {% block header %}
       {{ parent() }}
   {% endblock %}

    <main class="profile-card__large-wrapper">

        <article class="profile-card__large">
            <div>
                <h5 class="profile-card__card-id">My Account</h5>
                <hr class="divider-minor"/>
            </div>
            
            <div class="profile-card__info-block">
                <div class="profile-card__user-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                
                <form action="/profile/update" name="editProfile" method="POST" class="profile-card__user-info">
                    <div class="profile-card__info-item">
                        <label for="firstname">| First Name: </label>
                        <input id="firstname" name="firstname" value="{{ firstname }}" placeholder="First Name" class="styles-resetter profile-card__edit-input" required/>
                    </div>
                    <div class="profile-card__info-item">
                        <label for="lastname">| Last Name: </label>
                        <input id="lastname" name="lastname" value="{{ lastname }}" placeholder="Last Name" class="styles-resetter profile-card__edit-input" required/>
                    </div>
                    <div class="profile-card__info-item">
                        <label>| E-Mail: </label>
                        <input id="email" name="email" value="{{ email }}" placeholder="E-Mail" class="styles-resetter styles-resetter profile-card__edit-input" required/>
                    </div>

                    <article class="profile-card__links-block">
                        <a href="/profile" class="profile-card__link margin-divider">Back</a>
                        <button type="submit" class="styles-resetter profile-card__edit-btn margin-divider">Update</button>
                    </article>
                </form>
            </div>
            
            <h4 class="notification-success">{{ notification }}</h4>
            
        </article>
    </main>
    
</div>
    
{% endif %}

{% endblock %}
