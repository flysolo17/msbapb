import { Component, inject } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { Administrator } from 'src/app/models/Administrator';
import { AuthService } from 'src/app/services/auth.service';
import { NewsService } from 'src/app/services/news.service';

@Component({
  selector: 'app-create-news',
  templateUrl: './create-news.component.html',
  styleUrls: ['./create-news.component.css'],
})
export class CreateNewsComponent {
  activeModal = inject(NgbActiveModal);

  newsForm$: FormGroup;
  selectedPhoto$: File | null = null;
  users$: Administrator | null = null;
  constructor(
    private fb: FormBuilder,
    private authService: AuthService,
    private newsService: NewsService,
    private toastr: ToastrService
  ) {
    authService.users$.subscribe((data) => {
      this.users$ = data;
    });
    this.newsForm$ = this.fb.group({
      photo: ['', Validators.required],
      title: ['', Validators.required],
      description: ['', Validators.required],
      link: ['', Validators.required],
    });
  }

  onFileSelected(event: any): void {
    const file: File = event.target.files[0];
    this.selectedPhoto$ = file;
  }
  onSubmit() {
    const formData = this.newsForm$.value;
    console.log(formData);
    if (this.selectedPhoto$ !== null && this.newsForm$.valid) {
      this.newsService
        .createNews(
          this.selectedPhoto$,
          formData.title,
          formData.description,
          formData.link,
          this.users$?.type ?? 0
        )
        .subscribe({
          next: (data) => {
            if (data.status) {
              this.toastr.success(data.message.toString());
              this.activeModal.close(true);
            } else {
              this.toastr.error(data.message.toString());
            }
          },
          error: (err) => {
            this.toastr.error(err['message'].toString());
          },
        });
    } else {
      this.toastr.warning('Invalid form data');
    }
  }
}
