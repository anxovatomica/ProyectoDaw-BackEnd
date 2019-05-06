import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Observable, ObservableInput} from 'rxjs';
import {Usuario} from './usuario';
import { Login } from './login';


@Injectable({
    providedIn: 'root'
  })
  export class UsuarioService {
  
    constructor(private http:HttpClient) { }
    
    getUser(): Observable<any> { 
      let url = "http://plugwalk.alwaysdata.net/api/index.php"; 
      return this.http.get(
         url, { headers: new HttpHeaders({'Content-Type':'application/json'}) } 
         ); 
        }
  
    loginUser(user:Login):Observable<any>{
     //console.log("PETICIO LOGIN!");
      let url = "http://plugwalk.alwaysdata.net/api/myAPI.php"
      return this.http.post(url, user, this.generateHeaders()/*{headers:new HttpHeaders({ 'Content-Type':'application/json'})}*/);
    }
    
    generateHeaders() {
      //console.log("TOKEN????:"+localStorage.getItem("token"))
      if (localStorage.getItem("token") && localStorage.getItem("token")!="undefined") {
      return { 
        headers: new HttpHeaders({'Content-Type':'application/json'}) };
      } else { 
        return { headers: new HttpHeaders({ 'Content-Type':'application/json' }) }; }
     }

    

    /*
    generateHeaders() {
      if (localStorage.getItem("token") && localStorage.getItem("token")!="undefined") {
      return { headers: new HttpHeaders({ 'Content-Type': 'application/json',
      'Authorization': localStorage.getItem("token") }) };
      } else { return { headers: new HttpHeaders({ 'Content-Type': 'application/json' }) }; }
     }
    /* postDadesAjax(user:Usuario)> {
      return this.http.post("http://localhost/myAPI.php", this.user, new HttpHeaders({ 'Content-Type': 'application/json' }))};
    */
 /*   
      deleteProducte(product:Usuario):Observable<any>{
      let url = "/apiProductos.php/producto_delete/54"
      return this.http.post(
        url,product, {headers:new HttpHeaders({ 'Content-Type':'application/json'})  }
      );
    }
    */
  
  }
    
   