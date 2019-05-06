import { Component } from "@angular/core";
import { Usuario } from './usuario';
import { UsuarioService } from './usuario.service';


@Component({

    selector:'register-tag',
    templateUrl:'./register.component.html',
    styleUrls:['./register.component.css'],
    providers: [UsuarioService]  

})

export class RegisterComponent{
    usuarios: Usuario[] = [];
  nuevoUsuario: Usuario = new Usuario(null, "",
    "", new Date(), "", "","");
  
  constructor(private serviceUser: UsuarioService) { }

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

};