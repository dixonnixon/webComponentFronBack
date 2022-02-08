
import('./app.js').then((module) => {
    let app = new module.App(document.URL.split('(http:\/\/.+\/)')[0]);

    app.run();
    
});