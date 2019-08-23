$(document).ready(function() {
    $('#btnAlterarSenha').click(function() {
        var dados = $('#resetpswd-form').serializeArray();
        if ((dados[2].value == "") || (dados[3].value == "") || (dados[4].value == "")) {
            $.notify({
                title: "",
                message: "Preencha todos os campos ",
                icon: 'fa fa-check'
            }, {
                type: "danger",
                placement: {
                    from: "top",
                    align: "right",
                },
                offset: 20,
                spacing: 10,
                z_index: 2000,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                }
            });
        } else {
            var senhaAtual = dados[2].value;
            var novaSenha = dados[3].value;
            var confirmaSenha = dados[4].value;
            if (novaSenha != confirmaSenha) {
                $.notify({
                    title: "",
                    message: "Senhas não correspondem! ",
                    icon: 'fa fa-check'
                }, {
                    type: "danger",
                    placement: {
                        from: "top",
                        align: "right",
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 2000,
                    delay: 5000,
                    timer: 1000,
                    url_target: '_blank',
                    mouse_over: null,
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                    }
                });
            } else {
                $body = $("body");
                $body.addClass("loading");
                $.ajax({
                    type: "POST",
                    url: "../controller/UsuariosController.php",
                    data: dados,
                    success: function(result) {
                        if (result == 1) {
                            $body.removeClass("loading");
                            $('#alterarSenha').modal('hide');
                            $('#resetpswd-form')[0].reset();
                            $.notify({
                                title: "",
                                message: "Senha alterada com sucesso! ",
                                icon: 'fa fa-check'
                            }, {
                                type: "success",
                                placement: {
                                    from: "top",
                                    align: "right",
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 2000,
                                delay: 5000,
                                timer: 1000,
                                url_target: '_blank',
                                mouse_over: null,
                                animate: {
                                    enter: 'animated fadeInDown',
                                    exit: 'animated fadeOutUp'
                                }
                            });
                        } else if (result == 2) {
                            $body.removeClass("loading");
                            $('#alterarSenha').modal('hide');
                            $('#resetpswd-form')[0].reset();
                            $.notify({
                                title: "",
                                message: "Erro ao alterar a senha! Tente novamente.",
                                icon: 'fa fa-check'
                            }, {
                                type: "danger",
                                placement: {
                                    from: "top",
                                    align: "right",
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 2000,
                                delay: 5000,
                                timer: 1000,
                                url_target: '_blank',
                                mouse_over: null,
                                animate: {
                                    enter: 'animated fadeInDown',
                                    exit: 'animated fadeOutUp'
                                }
                            });
                        } else if (result == 3) {
                            $body.removeClass("loading");
                            $.notify({
                                title: "",
                                message: "Senha atual não confere!",
                                icon: 'fa fa-check'
                            }, {
                                type: "danger",
                                placement: {
                                    from: "top",
                                    align: "right",
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 2000,
                                delay: 5000,
                                timer: 1000,
                                url_target: '_blank',
                                mouse_over: null,
                                animate: {
                                    enter: 'animated fadeInDown',
                                    exit: 'animated fadeOutUp'
                                }
                            });
                        }
                    }
                });
            }
        }
        return false;
    });
});
$(document).ready(function() {
    $('#btnEditarPerfil').click(function() {
        var dados = $('#perfil-form').serializeArray();
        if ((dados[2].value == "") || (dados[4].value == "")) {
            $.notify({
                title: "",
                message: "Preencha todos os campos ",
                icon: 'fa fa-check'
            }, {
                type: "danger",
                placement: {
                    from: "top",
                    align: "right",
                },
                offset: 20,
                spacing: 10,
                z_index: 2000,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                }
            });
        } else {
            $body = $("body");
            $body.addClass("loading");
            $.ajax({
                type: "POST",
                url: "../controller/UsuariosController.php",
                data: dados,
                success: function(result) {
                    if (result == 1) {
                        $body.removeClass("loading");
                        $.notify({
                            title: "",
                            message: "Perfil alterado com sucesso!",
                            icon: 'fa fa-check'
                        }, {
                            type: "success",
                            placement: {
                                from: "top",
                                align: "right",
                            },
                            offset: 20,
                            spacing: 10,
                            z_index: 2000,
                            delay: 5000,
                            timer: 1000,
                            url_target: '_blank',
                            mouse_over: null,
                            animate: {
                                enter: 'animated fadeInDown',
                                exit: 'animated fadeOutUp'
                            }
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else if (result == 2) {
                        $body.removeClass("loading");
                        $.notify({
                            title: "",
                            message: "Erro ao alterar o perfil!",
                            icon: 'fa fa-check'
                        }, {
                            type: "danger",
                            placement: {
                                from: "top",
                                align: "right",
                            },
                            offset: 20,
                            spacing: 10,
                            z_index: 2000,
                            delay: 5000,
                            timer: 1000,
                            url_target: '_blank',
                            mouse_over: null,
                            animate: {
                                enter: 'animated fadeInDown',
                                exit: 'animated fadeOutUp'
                            }
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        }
        return false;
    });
});