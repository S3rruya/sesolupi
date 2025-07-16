<?php include_once('includes/header.php'); ?>
<link rel="stylesheet" href="<?php echo URL_UPLOAD;?>assets/css/pages/auth.css">
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="<?php echo URL_UPLOAD;?>assets/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Lembrar minha senha</h1>
                    <p class="auth-subtitle mb-5">Digite seu email abaixo para receber uma nova senha, a senha atual será modificada.</p>

                    <form action="validar">
                    	<input type="hidden" name="acao" value="lembrarsenha">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Enviar</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Lembrou de sua senha ? <a href="index.php" class="font-bold">Acessar</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
<?php include_once('includes/footer.php'); ?>