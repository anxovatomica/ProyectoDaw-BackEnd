import { Component } from "@angular/core";

@Component({

    selector:'proxy-tag',
    templateUrl:'./proxy.component.html',
    styleUrls:['./proxy.component.css']    

})

export class ProxyComponent{
    proxy={
        title:"",
        words:""
    };
    ngOnInit(){
        
    }
    
};