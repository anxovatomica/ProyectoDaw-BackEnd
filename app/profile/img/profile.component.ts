import { FormBuilder, FormGroup } from '@angular/forms';
import { UploadService } from './upload.service';
import { Component, OnInit } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class TestProfileComponent implements OnInit {
  constructor(private formBuilder: FormBuilder, private uploadService: UploadService) { }
  form: FormGroup;
  error: string;
  userId = 1;
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
  onSubmit() {
    const formData = new FormData();
    formData.append('file', this.form.get('avatar').value);

    this.uploadService.upload(formData, this.userId).subscribe(
      (res) => this.uploadResponse = res,
      (err) => this.error = err
    );
  }
}
