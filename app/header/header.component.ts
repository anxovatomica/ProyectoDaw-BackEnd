import { Component } from "@angular/core";

@Component({

    selector:'header-tag',
    templateUrl:'./header.component.html',
    styleUrls:['./header.component.css']    

})

export class HeaderComponent{
    header={
        title:"",
        words:""
    };

};