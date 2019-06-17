import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpEvent, HttpErrorResponse, HttpEventType } from '@angular/common/http';
import { Observable, ObservableInput } from 'rxjs';
import { Profile } from './profile';
import { Comment } from './Comment';
import { map } from 'rxjs/operators';


@Injectable({
  providedIn: 'root'
})
export class ProfileService {
  constructor(private http: HttpClient) { }
  SERVER_URL = 'http://localhost:3000';

  public uploadImage(image): Observable <any> {
    const formData = new FormData();
    formData.append('image', image);
    return this.http.post('http://plugwalk.alwaysdata.net/img/', formData);
  }

  getPost(comment: Comment): Observable<any> {
    // console.log('PETICIO LOGIN!');
    const url = 'http://plugwalk.alwaysdata.net/api/commentAPI.php';
    return this.http.post(url, comment, this.generateHeaders()/*{headers:new HttpHeaders({ 'Content-Type':'application/json'})}*/);
  }
  logOut(logout: Boolean): Observable<any> {
    // console.log('PETICIO LOGIN!');
    const url = 'http://plugwalk.alwaysdata.net/api/myAPI.php';
    return this.http.post(url, logout, this.generateHeaders()/*{headers:new HttpHeaders({ 'Content-Type':'application/json'})}*/);
  }
  generateHeaders() {
    if (localStorage.getItem('token') && localStorage.getItem('token') !== 'undefined') {
      return {
        headers: new HttpHeaders({ 'Content-Type': 'application/json' })
      };
    } else {
      return { headers: new HttpHeaders({ 'Content-Type': 'application/json' }) };
    }
  }
  /*
getPost(): Observable<any> {
  let url = 'http://plugwalk.alwaysdata.net/api/indexComment.php';
  return this.http.get(
     url, { headers: new HttpHeaders({'Content-Type':'application/json'}) }
     );
    }*/

}
