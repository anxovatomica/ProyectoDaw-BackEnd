import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Observable, ObservableInput} from 'rxjs';
import {Post} from './post';



@Injectable({
    providedIn: 'root'
  })
  export class PostService {
  
    constructor(private http:HttpClient) { }
    getNews(): Observable<any> { 
      let url = "/api/indexPost.php"; 
      return this.http.get(
         url, { headers: new HttpHeaders({ 'Content-Type':'application/json'}) } 
         ); 
        }
  
  
    postNew(newpost:Post):Observable<any>{
      let url = "/api/indexPost.php"
      return this.http.post(
        url,newpost, {headers:new HttpHeaders({ 'Content-Type':'application/json'})  }
      );
    }
  
  }
  
