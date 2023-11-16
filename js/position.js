const generateDescriptionPosition = () => {
    const generatePositionBtn = document.querySelector('#generate-position')
    if ( generatePositionBtn ) {
        const addPosition = document.querySelector('.add-position')
        const addPositionInputs = document.querySelectorAll('.add-position input')
        const form = document.querySelector('form#hello-form')
        const loader = document.querySelector('#js-loader')
        const positionText = document.querySelector('#position_text')

        generatePositionBtn.addEventListener('click', (e) => {
            loader.classList.remove("no-active")
            let formData = new FormData(form);
            addPositionInputs.forEach((input) => {
                formData.append(input.name, input.value);
            });
            formData.append('action', 'position_generated');

            jQuery(document).ready( function($){
                $.ajax({
                    url: "/wp-admin/admin-ajax.php",
                    method: 'post',
                    processData: false,
                    contentType: false,
                    data: formData,
                    beforeSend: function () {
                        // Outputting text while sending
                    },
                    success: function (data) {
                        positionText.innerHTML = ''
                        positionText.insertAdjacentText('afterBegin', data)
                        loader.classList.add("no-active")
                    },
                    error: () => {
                      console.log('Ошибка отправки.');
                      loader.classList.add("no-active")
                      positionText.innerHTML = ''
                      positionText.insertAdjacentHTML('beforeend', 'ERROR')
                    }
                });
            });
        })

    }
}
generateDescriptionPosition()

const copyPosition = () => {
    const writeBtn = document.querySelector('#copy-position')
    if ( writeBtn ) {
        writeBtn.addEventListener('click', (e) => {
            const inputEl = document.querySelector('textarea.to-copy')
            var text = inputEl.value
            navigator.clipboard.writeText(text)
            .then(() => {
                console.log('Text copied to clipboard');
            })
            .catch(err => {
                console.error('Error in copying text: ', err);
            });
        })
    }
}
copyPosition()

function copyTextIn(btn, textToCopy, typeText, warningText, cuccessText) {
    const writeBtn = document.querySelector(btn)
    if ( writeBtn ) {
        writeBtn.addEventListener('click', (e) => {
            console.dir(writeBtn);
            var text = '';
            if (typeText) {
                const inputEl = document.querySelector(textToCopy)
                text = inputEl.value
            } else {
                text = writeBtn.dataset.url
            }

            navigator.clipboard.writeText(text)
            .then(() => {
                // console.log(cuccessText);
                writeBtn.nextElementSibling.innerHTML = `<p class="color-green">${cuccessText}</p>`;
                setTimeout(() => {
                    writeBtn.nextElementSibling.innerHTML = '';
                }, 3000);
            })
            .catch(err => {
                // console.error(warningText, err);
                writeBtn.nextElementSibling.innerHTML = `<p class="color-red">${warningText}</p>`;
                setTimeout(() => {
                    writeBtn.nextElementSibling.innerHTML = '';
                }, 3000);
            });
        })
    }
}
copyTextIn('#copy-btn', 'TEST', false, 'An error occurred, please try later', 'Link copied to clipboard');

const submitPosition = () => {
    const addPositionBtn = document.querySelector('#add-position-submit')
    if ( addPositionBtn ) {
        const name = document.querySelector('input#name')
        name.addEventListener('input', (e) => {
            name.style.border = ''
        })
        addPositionBtn.addEventListener('click', (e) => {
            if ( name.value ) {
                const addPositionInputs = document.querySelectorAll('.add-position input')
                const form = document.querySelector('form#hello-form')
                const positionText = document.querySelector('#position_text')

                let formData = new FormData(form);
                addPositionInputs.forEach((input) => {
                    formData.append(input.name, input.value);
                });
                formData.append('action', 'add_positions');
                formData.append('open_position', positionText.value);

                jQuery(document).ready( function($){
                    $.ajax({
                        url: "/wp-admin/admin-ajax.php",
                        method: 'post',
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(data){
                            // console.dir(data);
                            var data_json = JSON.parse(data);
                            if (data_json.success == 'Success') {
                                window.location.href = data_json.post_url;
                            } else {
                                console.log('Ошибка отправки.');
                            }
                        },
                        error: () => {
                          console.log('Ошибка отправки.');
                        }
                    })
                });
            } else {
                name.style.border = '1px solid red'
            }
        })
    }
}
submitPosition()

const updatePosition = () => {
    const updatePositionBtn = document.querySelector('#update-position-submit')
    if ( updatePositionBtn ) {
        const name = document.querySelector('input#name')
        name.addEventListener('input', (e) => {
            name.style.border = ''
        })
        updatePositionBtn.addEventListener('click', (e) => {
            if ( name.value ) {
                const addPositionInputs = document.querySelectorAll('.add-position input')
                const form = document.querySelector('form#hello-form')
                const positionText = document.querySelector('#position_text')

                let formData = new FormData(form);
                addPositionInputs.forEach((input) => {
                    if ( input.attributes.type.value == 'checkbox' ) {
                        if ( input.checked == true ) {
                            formData.append(input.name, input.value);
                        }
                    } else {
                        formData.append(input.name, input.value);
                    }
                });
                formData.append('action', 'update_positions');
                formData.append('open_position', positionText.value);

                jQuery(document).ready( function($){
                    $.ajax({
                        url: "/wp-admin/admin-ajax.php",
                        method: 'post',
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(data){
                            // console.dir(data);
                            var data_json = JSON.parse(data);
                            if (data_json.success == 'Success') {
                                location.reload();
                            } else {
                                console.log('Ошибка отправки.');
                            }
                        },
                        error: () => {
                          console.log('Ошибка отправки.');
                        }
                    })
                });
            } else {
                name.style.border = '1px solid red'
            }
        })
    }
}
updatePosition()

function mediaLogoDownload() { // imgResult, inputUpload
    const mediaLogoInputs = document.querySelectorAll('input[name="file_cv"]')
    const resultFile = document.querySelector('.file-result')
    mediaLogoInputs.forEach((input) => {
        let reader = input.previousElementSibling.dataset.read
        reader = new FileReader();
        reader.onload = function(e) {
            input.previousElementSibling.src = e.target.result;
        };
        input.addEventListener('change', loadImageFile);
        function loadImageFile() {
            var file = input.files[0];
            reader.readAsDataURL(file);
            // console.dir(file);
            resultFile.innerText = file.name
            // console.dir(file.name);
        }
    });
}
mediaLogoDownload();

const closePosition = () => {
    const closePositionBtns = document.querySelectorAll('.close-position')
    if ( closePositionBtns.length > 0 ) {
        console.dir(closePositionBtns);
        closePositionBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                const form = document.querySelector('form#hello-form')
                let formData = new FormData(form);
                formData.append('action', 'update_positions_status');
                formData.append('position_id', btn.id);
                formData.append('post_status', btn.dataset.postStatus);

                jQuery(document).ready( function($){
                    $.ajax({
                        url: "/wp-admin/admin-ajax.php",
                        method: 'post',
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(data){
                            console.dir(data);
                            var data_json = JSON.parse(data);
                            if (data_json.success == 'Success') {
                                location.reload();
                            } else {
                                console.log('Ошибка отправки.');
                            }
                        },
                        error: () => {
                          console.log('Ошибка отправки.');
                        }
                    })
                });
            })
        });

    }
}
closePosition()

const addResponse = () => {
    const addResponseBtns = document.querySelectorAll('.add-response')
    if ( addResponseBtns.length > 0 ) {
        const resultSuccess = document.querySelector('.no-login__form_result-success')
        const resultSuccessEnd = document.querySelector('.no-login__form_result-success-end')
        const resultQuestionsGenerate = document.querySelector('.questions-answers__questions__result-generate')
        const questionsAnswers = document.querySelector('.questions-answers')
        const updateResponseBtns = document.querySelector('.update-response')
        // const answer = document.querySelector('textarea#answers_text')
        // const cuccessText = 'Your response has been sent successfully';
        const cuccessText = "Bear with us, your application is being sent, please don't close your browser or this tab";
        const errorText = "Thank you for applying to our Job Position. Our team will contact you soon.";
        const warningText = "Thank you for applying to our Job Position. Our team will contact you soon.";
        addResponseBtns.forEach((btn) => {
            // console.dir(btn);
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                let formData = new FormData(btn.parentElement.parentElement);
                const formNonce = document.querySelectorAll('form#hello-form input')
                formNonce.forEach((input) => {
                    formData.append(input.name, input.value);
                });
                formData.append('action', 'add_response');
                formData.append('post_id', btn.dataset.post);

                jQuery(document).ready( function($){
                    $.ajax({
                        url: "/wp-admin/admin-ajax.php",
                        method: 'post',
                        processData: false,
                        contentType: false,
                        data: formData,
                        beforeSend: function () {
                            resultSuccess.innerHTML = `<p class="color-green fs-20 mt40">${cuccessText}</p>`;
                        },
                        success: function(data){
                            console.dir(data);
                            var data_json = JSON.parse(data);
                            console.dir(data_json);

                            resultSuccess.innerHTML = ''

                            if (data_json.success == 'Success') {
                                resultSuccess.innerHTML = ''
                                btn.remove();
                                if ( data_json.response_match.toLowerCase() == 'true' ) {
                                    questionsAnswers.classList.add('active');
                                    resultQuestionsGenerate.innerHTML = data_json.new_questions

                                    const questionsItems = resultQuestionsGenerate.querySelectorAll('p.question-item')
                                    let questions = []
                                    questionsItems.forEach((item, i) => {
                                        questions[i] = item.innerText
                                    });
                                    const answer = document.querySelector('textarea#answers_text')
                                    const salary = document.querySelector('input#salary')
                                    const currency = document.querySelector('input#currency')
                                    updateResponse(updateResponseBtns, questions, answer, salary, currency, data_json.post_id, resultSuccessEnd);
                                    // resultSuccess.innerHTML = `<p class="color-green fs-20 mt40">${cuccessText}</p>`;
                                    // setTimeout(() => {
                                    //     location.reload();
                                    // }, 2000);
                                } else if ( data_json.response_match.toLowerCase() == 'false' ) {
                                    resultSuccess.innerHTML = `<p class="color-green fs-20 mt40">${errorText}</p>`;
                                }
                            } else {
                                for (const node of btn.parentElement.parentElement.elements) {
                                    node.style.border = '';
                                }
                                if ( data_json.empty_name ) {
                                    btn.parentElement.parentElement.elements.name.style.border = '1px solid red';
                                }
                                if ( data_json.empty_email ) {
                                    btn.parentElement.parentElement.elements.email.style.border = '1px solid red';
                                }
                                if ( data_json.empty_email_invalid ) {
                                    btn.parentElement.parentElement.elements[1].style.border = '1px solid red';
                                }
                                console.log('Ошибка отправки.');
                                console.dir(data_json);
                            }
                            setTimeout(() => {
                                if ( !data ) {
                                    resultSuccess.innerHTML = `<p class="color-green fs-20 mt40">${warningText}</p>`;
                                }
                            }, 30000);
                        },
                        error: () => {
                          console.log('Ошибка отправки.');
                        }
                    })
                });

            })
        });

    }
}
addResponse();

function updateResponse(btn, questions, answer, salary, currency, postId, resultSuccess) {
    const sucText = 'Please wait, your application is being processed, please do not close your browser or this tab.';
    const sucTextEnd = "Thank you for applying to our Job Position. Our team will contact you soon.";
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        // const nonce = document.querySelector('#hello_nonce')
        if ( answer.value ) {
            jQuery(document).ready( function($){
                $.ajax({
                    url: "/wp-admin/admin-ajax.php",
                    method: 'post',
                    data: {
                        action: 'update_response',
                        questions: questions,
                        answer: answer.value,
                        salary: salary.value,
                        currency: currency.value,
                        post_id: postId
                        // nonce: nonce.value
                    },
                    beforeSend: function () {
                        resultSuccess.innerHTML = `<p class="color-green fs-20 mt40">${sucText}</p>`;
                    },
                    success: function(data){
                        resultSuccess.innerHTML = ''
                        resultSuccess.innerHTML = `<p class="color-green fs-20 mt40">${sucTextEnd}</p>`;
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    },
                    error: function (jqXHR, text, error) {
                        console.log('Ошибка отправки.');
                    }
                });
            });
        } else {
            answer.style.border = '1px solid red';
        }
    });
}

function actionEl(elem) {
    const btn = document.querySelector(elem)
    if ( btn ) {
        btn.addEventListener('click', (e) => {
            btn.parentElement.nextElementSibling.classList.toggle("active")
        })
    }
}
actionEl('.btn-apply');

function actionResponseChat(elem) {}

const qwTest = () => {
    const btn = document.querySelector('.btn-qw-test')
    btn.addEventListener('click', (e) => {
        jQuery(document).ready( function($){
            $.ajax({
                url: "/wp-admin/admin-ajax.php",
                method: 'post',
                data: {
                    action: 'dop_questions_test',
                    // questions: questions,
                    // answer: answer.value,
                    post_id: 249
                    // nonce: nonce.value
                },
                success: function(data){
                    console.dir(data);
                    // setTimeout(() => {
                    //     location.reload();
                    // }, 2000);
                },
                error: function (jqXHR, text, error) {
                    console.log('Ошибка отправки.');
                }
            });
        });
    })
}
// qwTest();
