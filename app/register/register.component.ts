import { Component } from "@angular/core";
import { Usuario } from './usuario';
import { UsuarioService } from './usuario.service';
import { Router, ActivatedRoute, Params } from '@angular/router'; 


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
  
  constructor(private serviceUser: UsuarioService, private _router: Router,
    private _activRoute: ActivatedRoute) { }

  enviaFormulari() {
    
    .0
    this.serviceUser.postProducte(this.nuevoUsuario).
      subscribe(
        (result) => {
          console.log("----")
          console.log(result);
          alert("Registro con éxito\nSerás redirigido a Login");
          this._router.navigate(['/login']);
        },
        (error) => { console.log(error) }
      );

  }

};