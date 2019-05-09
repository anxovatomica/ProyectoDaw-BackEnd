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
export var superdate: string = '';
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
    public helloString: string="hello " + myGlobals.sep + " there";
    comment: Comment[] = [];
    id = user.superid;
    name = user.supername;
    surname = user.supersurname;
    username = user.supername;
    birthdate = user.superbirthdate;
    address = user.superaddress;
    email = user.superemail;
    password = user.superpass;
    foto = user.superphoto;
    ngOnInit(): void {
        this.getLogin(this.id);
    }
    getLogin(id){
        //console.log("GET LOGIN!")
        let comment = new Comment(user.superid);
        //console.log(usu);
        this.serviceProfile.getPost( comment ).subscribe((result) => {
            if(result.token !=null){
                console.log("Token OK");
                localStorage.setItem("token",result.token);
                console.log(result.token);
                 //redirect
                 this.getDecodedAccessToken(result.token);
                 console.log("Id Comment: " + superidComment);
                 console.log("id User: " + superidUser);
                 console.log("id post: " + superidPost);
                 console.log("comment: " + supercomment);
                 console.log("date: " + superdate);
                //this._router.navigate(['/profile']);
            }else{
                console.log("Comment FAIL");
            }
        } , (error) => {
            console.log(error);
        });
    }
    getDecodedAccessToken(token: string): any {
        try{
            var data = jwt_decode(token);
            superidComment = data.idComment;
            superidUser = data.idUser;
            superidPost = data.idPost;
            supercomment = data.comment;
            superdate = data.date;
            return data;
        }
        catch(Error){
            return null;
        }
      }
};