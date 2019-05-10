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
    a = new Date('2019-04-03 00:00:00');
  nuevoUsuario: Usuario = new Usuario(null, "",
    "", this.a, "", "","");
  
  constructor(private serviceUser: UsuarioService) { }

  enviaFormulari() {
    this.serviceUser.postProducte(this.nuevoUsuario).
      subscribe(
        (result) => {
          console.log("----");
          console.log(result);
          this.usuarios = result["resposta"];

          console.log(this.usuarios);
        },
        (error) => { console.log(error) }
      );

  }

};