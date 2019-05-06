import { Component, OnInit } from "@angular/core";
import { ProfileService } from "./profile.service";
import { Profile } from "./profile";
import * as myGlobals from 'src/app/globals';

@Component({

    selector:'profile-tag',
    templateUrl:'./profile.component.html',
    styleUrls:['./profile.component.css'],
    providers:[ProfileService]

})

export class ProfileComponent  {
    profile: Profile[] = [];

    constructor(private serviceNews: ProfileService) { }
    public helloString: string="hello " + myGlobals.sep + " there";
    ngOnInit(): void {

        
      }
};