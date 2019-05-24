export class Usuario {
    iduser: number;
    name: string = "";
    surname: string = "";
    birthdate: Date;
    address: string = "";
    email: string = "";
    password: string = "";
    ur_foto: string = "";
    constructor(iduser: number, name: string = "", surname: string = "", birthdate: Date, address: string = "", email: string = "", password: string = "", ur_foto: string = "") {
        this.iduser = iduser;
        this.name = name;
        this.surname = surname;
        this.birthdate = birthdate;
        this.address = address;
        this.email = email;
        this.password = password;
        this.ur_foto = ur_foto;
    }
}