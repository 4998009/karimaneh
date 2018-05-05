<?
if (isAdmin())
    
?>

<form action="/<?= baseUrl() ?>/user/store" method="post">
    <input type="email" name="email" placeholder="email" required><br>
    <input type="password" name="password1" placeholder="password" required><br>
    <input type="password" name="password2" placeholder="confirm password" required><br>
    <br>
    <input type="submit" value="Register">


</form>


