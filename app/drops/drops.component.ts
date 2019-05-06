import { Component, OnInit } from "@angular/core";
import { Injectable } from '@angular/core';

import { Observable, ObservableInput } from 'rxjs';
import { Drop } from './drop';
import { DropService } from "./drop.service";

@Component({

    selector:'drops-tag',
    templateUrl:'./drops.component.html',
    styleUrls:['./drops.component.css'],   
    providers: [DropService] 

})

export class DropsComponent implements OnInit{
    drops: Drop[] = [];
    nuevoDrop: Drop = new Drop(null, "", "", "", new Date(),null);
    productes = "";
    
  
    
    constructor(private serviceDrop: DropService) { }

    ngOnInit(): void {
        this.getDrop();
    }

    enviaFormulari() {
        this.serviceDrop.postDrop(this.nuevoDrop).
          subscribe(
            (result) => {
              console.log("----")
              this.drops = result["resposta"];
    
              console.log(this.drops);
            },
            (error) => { console.log(error) }
          );
    
      }
      getDrop() {
        this.serviceDrop.getDrop().subscribe(
          (result) => {
            console.log(result["data"]);
            this.drops = result["data"];
    
          },
          (error) => {
            console.log(error);
          });
      }
      
    

    news={
        title:"",
        words:""
    };

};