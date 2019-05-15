import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Observable, ObservableInput} from 'rxjs';
import { Profile } from './profile';
import { Comment } from "./Comment";



@Injectable({
    providedIn: 'root'
  })
  export class ProfileService {
    constructor(private http:HttpClient) { }
    getPost(comment:Comment):Observable<any>{
      //console.log("PETICIO LOGIN!");
       let url = "http://plugwalk.alwaysdata.net/api/commentAPI.php"
       return this.http.post(url, comment, this.generateHeaders()/*{headers:new HttpHeaders({ 'Content-Type':'application/json'})}*/);
     }
     logOut(logout:Boolean):Observable<any>{
      //console.log("PETICIO LOGIN!");
       let url = "http://plugwalk.alwaysdata.net/api/myAPI.php"
       return this.http.post(url, logout, this.generateHeaders()/*{headers:new HttpHeaders({ 'Content-Type':'application/json'})}*/);
     }
     generateHeaders() {
       if (localStorage.getItem("token") && localStorage.getItem("token")!="undefined") {
       return { 
         headers: new HttpHeaders({'Content-Type':'application/json'}) };
       } else { 
         return { headers: new HttpHeaders({ 'Content-Type':'application/json' }) }; }
      }
      /*
    getPost(): Observable<any> { 
      let url = "http://plugwalk.alwaysdata.net/api/indexComment.php"; 
      return this.http.get(
         url, { headers: new HttpHeaders({'Content-Type':'application/json'}) } 
         ); 
        }*/
  
  }
  
