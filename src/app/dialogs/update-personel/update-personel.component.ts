import { Component, Input, OnInit, inject } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { Personels } from 'src/app/models/Personels';
import { ResponseData } from 'src/app/models/ResponseData';
import { PersonelsService } from 'src/app/services/personels.service';

@Component({
  selector: 'app-update-personel',
  templateUrl: './update-personel.component.html',
  styleUrls: ['./update-personel.component.css'],
})
export class UpdatePersonelComponent implements OnInit {
  activeModal = inject(NgbActiveModal);
  selectedPhoto$: File | null = null;
  personnelForm$: FormGroup;
  @Input('personel') personel!: Personels;
  constructor(
    private fb: FormBuilder,
    private personelService: PersonelsService,
    private toastr: ToastrService
  ) {
    this.personnelForm$ = this.fb.group({
      name: ['', Validators.required],
      position: ['', Validators.required],
      contact: ['', Validators.required],
    });
  }
  ngOnInit(): void {
    this.personnelForm$ = this.fb.group({
      name: [this.personel.name, Validators.required],
      position: [this.personel.position, Validators.required],
      contact: [this.personel.contact, Validators.required],
    });
  }

  onSubmit(): void {
    if (this.personnelForm$.valid) {
      const formData = this.personnelForm$.value;
      this.personelService
        .updatePersonel(
          this.personel.id,
          this.selectedPhoto$,
          formData.name,
          formData.position,
          formData.contact
        )
        .subscribe({
          next: (data: ResponseData<null>) => {
            if (data.status) {
              this.toastr.success(data.message);
              this.activeModal.close(true);
            } else {
              this.toastr.error(data.message);
            }
          },
          error: (error: any) => {
            this.toastr.error(error['message'].toString());
          },
          complete: () => {},
        });
   
    }
  }

  onFileSelected(event: any): void {
    const file: File = event.target.files[0];
    this.selectedPhoto$ = file;
  }
}
