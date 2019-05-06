import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Observable, ObservableInput} from 'rxjs';
import {Usuario} from './usuario';



@Injectable({
    providedIn: 'root'
  })
  export class UsuarioService {
  
    constructor(private http:HttpClient) { }
    getProducte(): Observable<any> { 
      let url = "/api/index.php"; 
      return this.http.get(
         url, { headers: new HttpHeaders({ 'Content-Type':'application/json'}) } 
         ); 
        }
  
  
    postProducte(product:Usuario):Observable<any>{
      let url = "/api/index.php"
      return this.http.post(
        url,product, {headers:new HttpHeaders({ 'Content-Type':'application/json'})  }
      );
    }
  
    
 /*   deleteProducte(product:Usuario):Observable<any>{
      let url = "/apiProductos.php/producto_delete/54"
      return this.http.post(
        url,product, {headers:new HttpHeaders({ 'Content-Type':'application/json'})  }
      );
    }*/
  
  }