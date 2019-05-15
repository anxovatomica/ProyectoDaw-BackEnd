import { Component, OnInit } from "@angular/core";
import { ProfileService } from "./profile.service";
import { Profile } from "./profile";
import * as myGlobals from 'src/app/globals';
import * as user from 'src/app/login/login.component';
import { getAllDebugNodes } from "@angular/core/src/debug/debug_node";
import { Comment } from "./Comment";
import { Router, ActivatedRoute, Params } from '@angular/router'; 
import * as jwt_decode from "jwt-decode";
export var superidComment: string = '';
export var superidUser: string = '';
export var superidPost: string = '';
export var supercomment: string = '';
//export var superdate: string = '';

@Component({

    selector:'profile-tag',
    templateUrl:'./profile.component.html',
    styleUrls:['./profile.component.css'],
    providers:[ProfileService]

})

export class ProfileComponent  {
    profile: Profile[] = [];
    
    //foto: string;
    constructor(private serviceProfile: ProfileService,private _router: Router,
        private _activRoute: ActivatedRoute) { }
    //comment: Comment[] = [];
    superdate: string = '';
    id;
        name;
        surname;
        birthdate;
        username;
        address;
        email;
        password;
        foto;
        date;
        logout = false;
        
        
    
    ngOnInit(): void {
        a =  localStorage.getItem('token');
        if(a = null){
            this.id = "";
            this.name = "";
            this.surname = "";
            this.username = "";
            this.birthdate = "";
            this.address = "";
            this.email = "";
            this.password = "";
            this.foto = "";
            this.date = "";
        }else if(foto = "fewf"){
            this.id = user.superid;
            this.name = user.supername;
            this.surname = user.supersurname;
            this.username = user.supername;
            this.birthdate = user.superbirthdate;
            this.address = user.superaddress;
            this.email = user.superemail;
            this.password = user.superpass;
            this.foto = user.superphoto;
            this.date = this.superdate;
        }
        
    }
    logOut(){
       console.log("log Out");
       console.log("token in: " + localStorage.getItem('token'));
            localStorage.removeItem('token');
            console.log("token out: " + localStorage.getItem('token'));
            this.id = "";
            this.name = "";
            this.surname = "";
            this.username = "";
            this.birthdate = "";
            this.address = "";
            this.email = "";
            this.password = "";
            this.foto = "";
            this.date = "";
        /*let logout:boolean = true;
        //console.log(usu);
        this.serviceProfile.logOut( logout ).subscribe((result) => {
            
                console.log("Token OK");
                localStorage.setItem("token",result);
                console.log(result);
                 //redirect
                 this.getDecodedAccessToken(result);
                //this._router.navigate(['/profile']);
            
        } , (error) => {
            console.log(error);
        });*/
    }
    /*getLogin(id){
        //console.log("GET LOGIN!")
        let comment = new Comment(user.superid);
        //console.log(usu);
        this.serviceProfile.getPost( comment ).subscribe((result) => {
            
                console.log("Token OK");
                localStorage.setItem("token",result);
                console.log(result);
                 //redirect
                 this.getDecodedAccessToken(result);
                 console.log("Id Comment: " + superidComment);
                 console.log("id User: " + superidUser);
                 console.log("id post: " + superidPost);
                 console.log("comment: " + supercomment);
                 console.log("date: " + this.superdate);
                //this._router.navigate(['/profile']);
            
        } , (error) => {
            console.log(error);
        });
    }*/
};