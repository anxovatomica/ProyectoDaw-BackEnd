import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

export class ImageService {

    constructor(private http: HttpClient) {}
  
  
    public uploadImage(image: File): Observable<Object> {
      const formData = new FormData();
  
      formData.append('image', image);
  
      return this.http.post('/img/', formData);
    }
    postProducte(image: File):Observable<any>{
      let url = "http://plugwalk.alwaysdata.net/api/commentAPI.php"
      return this.http.post(
        url,image, {headers:new HttpHeaders({ 'Content-Type':'application/json'})  }
      );
    }
  }