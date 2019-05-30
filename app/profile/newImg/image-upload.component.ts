import { Component, OnInit } from "@angular/core";
import { HttpClient, HttpHeaders, HttpEventType } from '@angular/common/http';
import { getAllDebugNodes } from "@angular/core/src/debug/debug_node";
import * as image from "src/app/profile/newImg/image.service";
import { Router, ActivatedRoute, Params } from '@angular/router'; 
import * as jwt_decode from "jwt-decode";
import { Observable } from "rxjs";
'use strict';

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
 
  fileData: File = null;
constructor(private http: HttpClient) { }
 
fileProgress(fileInput: any) {
    this.fileData = <File>fileInput.target.files[0];
}
 
onSubmit() {
  var a = document.getElementsByName("image");
  console.log(a.item);
    const formData = new FormData();
    formData.append('file', a);
    this.http.post('http://plugwalk.alwaysdata.net/img/index.php', formData, {
      reportProgress: true,
      observe: 'events'   
  })
  .subscribe(events => {
      if(events.type == HttpEventType.UploadProgress) {
          console.log('Upload progress: ', Math.round(events.loaded / events.total * 100) + '%');
      } else if(events.type === HttpEventType.Response) {
          console.log(events);
      }
  })
}
generateHeaders() {
  
    return { headers: new HttpHeaders({ 'Content-Type':'application/json' }) }; }
 }
