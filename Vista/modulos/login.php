<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-form mt-5">
                <form method="post" class="mx-auto">
                    <div class="form-group mt-1">
                        <label>Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group mt-1">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <!--      <div class="checkbox mt-1">
                            <label>
                                <input type="checkbox">Recordar
                            </label>
                        </div> -->
                    <button type="submit" class="btn btn-primary mt-3">Ingresar</button>

                </form>
                <?php
                $login = new ControladorAdministrador();
                $login->login();
                ?>


            </div>
        </div>
    </div>
</div>