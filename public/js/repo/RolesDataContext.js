export default class RolesDataContext {
    static get(userId) {
        return fetch('url' + userId).then(resp => resp.json());
    }
}