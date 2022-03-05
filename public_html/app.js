(function() {
    let btnExclude = document.getElementById('addExclude');
    let btnInclude = document.getElementById('addInclude');
    let frm = document.getElementById('frmAjaxHelper');

    btnExclude.addEventListener('click', function() {
        let input = document.createElement('input');
        input.type="text";
        input.name="exclude[]";
        input.maxLength = 24;
        input.size = 5;
        input.classList = 'frm-control';
        this.parentNode.insertBefore(input, this);
    });

    btnInclude.addEventListener('click', function() {
        let input = document.createElement('input');
        input.type="text";
        input.name="include[]";
        input.maxLength = 24;
        input.size = 5;
        input.classList = 'frm-control';
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
            
            res.innerText = '';
            sug.innerText = '';

            if(data.suggestion) {
                sug.innerText = data.suggestion;
            } else {
                if(data.results) {
                    for(let i in data.results) {
                        res.innerText += ' ' + data.results[i] + ' ';
                    }
                }
            }
        });
        return false;
    }, false);
})();