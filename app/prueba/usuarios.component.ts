import { Component, OnInit } from "@angular/core";
import { Injectable } from '@angular/core';

import { Observable, ObservableInput } from 'rxjs';
import { Usuario } from './usuario';
import { UsuarioService } from "./usuario.service";
@Component({

  selector: 'usuarios-tag',
  templateUrl: './usuarios.component.html',
  styleUrls: ['./usuarios.component.css'],
  providers: [UsuarioService]

})

export class UsuariosComponent implements OnInit {
  usuarios: Usuario[] = [];
  nuevoUsuario: Usuario = new Usuario(null, "",
    "birthdate:Date", new Date(), "", "");
  mensajeErrorPrecio = "";
  productes = "";

  
  constructor(private serviceUser: UsuarioService) { }

  ngOnInit(): void {

    //this.getProducte();
  }
  enviaFormulari() {
    this.serviceUser.postProducte(this.nuevoUsuario).
      subscribe(
        (result) => {
          console.log("----")
          this.usuarios = result["resposta"];

          console.log(this.usuarios);
        },
        (error) => { console.log(error) }
      );

  }
  getProducte() {
    this.serviceUser.getProducte().subscribe(
      (result) => {
        console.log(result["message"]);
        this.usuarios = result["message"];

      },
      (error) => {
        console.log(error);
      });
  }

  home = {
    title: "",
    words: ""
  };




};
/*
export class UsuarioService {
  
    constructor(private http:HttpClient) { }
    
    getProducte(): Observable<any> { 
      let url = "plugwalk.alwaysdata.net"; 
      return this.http.get(
         url, { headers: new HttpHeaders({ 'Content-Type':'application/json'}) } 
         ); 
        }
  
  
    postProducte(product:Usuario):Observable<any>{
      let url = "/apiProductos.php/producto/"
      return this.http.post(
        url,product, {headers:new HttpHeaders({ 'Content-Type':'application/json'})  }
      );
    }
  
    
    deleteProducte(product:Usuario):Observable<any>{
      let url = "/apiProductos.php/producto_delete/54"
      return this.http.post(
        url,product, {headers:new HttpHeaders({ 'Content-Type':'application/json'})  }
      );
    }
  
  }
*/