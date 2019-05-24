import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

export class ImageService {

    constructor(private http: HttpClient) {}
  
  
    public uploadImage(image: File): Observable<Object> {
      const formData = new FormData();
  
      formData.append('image', image);
  
      return this.http.post('/api/v1/image-upload', formData);
    }
  }