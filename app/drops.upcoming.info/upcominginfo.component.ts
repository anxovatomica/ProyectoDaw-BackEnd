import { Component, OnInit} from "@angular/core";

import { Observable, ObservableInput } from 'rxjs';
import { Drop } from '../drops/drop';
import { DropService } from "../drops/drop.service";

@Component({

    selector:'upcominginfo-tag',
    templateUrl:'./upcominginfo.component.html',
    styleUrls:['./upcominginfo.component.css'],
    providers : [DropService]    

})

export class UpcominginfoComponent implements OnInit{
    drops: Drop[] = [];
    nuevoDrop: Drop = new Drop(null, "", "", "", new Date(),null);

    constructor(private serviceDrop: DropService) { }

    ngOnInit(): void {
        this.getDrop();
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






    upcominginfo={
        title:"",
        words:""
    };

};