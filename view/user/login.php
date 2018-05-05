<?
if (isset($_SESSION['email'])){
    redirect('/index');
    exit;
}
?>



    <form action="<?=baseUrl()?>/user/xn_login" method="post">

        <div class="row">
            <div class="col-md-6">
                <input type="email" class="p-1" name="email" placeholder="username" required><br><br>
            </div>
            <div class="col-md-6">
                <input type="password" class="p-1" name="password" placeholder="password" required><br><br>
            </div>
        </div>
<div class="g-recaptcha" data-sitekey="6LeLxh0UAAAAANA4hNLwlvZlXrcYdxr0oohvwpaY"></div>
<br>
        <input type="submit" class="yellow_bg" value="login">
    </form>

