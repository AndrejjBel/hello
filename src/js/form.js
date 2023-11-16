const addCandidate = () => {
    const selects = document.querySelectorAll('.forms__item-item__select')
    if ( selects.length > 0 ) {
        const optionsItems = document.querySelectorAll('.options-items span')
        const questionsBrancherBtn = document.querySelectorAll('#questions-brancher-btn')
        selects.forEach((item) => {
            item.addEventListener('click', (e) => {
                item.children[2].classList.toggle('active')
            })
        });

        optionsItems.forEach((item) => {
            item.addEventListener('click', (e) => {
                item.parentElement.parentElement.children[0].innerText = item.innerText
                item.parentElement.parentElement.children[3].value = item.innerText
                if (item.parentElement.parentElement.children[4]) {
                    item.parentElement.parentElement.children[4].value = item.id
                }
            })
        });

        questionsBrancherBtn.forEach((item) => {
            item.addEventListener('click', (e) => {
                item.parentElement.style.display = 'none'
                item.parentElement.parentElement.classList.add('active')
                item.parentElement.parentElement.children[1].classList.add('active')
            })
        });
    }
    const optionsItemsEva = document.querySelectorAll('.options-items span')
    if ( optionsItemsEva.length > 0 ) {
        optionsItemsEva.forEach((item) => {
            item.addEventListener('click', (e) => {
                item.parentElement.parentElement.children[0].innerText = item.innerText
                item.parentElement.parentElement.children[3].value = item.innerText
            })
        });
    }
}
addCandidate()
