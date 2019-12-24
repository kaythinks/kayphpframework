{{ include('layouts/header.php') }}

<img src="/public/kayphplogo.png" width="200px;">
<section id="cover" style="padding-top: 20px;">
<div id="cover-caption">
    <div id="container" class="container">
        <div class="row text-white">
            <div class="col-sm-6 offset-sm-3 text-center">
                {% if error  %}
                    <p>{{ error }}</p>
                {% endif %}
                <h3>Enter Your Details !</h3>
                <div class="info-form">
                    <form class="form-inlin justify-content-center" action="/login" method="post">
                        <div class="form-group">
                            <label class="sr-only">Name</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                            <input type="hidden" name="csrf_token" value="{{ csrf_token }}"> 
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Email</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                        </div>
                        <button type="submit" class="btn btn-success ">okay, go!</button>
                        {% if error  %}
                            <a class="btn btn-danger" href="/forgotpassword">Forgot Password ?</a>
                        {% endif %}
                    </form>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
</section>

{{ include('layouts/footer.php') }}
</body>
</html>

