import { Component, Input, inject } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { Toast, ToastrService } from 'ngx-toastr';
import { ResponseData } from 'src/app/models/ResponseData';
import { PersonelsService } from 'src/app/services/personels.service';

@Component({
  selector: 'app-create-personel',
  templateUrl: './create-personel.component.html',
  styleUrls: ['./create-personel.component.css'],
})
export class CreatePersonelComponent {
  activeModal = inject(NgbActiveModal);
  selectedPhoto$: File | null = null;
  personnelForm$: FormGroup;
  @Input('type') type: number | null = null;
  constructor(
    private fb: FormBuilder,
    private personelService: PersonelsService,
    private toastr: ToastrService
  ) {
    this.personnelForm$ = this.fb.group({
      photo: [null, Validators.required],
      name: ['', Validators.required],
      position: ['', Validators.required],
      contact: ['', Validators.required],
    });
  }

  onSubmit(): void {
    if (this.type === null) {
      this.toastr.error('No user found!');
      return;
    }
    if (this.selectedPhoto$ === null) {
      this.toastr.error('Please add photo!');
      return;
    }
    if (this.personnelForm$.valid) {
      const formData = this.personnelForm$.value;
      this.personelService
        .createPersonel(
          this.selectedPhoto$,
          formData.name,
          formData.position,
          this.type,
          formData.contact
        )
        .subscribe({
          next: (data: ResponseData<null>) => {
            this.toastr.success(data.message);
          },
          error: (error: any) => {
            this.toastr.error(error.toString());
          },
          complete: () => {
            this.activeModal.close();
          },
        });
      this.personnelForm$.markAllAsTouched();
    }
  }

  onFileSelected(event: any): void {
    const file: File = event.target.files[0];
    this.selectedPhoto$ = file;
  }
}
