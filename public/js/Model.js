import Event from './Event.js';

export default class Model{
    constructor(role) {
        this.role = role;
    }
    /**
     * тут определяем базовую разметку
     * @returns cards depends on role
     */

    getCards() {
        
        if(this.role.getName() == 'editor') {
            return new Promise((res) => {
                res([
                    {name: "card", id: 1},
                    {name: "card", id: 2},
                    {name: "card", id: 4},
                    {name: "card123", id: 3}
                ]);
            });
        } 
        if(this.role.getName() == 'admin') {
            return new Promise((res) => {
                res([{name: "adminStaff... controlMenus Etc", id: 3}]);
            });
        }
        
    }
}