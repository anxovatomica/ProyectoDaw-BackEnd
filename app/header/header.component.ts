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
    constructor(private _router: Router) { }
    checkUser(){
        var token =  localStorage.getItem('token');
        if(token == null){
            this.fail = "There's no user logged"
        }else{
            this._router.navigate(['/profile']);
        }
    }
};
