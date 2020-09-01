<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Zurri Booking | Documentation</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/bootstrap.css">
        <link rel="stylesheet" href="/assets/css/default.css">
        <link rel="stylesheet" href="/assets/css/styles.css">

        <!-- Styles -->
        <style>
            
        </style>
    </head>
    <body>
        <main>
            <nav class="custom-nav text-center">
                <div class="container">
                    <a class="brand" href="/">Zurri Booking API Documentation</a>
                </div>
            </nav>

            <section class="content">
                <div class="row">
                    <div class="col-md-8">
                        <h1>Introduction</h1>
                        <p>In this documentation, you will find guidance on how to use the zurri booking api.</p>
                        <div class="api-section">
                            <h3>Authentication</h3>
                        <p >The api is protected for every request made with a token that is provided when a user registers and logs in. The token is then immediately revoked when the user logs out.</p>
                        <p>This api token has to be provided for every request made to the application, the only exceptions being the <code>/register</code>,  <code>/login</code> and <code>/</code> endpoints.</p>
                        <p>The api token is passed as a <code>Bearer Token</code> in the headers. Details on how to can be read <a href="https://stackoverflow.com/questions/40988238/sending-the-bearer-token-with-axios" class="link">here ( the first answer)</a></p>
                        <h4>1. Registration</h4>

<pre>
<code>
    url: https://zurri-booking.herokuapp.com/api/auth/register
    method: POST
    form params: "name", "email" and "password"
</code>
</pre>
<p>Response</p>
<pre>
    <code>
    {
        "sucess": true,
        "data": {
            "user": {
                "name": "users name",
                "email": "users email"
            },
            "message": "success message",
            "token": "api-token"
        }
    }
</code>
</pre>
<p>So the api token will be picked from there to be used in the subsequent requests.</p>
<h4>2. Login</h4>
<pre>
<code>
    url: https://zurri-booking.herokuapp.com/api/auth/login
    method: POST
    form params: "email" and "password"
</code>
</pre>
<p>It has the same response as the register endpoint</p>
                        </div>
                        <hr>
                        <div class="api-section">
                            <h3>Hotels API</h3>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.3/highlight.min.js" integrity="sha512-tHQeqtcNWlZtEh8As/4MmZ5qpy0wj04svWFK7MIzLmUVIzaHXS8eod9OmHxyBL1UET5Rchvw7Ih4ZDv5JojZww==" crossorigin="anonymous"></script>
    <script>hljs.initHighlightingOnLoad();</script>
</html>
