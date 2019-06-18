import { FormBuilder, FormGroup } from '@angular/forms';
import { UploadService } from './upload.service';
import { Component, OnInit } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import * as user from 'src/app/login/login.component';
import { Router } from '@angular/router';
@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class TestProfileComponent implements OnInit {
  constructor(private formBuilder: FormBuilder, private uploadService: UploadService, private _router: Router) { }
  form: FormGroup;
  error: string;
  userId = 1;
  username1 = user.superemail;
  uploadResponse = { status: '', message: '', filePath: '' };
  ngOnInit() {
    this.form = this.formBuilder.group({
      avatar: ['']
    });
  }
  onFileChange(event) {
    if (event.target.files.length > 0) {
      const file = event.target.files[0];
      this.form.get('avatar').setValue(file);
    }
  }
  delete() {
    this.uploadService.delete();
  }


  onSubmit() {
    const formData = new FormData();
    formData.append('file', this.form.get('avatar').value, user.superemail + '.jpg');
    localStorage.setItem(user.superemail + '.jpg', this.form.get('avatar').value);
    this.uploadService.upload(formData, this.userId).subscribe(
      (res) => this.uploadResponse = res,
      (err) => this.error = err
    );
    alert('Image uploaded!');
    this._router.navigate(['/profile']);
  }
}
