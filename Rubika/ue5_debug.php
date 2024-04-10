<?php include 'Inc/header.php' ?>

<h1>Debug</h1>

<form action="ue5_register.php" method="post">
    <div class="form-group" style="margin-top:40px">
        <label for="username">Username*</label>
        <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
        
        <label for="password">Password*</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
        
        <label for="password2">Password verif*</label>
        <input type="password" name="password2" class="form-control" id="password2" placeholder="Password verif" required>

    </div>
    <button type="submit" class="btn btn-primary">ue5_register.php</button>
</form>


<form action="ue5_login.php" method="post">
    <div class="form-group" style="margin-top:40px">
        <label for="username">Username*</label>
        <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
        
        <label for="password">Password*</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary">ue5_login.php</button>
</form>

<form action="ue5_login.php" method="post">
    <div class="form-group" style="margin-top:40px">
        <label for="Token">Token*</label>
        <input type="text" name="Token" class="form-control" id="Token" placeholder="Token" required>
    </div>
    <button type="submit" class="btn btn-primary">ue5_login.php</button>
</form>


<form action="ue5_playerdata.php" method="post">
    <div class="form-group" style="margin-top:40px">
        <label for="Token">Token*</label>
        <input type="text" name="Token" class="form-control" id="Token" placeholder="Token" required>
    </div>
    <button type="submit" class="btn btn-primary">ue5_playerdata.php</button>
</form>

<include href="Inc/footer.php" />