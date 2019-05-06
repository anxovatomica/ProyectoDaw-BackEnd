import { Component } from "@angular/core";

@Component({

    selector:'released-tag',
    templateUrl:'./released.component.html',
    styleUrls:['./released.component.css']    

})

export class ReleasedComponent{
    released={
        title:"",
        words:""
    };

};