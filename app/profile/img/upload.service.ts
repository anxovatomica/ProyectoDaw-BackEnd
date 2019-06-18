import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpEvent, HttpErrorResponse, HttpEventType } from '@angular/common/http';
import { Observable, ObservableInput } from 'rxjs';
import { map } from 'rxjs/operators';


@Injectable({
  providedIn: 'root'
})

export class UploadService {

  SERVER_URL = 'http://plugwalk.alwaysdata.net';
  constructor(private httpClient: HttpClient) { }

  public upload(data, userId) {
    const uploadURL = `${this.SERVER_URL}/img/index.php`;
    return this.httpClient.post<any>(uploadURL, data, {
      reportProgress: true,
      observe: 'events',

    }).pipe(map((event) => {

      switch (event.type) {

        case HttpEventType.UploadProgress:
          const progress = Math.round(100 * event.loaded / event.total);
          return { status: 'progress', message: progress };

        case HttpEventType.Response:
          return event.body;
        default:
          return `Unhandled event: ${event.type}`;
      }
    }, this.generateHeaders())
    );
  }
  public delete() {
    const avatar = localStorage.getItem('avatar');
    if (avatar !== null) {
      const uploadURL = `${this.SERVER_URL}/img/uploads/`;
    return this.httpClient.delete <any>('http://plugwalk.alwaysdata.net/img/' + avatar + '.jpg');
    }
  }
  generateHeaders() {
    // console.log('TOKEN????:'+localStorage.getItem('token'))
    if (localStorage.getItem('token') && localStorage.getItem('token') !== 'undefined') {
    return {
      headers: new HttpHeaders({'Content-Type': 'application/json'}) };
    } else {
      return { headers: new HttpHeaders({ 'Content-Type': 'application/json' }) }; }
   }

}
