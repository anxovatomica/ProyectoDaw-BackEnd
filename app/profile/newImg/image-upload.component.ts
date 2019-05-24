import { Component, OnInit } from "@angular/core";
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { getAllDebugNodes } from "@angular/core/src/debug/debug_node";
import * as image from "src/app/profile/newImg/image.service";
import { Router, ActivatedRoute, Params } from '@angular/router'; 
import * as jwt_decode from "jwt-decode";

export class ProfileComponent  {
   
};
class ImageSnippet {
  pending: boolean = false;
  status: string = 'init';

  constructor(public src: string, public file: File) {}
}

@Component({
  selector: 'image-upload',
  templateUrl: 'image-upload.component.html',
  styleUrls: ['image-upload.component.scss']
})

export class ImageUploadComponent {

  selectedFile: File
  http: HttpClient;

  onFileChanged(event) {
    this.selectedFile = event.target.files[0]
  }

  onUpload() {
    this.http.post('my-backend.com/file-upload', this.selectedFile, {
      reportProgress: true,
      observe: 'events'
    })
      .subscribe(event => {
        console.log(event); // handle event here
      });
  }
}