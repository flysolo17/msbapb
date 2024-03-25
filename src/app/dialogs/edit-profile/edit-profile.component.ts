import { Component, Input, OnInit, inject } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import {
  Administrator,
  AdministratorConverter,
} from 'src/app/models/Administrator';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-edit-profile',
  templateUrl: './edit-profile.component.html',
  styleUrls: ['./edit-profile.component.css'],
})
export class EditProfileComponent implements OnInit {
  activeModal = inject(NgbActiveModal);
  selectedPhoto$: File | null = null;
  adminForm$: FormGroup;
  @Input('administrator') administrator: Administrator | null = null;

  constructor(
    private fb: FormBuilder,
    private authService: AuthService,
    private toastr: ToastrService
  ) {
    this.adminForm$ = fb.group({
      photo: [null],
      name: ['', Validators.required],
      office: ['', Validators.required],
    });
  }

  ngOnInit(): void {
    console.log(this.administrator);
    this.adminForm$ = this.fb.group({
      photo: [null],
      name: [this.administrator?.name, Validators.required],
      office: [this.administrator?.office, Validators.required],
    });
  }

  onSubmit() {
    if (this.adminForm$.valid) {
      const formData = this.adminForm$.value;

      this.authService
        .updateProfile(
          this.administrator?.id ?? 0,
          this.selectedPhoto$,
          formData.name,
          formData.office
        )
        .subscribe({
          next: (data) => {
            if (data.status) {
              localStorage.setItem(
                'user',
                AdministratorConverter.toJson(data.data)
              );
              this.authService.setAdmin(
                AdministratorConverter.fromJson(data.data)
              );
              this.toastr.success(data.message);
              this.activeModal.close(true);
            } else {
              this.toastr.error(data.message);
            }
          },
          error: (err) => this.toastr.error(err['message'].toString()),
        });
    }
  }

  onFileSelected(event: any): void {
    const file: File = event.target.files[0];
    this.selectedPhoto$ = file;
  }
}
