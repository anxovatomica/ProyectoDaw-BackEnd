import { Component } from "@angular/core";
import { Usuario } from './usuario';
import { Login } from './login';
import { UsuarioService } from "./usuario.service";
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router, ActivatedRoute, Params } from
'@angular/router'; 
import * as jwt_decode from "jwt-decode";
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
    superuser;
    superpass;
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
            console.log(result.token);
            if(result.token !=null){
                console.log("Token OK");
                localStorage.setItem("token",result.token);
                console.log(result.token);
                //redirect
                this.getDecodedAccessToken(result.token);
                console.log("name: " + this.superuser);
                console.log("pass: " + this.superpass);
                this._router.navigate(['/profile']);
            }else{
                this.fail = "Login incorrecto";
                console.log("Login FAIL");
            }
        } , (error) => {
            console.log(error);
        });
    }
    getDecodedAccessToken(token: string): any {
        try{
            var data = jwt_decode(token);
            this.superuser = data.name;
            this.superpass = data.password;
            return data;
        }
        catch(Error){
            return null;
        }
      }
};

