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
                <h3>Update Your Details !</h3>
                <div class="info-form">
                    <form class="form-inlin justify-content-center" method="post" action="/updateprofile" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="sr-only">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Enter Username" value="{{ data['username']}}">
                            <input type="hidden" name="csrf_token" value="{{ csrf_token }}"> 
                            <input type="hidden" name="id" value="{{ data['id'] }}"> 
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ data['email'] }}">
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Picture</label>
                            <input type="file" class="form-control" name="picture" placeholder="Enter Picture">
                        </div>
                        <button type="submit" class="btn btn-success ">okay, go!</button>
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

