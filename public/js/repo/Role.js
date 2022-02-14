import RolesDataContext from "./RolesDataContext.js";
import { Role as Model } from "../ent/Role.js";

export default class Role {
    constructor() {
        this.role = null;

        this.dataContext = new RolesDataContext();
    }

    getAll() {

    }

    get(aUser, cb) {
        this.dataContext.get(aUser.getId()).then((aRole) => {
            this.role = cb(new Model(aRole));
        });
    }
    insert() {}
    remove() {}
    update() {}
}