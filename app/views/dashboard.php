{{ include('layouts/header.php') }}

<div class="container">
<div class="row">
 <div class="col-sm-4">
    <aside>
    <img src="{{ data['picture'] }}" alt="pix" width="200px;">
    </aside> 
 </div>
<div class="col-sm-8">
    <section style="margin: 25px;">
    <h3> A light weight PHP Framework that get's the Job done.</h3>
    <p> Lightweight | Ease of Use | Flexible Coding </p>
    
        <h2> MY DASHBOARD </h5>
            <div class="row">
                <div class="col-sm-5">
                    <p> ID </p>
                    <p> EMAIL </p>
                    <P> USERNAME </P>
                    <p> PASSWORD </p>
                    <p> CREATED AT</p>
                </div>
                <div class="col-sm-5">
                    <p> {{ data['id'] }} </p>
                    <p> {{ data['email'] }}  </p>
                    <p> {{ data['username'] }} </p>
                    <p> {{ data['password'] }}  </p>
                    <p> {{ data['created_at']| date('Y-m-d')}}  </p>
                </div>
            </div>
            <a class="btn btn-success" href="/updateprofile/{{ data['id'] }}">Update</a> <a class="btn btn-danger" onclick="getDelete(event)" href="/deleteprofile">Delete </a>
            <div style="margin-bottom: 50px;"></div>







            <p> - Gives you coding freedom -- code as you like !. </p>
        <span> A minimalistic framework , for real PHP developers, by real PHP developers. </span><br>
    <span>Creator,</span><br>
    <span>Kay Odole</span><br>
    <a href="https://github.com/kaythinks"><small>@github --kaythinks</small></a>
</section>

</div>
</div>    
</div>   

{{ include('layouts/footer.php') }}
<script>
    const getDelete = (event) => {
        event.preventDefault();

        let answer = window.confirm('Do you want to delete your account ?');

        if(answer) window.location = event.srcElement.href;
    }
</script>
</body>
</html>

