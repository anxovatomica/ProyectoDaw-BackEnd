import { Component } from "@angular/core";
import { Usuario } from './usuario';
import { Login } from './login';
import { UsuarioService } from "./usuario.service";
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router, ActivatedRoute, Params } from '@angular/router'; 
import * as jwt_decode from "jwt-decode";
export var superid: string = '';
export var supername: string = '';
export var supersurname: string = '';
export var superbirthdate: string = '';
export var superaddress: string = '';
export var superemail: string = '';
export var superpass: string = '';
export var superphoto: string = '';


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
    fail: string= '';
    res:Login;
    
    
    result: string = '';
    test ;
    home={
        title:"",
        words:""
    };
    

    constructor(private serviceUser: UsuarioService,private _router: Router,
        private _activRoute: ActivatedRoute) { }
    getLogin(){
        //console.log("GET LOGIN!")
        let usu = new Login(this.name,this.pass);
        //console.log(usu);
        this.serviceUser.loginUser( usu ).subscribe((result) => {
            //console.log("FUNCIONA!:");
            //console.log(result.token);
            if(result.token !=null){
                console.log("Token OK");
                localStorage.setItem("token",result.token);
                
                console.log(result.token);
                //redirect
                this.getDecodedAccessToken(result.token);
                console.log("Id: " + superid);
                console.log("name: " + supername);
                console.log("surname: " + supersurname);
                console.log("birthdate: " + superbirthdate);
                console.log("address: " + superaddress);
                console.log("email: " + superemail);
                console.log("pass: " + superpass);
                console.log("photo: " + superphoto);
                this._router.navigate(['/profile']);
            }else{
                this.fail = "Login incorrecto";
                console.log("Login FAIL");
            }
        } , (error) => {
            console.log(error);
            console.log("Login FAIL");
        });
    }
    getDecodedAccessToken(token: string): any {
        try{
            var data = jwt_decode(token);
            superid = data.iduser;
            supername = data.name;
            supersurname = data.surname;
            superbirthdate = data.birthdate;
            superaddress = data.address;
            superemail = data.email;
            superpass = data.password;
            superphoto = data.ur_foto;
            return data;
        }
        catch(Error){
            return null;
        }
      }
};

