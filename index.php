<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App Mail Send | Moderno</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f4f6f9;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .card-header-custom {
            background: linear-gradient(135deg, #0d6efd 0%, #0043a8 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .btn-send {
            transition: all 0.3s;
        }
        /* Loader escondido por padrão */
        #loader {
            display: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div class="card card-custom">
                    <div class="card-header-custom">
                        <i class="bi bi-send-check-fill" style="font-size: 3rem;"></i>
                        <h2 class="mt-2">Send Mail</h2>
                        <p class="mb-0 op-8">Seu app de envio particular</p>
                    </div>

                    <div class="card-body p-4">
                        <form id="formEmail">
                            
                            <div class="mb-3">
                                <label for="para" class="form-label fw-bold">Para:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input name="para" type="email" class="form-control" id="para" placeholder="email@destino.com.br" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="assunto" class="form-label fw-bold">Assunto:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                    <input name="assunto" type="text" class="form-control" id="assunto" placeholder="Ex: Orçamento" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="mensagem" class="form-label fw-bold">Mensagem:</label>
                                <textarea name="mensagem" class="form-control" id="mensagem" rows="4" required></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg btn-send" id="btnEnviar">
                                    <span id="btnText">Enviar Mensagem <i class="bi bi-rocket-takeoff ms-2"></i></span>
                                    
                                    <span id="loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-3 text-muted">
                    <small>&copy; <?php echo date('Y'); ?> App Mail Send</small>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        document.getElementById('formEmail').addEventListener('submit', function(e) {
            e.preventDefault(); // Impede o recarregamento da página

            // Elementos visuais
            const btn = document.getElementById('btnEnviar');
            const btnText = document.getElementById('btnText');
            const loader = document.getElementById('loader');

            // Feedback visual de carregamento
            btn.disabled = true;
            btnText.style.display = 'none';
            loader.style.display = 'inline-block';

            // Coletar dados do formulário
            const formData = new FormData(this);

            // Enviar via AJAX (Fetch API)
            fetch('processa_envio.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Espera um JSON do PHP
            .then(data => {
                if(data.status === 'success') {
                    // Alerta de Sucesso
                    Swal.fire({
                        icon: 'success',
                        title: 'Enviado!',
                        text: data.message,
                        confirmButtonColor: '#0d6efd'
                    });
                    // Limpar formulário
                    document.getElementById('formEmail').reset();
                } else {
                    // Alerta de Erro
                    Swal.fire({
                        icon: 'error',
                        title: 'Ops...',
                        text: data.message,
                    });
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Erro de conexão',
                    text: 'Não foi possível conectar ao servidor.',
                });
            })
            .finally(() => {
                // Restaurar botão
                btn.disabled = false;
                btnText.style.display = 'inline';
                loader.style.display = 'none';
            });
        });
    </script>
</body>
</html>