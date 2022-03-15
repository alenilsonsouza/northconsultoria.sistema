class Cep {
    constructor() {
        this._cepEl = document.querySelector('#cep');
        this.loadCep();
    }

    loadCep() {

        if (this._cepEl) {

            this._cepEl.addEventListener('keyup', e => {
                let cep = e.target.value;

                if (cep.length == 8) {
                    loading(true);
                    fetch(`https://viacep.com.br/ws/${cep}/json/`, {
                        method: 'GET',
                        mode: 'cors',
                        cache: 'default',
                    })
                        .then(r => r.json())
                        .then(result => {
                            let logradouro = document.querySelector('#logradouro');
                            let complemento = document.querySelector('#complemento');
                            let bairro = document.querySelector('#bairro');
                            let cidade = document.querySelector('#cidade');
                            let estado = document.querySelector('#estado');
                            let numero = document.querySelector('#numero');
                            if (typeof result.erro == 'undefined') {
                                logradouro.value = result.logradouro;
                                complemento.value = result.complemento;
                                bairro.value = result.bairro;
                                cidade.value = result.localidade;
                                estado.value = result.uf;
                                numero.focus();
                            } else {
                                logradouro.value = '';
                                complemento.value = '';
                                bairro.value = '';
                                cidade.value = '';
                                estado.value = '';
                                alert('CEP não encontrado!')
                            }


                        })
                        .catch(e => console.log(e))
                }
                loading(false);
            });

        }
    }
}
new Cep();