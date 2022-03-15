
class Clientes {

    constructor() {
        this._clienteEl = document.querySelector('#clientes_titular');
        this._pesquisaEl = document.querySelector('#pesquisaCliente');
        
        this.inicializer();
    }

    inicializer() {
        this.loadClients();
        this.pesquisa();
    }

    loadClients(pagina = 1, pesquisa='') {
        fetch(`${BASE_URL}ajax/clientesTitular?p=${pagina}&pesquisa=${pesquisa}`, {
            method: 'GET',
            mode: 'cors',
            cache: 'default',
        })
            .then(r => r.text())
            .then(result => {
                this._clienteEl.innerHTML = result;
                let paginationEl = document.querySelectorAll('.pagination li a');
                paginationEl.forEach(item=>{

                    item.addEventListener('click', e=>{
                        e.preventDefault();
                        let pagina = item.getAttribute('data-p');
                        console.log(pagina);
                        this.loadClients(pagina);
                    });
                });


            })
         .catch(e => console.log(e))
    }

    pesquisa() {
        let pesquisaEl = this._pesquisaEl;

        pesquisaEl.addEventListener('keyup', e=>{
           
            let text = e.target.value;
            console.log(text);
            if(text.length > 2) {
                this.loadClients(1, text)
            }else{
                this.loadClients(1);
            }
        });

        
    }
}
new Clientes();