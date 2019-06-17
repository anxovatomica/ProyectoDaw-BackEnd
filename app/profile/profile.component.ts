import { Component, OnInit } from '@angular/core';
import { ProfileService } from './profile.service';
import { Profile } from './profile';
import * as user from 'src/app/login/login.component';
// import { getAllDebugNodes } from '@angular/core/src/debug/debug_node';
import { Comment } from './Comment';
import { HttpClient, HttpHeaders, HttpEvent, HttpErrorResponse, HttpEventType } from '@angular/common/http';

import { Router, ActivatedRoute, Params } from '@angular/router'; 
import { map } from 'rxjs/operators';
import { FormGroup } from '@angular/forms';

export var superidComment: string = '';
export var superidUser: string = '';
export var superidPost: string = '';
export var supercomment: string = '';
// export var superdate: string = '';

@Component({

    selector: 'profile-tag',
    templateUrl: './profile.component.html',
    styleUrls: ['./profile.component.css'],
    providers: [ProfileService]

})

export class ProfileComponent  {
    profile: Profile[] = [];
    url = '';
    form: FormGroup;
    error: string;
    //userId = 1;
    uploadResponse = { status: '', message: '', filePath: '' };
    public upload(data) {

        const uploadURL = `http://plugwalk.alwaysdata.net/img/`;

        return this.http.post<any>(uploadURL, data, {
          reportProgress: true,
          observe: 'events'
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
        })
        );
      }
    onSelectFile(event) {
    if (event.target.files && event.target.files[0]) {
      const reader = new FileReader();

      reader.readAsDataURL(event.target.files[0]); // read file as data url

      // tslint:disable-next-line:no-shadowed-variable
      reader.onload = (event) => { // called once readAsDataURL is completed
        //this.url = event.target.result;
        this.serviceProfile.uploadImage(event);
      };

    }
  }

  onFileChange(event) {

    if (event.target.files.length > 0) {
      const file = event.target.files[0];
      this.form.get('avatar').setValue(file);
    }
  }

  onSubmit() {
    const formData = new FormData();
    formData.append('file', this.form.get('avatar').value);

    /*this.uploadService.upload(formData).subscribe(
      (res) => this.uploadResponse = res,
      (err) => this.error = err
    );*/
  }
  public delete() {
    this.url = null;
  }
    //foto: string;
    constructor(private http: HttpClient, private serviceProfile: ProfileService,private _router: Router,
        private _activRoute: ActivatedRoute) { }
    // comment: Comment[] = [];
        // tslint:disable-next-line:member-ordering
        superdate = '';
        // tslint:disable-next-line:member-ordering
        id;
        // tslint:disable-next-line:member-ordering
        name;
        // tslint:disable-next-line:member-ordering
        surname;
        // tslint:disable-next-line:member-ordering
        birthdate;
        // tslint:disable-next-line:member-ordering
        username;
        // tslint:disable-next-line:member-ordering
        address;
        email;
        password;
        foto;
        date;
        logout = false;

    // tslint:disable-next-line:use-life-cycle-interface
    ngOnInit(): void {
        // tslint:disable-next-line:prefer-const
        var a =  localStorage.getItem('token');
        console.log('toKen: ' + a);
        if (a == null) {
            console.log('toKen1: '+ a);
            this.id = '';
            this.name = '';
            this.surname = '';
            this.username = '';
            this.birthdate = '';
            this.address = '';
            this.email = '';
            this.password = '';
            this.foto = '';
            this.date = '';

        } else if (a != null) {
            console.log('toKen2: ' + a);
            this.id = user.superid;
            this.name = user.supername;
            this.surname = user.supersurname;
            this.username = user.supername;
            this.birthdate = user.superbirthdate;
            this.address = user.superaddress;
            this.email = user.superemail;
            this.password = user.superpass;
            this.foto = user.superphoto;
            this.date = this.superdate;
        }

    }
    logOut() {
       console.log('log Out');
       console.log('token in: ' + localStorage.getItem('token'));
            localStorage.removeItem('token');
            console.log('token out: ' + localStorage.getItem('token'));
            this.id = '';
            this.name = '';
            this.surname = '';
            this.username = '';
            this.birthdate = '';
            this.address = '';
            this.email = '';
            this.password = '';
            this.foto = '';
            this.date = '';
            this._router.navigate(['/login']);
        /*let logout:boolean = true;
        //console.log(usu);
        this.serviceProfile.logOut( logout ).subscribe((result) => {

                console.log('Token OK');
                localStorage.setItem('token',result);
                console.log(result);
                 //redirect
                 this.getDecodedAccessToken(result);
                //this._router.navigate(['/profile']);

        } , (error) => {
            console.log(error);
        });*/
    }
    /*getLogin(id){
        //console.log('GET LOGIN!')
        let comment = new Comment(user.superid);
        //console.log(usu);
        this.serviceProfile.getPost( comment ).subscribe((result) => {

                console.log('Token OK');
                localStorage.setItem('token',result);
                console.log(result);
                 //redirect
                 this.getDecodedAccessToken(result);
                 console.log('Id Comment: ' + superidComment);
                 console.log('id User: ' + superidUser);
                 console.log('id post: ' + superidPost);
                 console.log('comment: ' + supercomment);
                 console.log('date: ' + this.superdate);
                //this._router.navigate(['/profile']);

        } , (error) => {
            console.log(error);
        });
    }*/
}
