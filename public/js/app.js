import View from './View.js';
import Model from './Model.js';


function Role(name) {
    this.name = name;

    this.getName = () => this.name;
}

// let role = new Role('editor');
let role = new Role('sc');

export class App {
    constructor(url) {
        this.url = url;
        this.view = new View();
        this.model = new Model(role);

        this.view.beforeRenderEvent.addListener(async (aPage) => {
            const res = await fetch(this.url + 'public/files/templates/' 
                + role.getName() + '/' + aPage + 'templates.html', {
                method: "GET",
                headers: {
                    'Content-type': 'text/html'
                }
            });
            this.view.templates.innerHTML = await res.text();
            // this.view.afterFetch.trigger();
        });

        this.view.prepare(this.model.getCards());
    }

    run() {
        // console.log(role.getName());
        window.addEventListener('DOMContentLoaded', (event) => {
            console.log('DOM fully loaded and parsed' , this );
            this.view.render();
        });
    }
}



