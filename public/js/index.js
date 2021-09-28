const buttonClick = document.querySelector('.button-cadastrar');
var currentKeyword = document.querySelector('#key');
var currentText = document.querySelector('#conteudo'); 

buttonClick.addEventListener('click', writeFromJson );

function writeFromJson(event) {
    event.preventDefault();
    const response = new XMLHttpRequest();

    let formData = {
         keyword_name: currentKeyword.value,
         text_context: currentText.value
    };
    

    let newObject = JSON.stringify(formData);
    response.open('POST', './source/DialogSave.php', true);
    response.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    response.setRequestHeader("Cache-Control", "no-cache, no-store max-age=0");
    response.setRequestHeader("Expires", "Tue, 01 Jan 1980 1:00:00 GMT");
    response.setRequestHeader("Pragma", "no-cache");

    response.onreadystatechange = function() {
        if (response.readyState === 4 && response.status === 200) {
            console.log('request sucess, '+response.status);

            if (formData.keyword_name !== '' && formData.currentText !== '') {
                alert('Dados Salvo com sucesso !');
            }

            currentKeyword.value = '';
            currentText.value = '';
    
        }
    }
    response.send('data='+newObject);
}

