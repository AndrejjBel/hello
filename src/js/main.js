const copyQuest = () => {
    const writeBtn = document.querySelector('#copy-questions')
    const inputEl = document.querySelector('.to-copy')
    const title = document.querySelector('h1.entry-title')
    const name = document.querySelector('#name')

    const inputElObj = document.querySelectorAll('.to-copy p')
    let questionsIt = ''
    inputElObj.forEach((item) => {
        questionsIt = questionsIt + item.innerText.trim()+'\r\n'
    });

    if ( writeBtn ) {
        writeBtn.addEventListener('click', (e) => {
            const inputElObj = document.querySelectorAll('.to-copy p')
            let questionsIt = ''
            inputElObj.forEach((item) => {
                questionsIt = questionsIt + item.innerText.trim()+'\r\n'
            });
            if ( title ) {
                var text = title.innerText.trim()+'\r\n' + questionsIt
            } else if ( name ) {
                var text = name.value.trim()+'\r\n' + questionsIt
            } else {
                var text = questionsIt
            }

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
copyQuest()

const updateCandidat = () => {
    const updateCandidateSubmit = document.querySelector('#update-candidate-submit')
    if ( updateCandidateSubmit ) {
        updateCandidateSubmit.addEventListener('click', (e) => {
            const questionsItems = document.querySelectorAll('p.question-item')
            let questions = []
            questionsItems.forEach((item, i) => {
                questions[i] = item.innerText
            });
            const answer = document.querySelector('textarea#answer')
            const status = document.querySelector('#status')
            updateCand(questions, answer, status.value);
        })
    }
}
updateCandidat()

const submitEva = () => {
    const gradeQuestions = document.querySelector('#grade-questions')
    if ( gradeQuestions ) {
        gradeQuestions.addEventListener('click', (e) => {
            const text = document.querySelector('#answer').value
            const position = document.querySelector('#candidates_position').value
            const level = document.querySelector('#level').value
            const result = document.querySelector('#result')
            const dopInfo = document.querySelector('#dop-info')
            const postId = document.querySelector('#post_id')
            const loader = document.querySelector('#js-loader')
            loader.classList.remove("no-active")
            jQuery(document).ready( function($){
                $.ajax({
                    type: 'POST',
                    url: '/wp-admin/admin-ajax.php',
                    data: {
                      action: 'text_generated_new', // text_generated
                      //instructions: instruction,
                      text: text,
                      position: position,
                      level: level,
                      post_id: postId.value,
                      //enLsChek: enLsChek
                      //number: generateNumber
                    },
                    //dataType: "json",
                    success: function(data){
                        loader.classList.add("no-active")
                        let str = data.replace(/[0-9]/g, '');
                        let num = data.replace(/[^0-9]/g, '');
                        dopInfo.innerHTML = ''
                        dopInfo.insertAdjacentHTML('beforeend', str)

                        result.innerHTML = ''

                        if ( num > 2 ) {
                            num = num.substring(0, 2);
                        } else {
                            num = num;
                        }
                        if ( num <= 60 ) {
                            result.innerHTML = 'LOW';
                        } else if ( num >= 90 ) {
                            result.innerHTML = 'TOP';
                        } else {
                            result.innerHTML = 'MEDIUM';
                        }
                        //console.dir(data);
                    },
                    error: () => {
                      console.log('Ошибка отправки.');
                      loader.classList.add("no-active")
                      dopInfo.innerHTML = ''
                      dopInfo.insertAdjacentHTML('beforeend', '<span style="color:red; font-weight:600;">ERROR</span>')
                    }
                })
            });
        })
    }
}
submitEva()

const evaluatedCand = () => {
    const selects = document.querySelectorAll('.forms__item-item__select')
    if ( selects.length > 0 ) {
        const options = document.querySelectorAll('.options-items span')
        const currentUser = document.querySelector('#current_user_id')
        const nonce = document.querySelector('#hello_nonce')
        options.forEach((item) => {
            item.addEventListener('click', (e) => {
                //console.dir(evaluated);
                let postId = item.parentElement.parentElement.dataset.post
                let evaluatedVal = item.innerText
                //console.dir(postId);
                jQuery(document).ready( function($){
                    $.ajax({
                        url: "/wp-admin/admin-ajax.php",
                        method: 'post',
                        data: {
                            action: 'evaluated_candidates',
                            evaluated: evaluatedVal,
                            post_id: postId,
                            author: currentUser.value,
                            nonce: nonce.value
                        },
                        success: function (data) {
                            var data_json = JSON.parse(data);
                            //console.dir(data);
                        },
                        error: function (jqXHR, text, error) {}
                    });
                });
            })
        });
    }
}
evaluatedCand()

function updateCand(questions, answer, status){
    const currentUser = document.querySelector('#current_user_id')
    const postId = document.querySelector('#post_id')
    const nonce = document.querySelector('#hello_nonce')
    const result = document.querySelector('#result')
    const dopInfo = document.querySelector('#dop-info')
    const candidatesPosition = document.querySelector('#candidates-position')
    const level = document.querySelector('#level')
    const name = document.querySelector('#name')
    const email = document.querySelector('#email')

    const form = document.querySelector('form#add-candidate')

    let formData = new FormData(form);
    formData.append('questions', questions);
    formData.append('answer', answer.value);
    formData.append('status', status);
    formData.append('action', 'update_candidates');
    formData.append('author', currentUser.value);
    formData.append('post_id', postId.value);
    formData.append('nonce', nonce.value);

    jQuery(document).ready( function($){
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            method: 'post',
            processData: false,
            contentType: false,
            data: formData,

            // data: {
            //     action: 'update_candidates',
            //     name: name.value,
            //     email: email.value,
            //     position: candidatesPosition.value,
            //     level: level.value,
            //     questions: questions,
            //     answer: answer.value,
            //     status: status,
            //     result: result.innerText,
            //     dopInfo: dopInfo.innerText,
            //     post_id: postId.value,
            //     author: currentUser.value,
            //     nonce: nonce.value
            // },
            success: function (data) {
                var data_json = JSON.parse(data);
                // console.dir(data_json);
                // console.dir(data);
                location.reload();
            },
            error: function (jqXHR, text, error) {}
        });
    });
}

const textareaValidate = () => {
    const answer = document.querySelector('textarea#answer')
    if ( answer ) {
        const addCandidateSubmit = document.querySelector('#add-candidate-submit')
        const gradeQuestions = document.querySelector('#grade-questions')
        const answerCount = document.querySelector('#answer-count')
        answerCount.innerText = answer.value.length
        if ( answer.checkValidity() ) {
            gradeQuestions.disabled = false
            gradeQuestions.style.pointerEvents ='auto'
            gradeQuestions.style.cursor ='pointer'
        } else {
            gradeQuestions.disabled = true
            gradeQuestions.style.pointerEvents =''
            gradeQuestions.style.cursor ='default'
        }
        if ( answer.value.length >= 8000 ) {
            gradeQuestions.disabled = true
            gradeQuestions.style.pointerEvents =''
            gradeQuestions.style.cursor ='default'
        }
        answer.addEventListener('input', (e) => {
            //console.dir(answer.checkValidity());
            answerCount.innerText = answer.value.length
            if ( answer.checkValidity() ) {
                gradeQuestions.disabled = false
                gradeQuestions.style.pointerEvents ='auto'
                gradeQuestions.style.cursor ='pointer'
            } else {
                gradeQuestions.disabled = true
                gradeQuestions.style.pointerEvents =''
                gradeQuestions.style.cursor ='default'
            }
            if ( answer.value.length >= 8000 ) {
                gradeQuestions.disabled = true
                gradeQuestions.style.pointerEvents =''
                gradeQuestions.style.cursor ='default'
            }
        })
    }
}
textareaValidate()

const renderQuestions = () => {
    const candidatesPosition = document.querySelector('#candidates_position')
    if ( candidatesPosition ) {
        const itemsQuestions = document.querySelector('.add-candidate__item__questions')
        candidatesPosition.addEventListener('change', (e) => {
            localStorage.setItem('position', candidatesPosition.value )
            // const date = new Date;
            // date.setDate(date.getDate() + 30);
            // setCookie('position', candidatesPosition.value, {expires: date}, {path: '/glampings'}, false);
            renderQuestionsAjax(candidatesPosition.value, itemsQuestions, '');
        })
    }
}
renderQuestions()

const renderQuestionsGenerate = () => {
    const generateQuestionsBtn = document.querySelector('#generate-questions')
    if ( generateQuestionsBtn ) {
        const itemsQuestions = document.querySelector('.questions__block-form__content-text')
        generateQuestionsBtn.addEventListener('click', (e) => {
            const candidatesPosition = document.querySelector('#candidates_position')
            const candidatesPositionSingle = document.querySelector('#position')
            const postId = document.querySelector('#post_id')
            let position = '';
            if ( candidatesPosition ) {
                position = candidatesPosition.value
            } else if ( candidatesPositionSingle ) {
                position = candidatesPositionSingle.innerText
            }
            renderQuestionsAjax(position, itemsQuestions, postId.value);
        })
    }
}
renderQuestionsGenerate()

function renderQuestionsAjax(position, items, postId){
    jQuery(document).ready( function($){
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            method: 'post',
            data: {
                action: 'render_questions',
                position: position,
                postId: postId
            },
            success: function (data) {
                //console.dir(data);
                items.innerHTML = data
            },
            error: function (jqXHR, text, error) {}
        });
    });
}

// jQuery
jQuery(document).ready( function($){
    const addCandidateSubmit = document.querySelector('#add-candidate-submit')
    const name = document.querySelector('#name')
    const email = document.querySelector('#email')
    const candidatesPosition = document.querySelector('#candidates-position')
    const level = document.querySelector('#level')
    const answer = document.querySelector('textarea#answer')
    const currentUser = document.querySelector('#current_user_id')
    const nonce = document.querySelector('#hello_nonce')
    const dashboardWarning = document.querySelector('.dashboard__warning')

    const form = document.querySelector('form#add-candidate')

    if (addCandidateSubmit) {
        addCandidateSubmit.addEventListener('click', (e) => {
            e.preventDefault();
            const questionsItems = document.querySelectorAll('.questions__block-form__content-text p.question-item')
            let questions = []
            questionsItems.forEach((item, i) => {
                questions[i] = item.innerText
            });
            //const levelChecked = document.querySelector('input[name="level"]:checked')
            const level = document.querySelector('#level')
            //console.dir(questions);

            let formData = new FormData(form);
            formData.append('action', 'add_candidates');
            formData.append('author', currentUser.value);
            formData.append('questions', questions);
            formData.append('answer', answer.value);
            formData.append('nonce', nonce.value);

            $.ajax({
                url: "/wp-admin/admin-ajax.php",
                method: 'post',
                processData: false,
                contentType: false,
                data: formData,

                // data: {
                //     action: 'add_candidates',
                //     name: name.value,
                //     email: email.value,
                //     position: candidatesPosition.value,
                //     level: level.value,
                //     questions: questions,
                //     answer: answer.value,
                //     author: currentUser.value,
                //     nonce: nonce.value
                // },
                success: function (data) {

                    var data_json = JSON.parse(data);
                    console.dir(data_json);

                    var data_json = JSON.parse(data);
                    if (data_json.class == 'errors') {
                        dashboardWarning.innerHTML = ''
                        if ( data_json.empty_title ) {
                            name.style.border = '1px solid red'
                        } else {
                            name.style.border = ''
                        }
                        if ( data_json.empty_email ) {
                            email.style.border = '1px solid red'
                        } else {
                            email.style.border = ''
                        }
                        if ( data_json.email_error ) {
                            email.style.border = '1px solid red'
                        } else {
                            email.style.border = ''
                        }
                        if ( data_json.empty_position ) {
                            candidatesPosition.parentElement.style.border = '1px solid red'
                        } else {
                            candidatesPosition.parentElement.style.border = ''
                        }
                        if ( data_json.empty_level ) {
                            level.parentElement.style.border = '1px solid red'
                        } else {
                            level.parentElement.style.border = ''
                        }
                        addItem(data_json);
                        setTimeout(() => {
                            removeItem();
                        }, 3000);
                    } else {
                        window.location.href = data_json.post_url;
                    }
                },
                error: function (jqXHR, text, error) {}
            });
        });
    }

    function contentItem(err) {
        const dashboardWarning = document.querySelector('.dashboard__warning')
        let i = 0;
        Object.entries(err).forEach((entry) => {
        	const [key, value] = entry;
            if ( key !== 'class') {
                setTimeout(() => {
                    dashboardWarning.insertAdjacentHTML('beforeEnd', `<p class="dashboard__warning__item">${value}</p>`), 500 * (i + 1)
                });
            }
            i++;
        });
    }

    function addItem(err) {
        const dashboardWarning = document.querySelector('.dashboard__warning')
        let i = 0;
        Object.entries(err).forEach((entry) => {
        	const [key, value] = entry;
            if ( key !== 'class') {
                dashboardWarning.insertAdjacentHTML('beforeEnd', `<p class="dashboard__warning__item">${value}</p>`)
            }
            i++;
        });
    }

    function removeItem() {
        const dashboardWarning = document.querySelectorAll('.dashboard__warning__item')
        if ( dashboardWarning.length > 0 ) {
            dashboardWarning.forEach((el, i) => setTimeout(() => el.remove(), 200 * (i + 1)));
        }
    }

});
