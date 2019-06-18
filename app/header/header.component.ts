import { Component } from "@angular/core";
import { Router } from "@angular/router";

@Component({

    selector:'header-tag',
    templateUrl:'./header.component.html',
    styleUrls:['./header.component.css']    

})

export class HeaderComponent{
    header={
        title:"",
        words:""
    };
    fail:string = "";
    failproxy: string = "";
    constructor(private _router: Router) { }
    checkUser(){
        var token =  localStorage.getItem('token');
        if(token == null){
            this.fail = "No hay usuario logeado"
        }else{
            this._router.navigate(['/profile']);
            
        }
    }
    checkUser2(){
        var token = localStorage.getItem('token');
        console.log(token);
        if(token == null){
            this.failproxy = "No puedes acceder sin logear";
        }else{
            this._router.navigate(['/proxy']);
            this.failproxy = '';
        }
    }

    
};