async function validarLogin() {


    let usuario = jv.byIDValue('usuario');
    let senha = jv.byIDValue('senha');

    if (usuario == '' || senha == '') {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Preencha todos os campos!',
        });
        return;
    }

    let data = {
        usuario: usuario,
        senha: senha
    };

    try {
        let timerInterval;
        Swal.fire({
            title: 'Validando informações...',
            html: 'Por favor, aguarde.',
            timer: 2000,
            timerProgressBar: true,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector('b');
                timerInterval = setInterval(() => {
                    if (timer) {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        });
        
        let result = await jv.ajax('POST', data, 'login');
        if (result.status > 205) {
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: result.retorno || 'Usuário ou senha incorretos.',
            });
            return;
        }
        Swal.fire({
            title: 'Login realizado com sucesso!',
            html: 'Redirecionando em <b></b> milissegundos.',
            timer: 2000,
            timerProgressBar: true,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
                const timer = Swal.getPopup().querySelector('b');
                timerInterval = setInterval(() => {
                    if (timer) {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        }).then(() => {
            window.location.href = `${BASE}solicitacoes`; 
        });
    } catch (error) {
        Swal.close();
        Swal.fire({
            icon: 'error',
            title: 'Erro na requisição',
            text: error
        });
    }
}
