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
                {% if (filepath) %}
                <img src="/{{ filepath }}" alt="avatar" class="profile-card__user-icon-large"/>
                {% else %}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="profile-card__user-icon-large">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {% endif %}
                <div class="profile-card__user-info">
                    <div class="profile-card__info-item">
                        <span>| Username: </span><h3>{{ username }}</h3>
                    </div>
                    <div class="profile-card__info-item">
                        <span>| First Name: </span><h3>{{ firstname }}</h3>
                    </div>
                    <div class="profile-card__info-item">
                        <span>| Last Name: </span><h3>{{ lastname }}</h3>
                    </div>
                    <div class="profile-card__info-item">
                        <span>| E-Mail: </span><h3>{{ email }}</h3>
                    </div>

                    <article class="profile-card__links-block">
                        <a href="/posts" class="profile-card__link margin-divider">Back</a>
                        <a href="/profile/update" class="profile-card__link margin-divider">Edit</a>
                        <a href="/profile/delete" class="profile-card__link margin-divider">Delete</a>
                    </article>
                </div>
            </div>
            
        </article>

    </main>
    
</div>
    
{% endif %}

{% endblock %}