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
    id = user.superid;
    name = user.supername;
    surname = user.supersurname;
    username = user.supername;
    birthdate = user.superbirthdate;
    address = user.superaddress;
    email = user.superemail;
    password = user.superpass;
    foto = user.superphoto;
    date = this.superdate;
    ngOnInit(): void {
        this.getLogin(this.id);
    }
    getLogin(id){
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
    }
    getDecodedAccessToken(result): any {
        try{
            superidComment = result.idPost;
            superidUser = result.idUser;
            superidPost = result.idPost;
            supercomment = result.comment;
            this.superdate = result.date;
            return result;
        }
        catch(Error){
            return null;
        }
      }
};