const regUser = () => {
    const regSubmitBtn = document.querySelector('#reg-submit')
    if (regSubmitBtn) {
        const userName = document.querySelector('#user_name')
        const emailAddress = document.querySelector('#user_login')
        const password = document.querySelector('#user_pass')
        const nonce = document.querySelector('#hello_nonce')

        const regPageWarning = document.querySelector('.auth-page__warning')

        regSubmitBtn.addEventListener('click', (e) => {
            e.preventDefault();

            jQuery(document).ready( function($){
                $.ajax({
                    type: 'POST',
                    url: '/wp-admin/admin-ajax.php',
                    data: {
                        action: 'hello_register',
                        email_reg: emailAddress.value,
                        password: password.value,
                        user_name: userName.value,
                        nonce: nonce.value
                    },
                    success: function(data){
                        console.dir(data);
                        let data_fin = JSON.parse(data)
                        if (data_fin.class == 'errors') {
                            regPageWarning.innerHTML = ''
                            for (var key in data_fin) {
                                if (key !== 'class') {
                                    console.log(key + ': ' + data_fin[key]);
                                    regPageWarning.insertAdjacentHTML('beforeend', `
                                      <div class="notification error">
                                        <p>${data_fin[key]}</p>
                                        <a class="close" href="#"></a>
                                      </div>`)
                                }
                            }
                        } else {
                          window.location.href = '/auth'
                        }
                    },
                    error: () => {
                        console.log('Ошибка отправки.');
                    }
                });
            });

        })

    }
}
regUser()
