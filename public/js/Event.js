export default class Event {
    listeners = [];
    // constructor() { }

    addListener(listener) {
        this.listeners.push(listener);
    }

    trigger(v) {
        this.results = this.listeners.map((el) => { return el(v) } );
    }

    //this but also we could pass CBfunction here to process thomthing
    getLastListener() {
        console.log(this.results[this.results.length - 1]);
        return this.results[this.results.length - 1];
    }
}