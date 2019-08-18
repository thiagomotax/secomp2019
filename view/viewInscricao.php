<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/css/custom.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome/css/font-awesome.min.css">
    <title>VI Secomp - Login</title>
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="sign-box">
            <form id="sign-form" class="sign-form" method="POST">
                <input type="hidden" name="acao" value="adicionar">
                <div class="row text-center">
                    <img class="logo-form" src="../assets/images/secomp-transparente.png">
                </div>
                <div class="form-group">
                    <label class="control-label">NOME</label>
                    <input class="form-control" type="text" name="nome" placeholder="Nome" autofocus autocomplete="off"
                        required>
                </div>
                <div class="form-group">
                    <label class="control-label">CPF</label>
                    <input class="form-control" type="text" name="cpf" id="cpf" placeholder="CPF" autofocus
                        autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label class="control-label">EMAIL</label>
                    <input class="form-control" type="email" name="email" placeholder="Email" autofocus
                        autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label class="control-label">SENHA</label>
                    <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha" required>
                </div>
                <div class="form-group">
                    <label class="control-label">CONFIRMAR SENHA</label>
                    <input class="form-control" type="password" name="confirmasenha" id="confirmasenha"
                        placeholder="Confirmar senha" required>
                </div>
                <div class="form-group btn-container text-center">
                    <button type="input" id="btnInscricao" class="btn btn-primary"><i
                            class="fa fa-sign-in fa-lg fa-fw"></i>CADASTRAR</button>
                </div>
                <div class="form-group mt-20">
                    <p class="semibold-text mb-0"><a href="viewLogin.php"><i class="fa fa-angle-left fa-fw"></i> Voltar
                            para o login</a></p>
                </div>
            </form>
        </div>
    </section>
    <style>
    label.error {
        color: red;
        background-color: #f2dede;
        border-color: #ebccd1;
        padding: 1px 20px 1px 20px;
    }
    </style>
    <style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(255, 255, 255, .8) url('../assets/images/loading.gif') 50% 50% no-repeat;
    }

    /* enquanto estiver carregando, o scroll da página estará desativado */
    body.loading {
        overflow: hidden;
    }

    /* a partir do momento em que o body estiver com a classe loading,  o modal aparecerá */
    body.loading .modal {
        display: block;
    }
    </style>
    <div class="modal"></div>
</body>
<script src="../assets/js/jquery-2.1.4.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/plugins/pace.min.js"></script>
<script src="../assets/js/main.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js">
</script>
<script type="text/javascript" src="../assets/js/plugins/bootstrap-notify.min.js"></script>
<script type="text/javascript" src="../assets/js/plugins/sweetalert.min.js"></script>
<script type="text/javascript" src="../assets/js/jquery.mask.min.js"></script>
<script src="../assets/js/custom/inscricoes.js"></script>
<script>
$(document).ready(function() {
    $('#cpf').mask('000.000.000-00');
});
</script>

</html>