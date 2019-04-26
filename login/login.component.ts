import { Component } from "@angular/core";
import { Usuario } from './usuario';
import { Login } from './login';
import { UsuarioService } from "./usuario.service";
import { HttpClient, HttpHeaders } from '@angular/common/http';
@Component({

    selector:'login-tag',
    templateUrl:'./login.component.html',
    styleUrls:['./login.component.css'],    
    providers: [UsuarioService]
})
export class LoginComponent{

    usuarios: Usuario[] = [];
    login = {};
    name: string = '';
    pass: string = '';
    log:string;
    res:Login;
    result: string = '';
    test ;
    home={
        title:"",
        words:""
    };


    constructor(private serviceUser: UsuarioService) { }
    getLogin(){
        console.log("GET LOGIN!")
        let usu = new Login(this.name,this.pass);
        this.serviceUser.loginUser( usu ).subscribe((result) => {
            console.log(result);

        } , (result) => {

            console.log(result.token);
            
            localStorage.setItem("token",result.token ) ;


        });
        //this.res = JSON.stringify(new Login(this.name, this.pass));
       // this.getUsers();
        //return JSON.stringify(this.res);
    }

    getUsers() {
        this.res = new Login(this.name, this.pass);
        this.serviceUser.getUser().subscribe(
          (result) => {
            //console.log("Result: " + JSON.stringify(result));
            //console.log(result["message"]);
            this.usuarios = result["message"];
            for (let index = 0; index < this.usuarios.length; index++) {
                
                const element = this.usuarios[index];
                console.log("DB name: " + element.name);
                console.log("DB pass: " + element.password);
                console.log("LOG name: " + this.res.name);
                console.log("LOG res pass: " + this.res.password);
                //console.log("Name: " + element.name + " Pass: " + element.password);
                /*if(element.name == this.res.name){
                    console.log('Name OK');
                    this.log = 'Name OK';
                } if(element.password == this.res.password){
                    console.log('Password OK');
                    this.log = 'Password OK';
                } */
                if(element.name == this.res.name && element.password == this.res.password){
                    console.log('LOGIN OK');
                    this.log = 'LOGIN OK';
                }else{
                    console.log('LOGIN FAIL');
                    this.log = 'LOGIN OK';
                }
            }
        },
        (error) => {
            console.log(error);
         });
      }

};

