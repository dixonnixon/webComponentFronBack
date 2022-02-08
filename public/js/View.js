import Event from './Event.js';
export default class View {
    elements = [];
    constructor() {
        this.beforeRenderEvent = new Event();
        this.createContent = new Event();
        // this.afterFetch = new Event();

        this.container = document.createElement('div');
        this.shadow = this.container.attachShadow({mode: 'open'});
        this.container.classList.add('container');
        
        this.templates = document.createElement('div');
        this.templates.classList.add('template-container');


        //--------------add slot fulfill data
        this.cardsDiv = document.createElement('div');
        this.cardsDiv.setAttribute('slot', 'cards');
        this.cardsDiv.innerHTML = "";
        //-------------------------------

        
    }

    /**
     * зпускает выбор шаблона из файла и заполняетнужным теневой ДОМ 
     */
    prepare(data) { 
        data.then((cards) => {
            this.cardsDiv.append(...cards.map((el) => {
                let card = document.createElement('div');
                card.classList.add('card');
                card.id = "card" + el.id;
                card.innerHTML = el.name;
                return card;
            }));
        });


        this.beforeRenderEvent.trigger("index");

        this.beforeRenderEvent.getLastListener().then(() => {
            const template = this.templates.querySelector('template.cards-layout');
            this.shadow.appendChild(template.content.cloneNode(true)); 
        });
    }

    render() {
        console.log('rendering ...');
        this.container.append(this.cardsDiv);

        document.querySelector('body').prepend( this.container);



        // this.renderEvent.trigger();
        // 
        /**
         * [] make several cards
         *      - render it as a div in the shadow dom from a template with styles
         * 
         * [] make different templates of several cards
         *      - get correspond cardList template from file

         *      - layout 1: <div><row of cards><div controls></div> 
         *      - layout 2: <div><column of cards><div hello></div> 
         * 
         * */
        
    }
}