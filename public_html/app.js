(function() {
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







    function evtCellKeyUp(e, el, cellObj) {
        if(el.value.length == 0) {
            if(document.getElementsByClassName(cellObj.className).length == 1) {
                return;
            }
            el.previousElementSibling.focus();
            el.remove();
        } else {
            if(el.nextElementSibling === 'undefined' || el.nextElementSibling.classList.contains(cellObj.className) === false) {
                let input = document.createElement('input');
                input.type="text";
                input.name=cellObj.name+"[]";
                input.maxLength = 1;
                input.size = 1;
                input.classList = 'frm-control '+cellObj.className;
                input.autocomplete = 'off';
                input.addEventListener('keyup', function(e) {
                    evtCellKeyUp(e,this,cellObj);
                });
                el.parentNode.insertBefore(input, el.nextElementSibling);
                input.focus();
            }
        }
    }


    let charCells = [
        {
            className: 'includeChar',
            name: 'include'
        },
        {
            className: 'excludeChar',
            name: 'exclude'
        }
    ];

    for(let i = 0; i < charCells.length; i++) {
        let incCharEls = document.getElementsByClassName(charCells[i].className);
        for(let j = 0; j < incCharEls.length; j++) {
            let element = incCharEls[j];
            element.addEventListener('keyup', function(e) {
                evtCellKeyUp(e,element,charCells[i]);
            });
        }
    }



    let cellTemplates = document.getElementsByClassName('charTemplate');
    for(let i = 0; i < cellTemplates.length; i++) {
        cellTemplates[i].addEventListener('keydown', function(e) {
            // overwrite contents if new letter input
            if(this.value.length == 1) {
                this.value = '';
            }
            if(false===((e.keyCode > 64 && e.keyCode < 91) || e.keyCode == 8)) {
                e.preventDefault();
                return false;
            }
        });
        cellTemplates[i].addEventListener('keyup', function(e) {
            if((e.keyCode > 64 && e.keyCode < 91)  || e.keyCode == 9 || e.keyCode == 13 || e.keyCode == 39) {
                // A-Z, backspace, enter, right
                if(this.nextElementSibling !== null) {
                    this.nextElementSibling.focus();
                }
            }
            if(e.keyCode == 8 || e.keyCode == 37 || (e.keyCode == 9 && e.shiftKey === true)) {
                // backspace, left
                this.previousElementSibling.focus();
            }
        });
    }


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