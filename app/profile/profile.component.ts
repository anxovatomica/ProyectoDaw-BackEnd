import { Component, OnInit } from "@angular/core";
import { ProfileService } from "./profile.service";
import { Profile } from "./profile";


@Component({

    selector:'profile-tag',
    templateUrl:'./profile.component.html',
    styleUrls:['./profile.component.css'],
    providers:[ProfileService]

})

export class ProfileComponent  {
    profile: Profile[] = [];

    constructor(private serviceNews: ProfileService) { }

    ngOnInit(): void {

        
      }
};