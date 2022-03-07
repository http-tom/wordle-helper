(function() {
    let btnExclude = document.getElementById('addExclude');
    let btnInclude = document.getElementById('addInclude');
    let frm = document.getElementById('frmAjaxHelper');
    let toggles = document.getElementsByClassName('toggler');

    for(let i = 0; i < toggles.length; i++) {
        let attribs = toggles[i].attributes;
        let id = attribs['data-toggle'].nodeValue;
        if(id != '') {
            let el = document.getElementById(id);
            toggles[i].addEventListener('click', function() {
                if(el.className == 'hidden') {
                    el.className = '';
                } else {
                    el.className = 'hidden';
                }
            });
        }
    }


    btnExclude.addEventListener('click', function() {
        let input = document.createElement('input');
        input.type="text";
        input.name="exclude[]";
        input.maxLength = 4;
        input.size = 5;
        input.classList = 'frm-control';
        input.autocomplete = 'off';
        this.parentNode.insertBefore(input, this);
    });

    btnInclude.addEventListener('click', function() {
        let input = document.createElement('input');
        input.type="text";
        input.name="include[]";
        input.maxLength = 4;
        input.size = 5;
        input.classList = 'frm-control';
        input.autocomplete = 'off';
        this.parentNode.insertBefore(input, this);
    });

    frm.addEventListener('submit', function(e) {
        e.preventDefault();

        const frmData = new FormData(frm);
        fetch('wordle.php', {method: 'post', body: frmData})
        .then(response => response.json())
        .then(data => {
            let res = document.getElementById('results');
            let sug = document.getElementById('suggestions');
            
            res.innerHTML = '';
            sug.innerHTML = '';

            if(data.suggestion) {
                let pill = document.createElement('li');
                pill.className = 'badge';
                pill.innerText = ' ' + data.suggestion + ' ';
                sug.innerText = 'Word suggestion: ';
                sug.appendChild(pill);
            } else {
                if(data.results) {
                    for(let i in data.results) {
                        let pill = document.createElement('li');
                        pill.className = 'badge';
                        pill.innerText = ' ' + data.results[i] + ' ';
                        res.appendChild(pill);
                    }
                }
            }

            if(res.innerHTML.length === 0 && sug.innerHTML.length === 0) {
                res.innerText = '[no results]';
            }
            document.body.scrollIntoView('results');
        });
        return false;
    }, false);
})();