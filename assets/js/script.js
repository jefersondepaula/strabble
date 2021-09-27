//get the letters input word

const sel = (el) => document.querySelector(el);

const inputSearch = document.querySelector('input[name="rack"]');

/*write the word in a div*/ 
inputSearch.addEventListener('keyup', function(){
    let word = this.value; 
    sel('.form-result-word').innerText = `Your word is: ${word}`;
});

