export class Client {
    id = 0;
    lastname = "";
    firstname = "";
    zipcode= "";
    tel  = "";
    email = "";
    gender = "";
    login  = "";
    password  = "";

    constructor(id: number, lastname: string, firstname: string, zipcode: string, tel: string, email: string, gender: string, login: string, password: string) {
        this.id = id;
        this.lastname = lastname;
        this.firstname = firstname;
        this.zipcode= zipcode;
        this.tel = tel;
        this.email = email;
        this.gender = gender;
        this.login = login;
        this.password = password;
    }
}
