import { Component, Input, OnInit, inject } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { Toast, ToastrService } from 'ngx-toastr';
import { ResponseData } from 'src/app/models/ResponseData';
import { PersonelsService } from 'src/app/services/personels.service';

export interface SelectedPosition {
  name: string;
  personelType: 1 | 2;
}

export const POSTIONS: SelectedPosition[] = [
  { name: 'PAT', personelType: 2 },
  { name: 'PO1', personelType: 2 },
  { name: 'PO2', personelType: 2 },
  { name: 'PO3', personelType: 2 },
  { name: 'SPO1', personelType: 2 },
  { name: 'SPO2', personelType: 2 },
  { name: 'SPO3', personelType: 2 },
  { name: 'SPO4', personelType: 2 },
  { name: 'PLTGEN', personelType: 2 },
  { name: 'PMAJ', personelType: 2 },
  { name: 'P/CAPT', personelType: 2 },
  { name: 'P/COL', personelType: 2 },
  { name: 'P/INSP', personelType: 2 },
  { name: 'PS/SUPT', personelType: 2 },

  { name: 'SF01', personelType: 1 },
  { name: 'SFO3', personelType: 1 },
  { name: 'FO1', personelType: 1 },
  { name: 'FO2', personelType: 1 },
  { name: 'FO3', personelType: 1 },
]; // 1 is BFP 2 is PNP

@Component({
  selector: 'app-create-personel',
  templateUrl: './create-personel.component.html',
  styleUrls: ['./create-personel.component.css'],
})
export class CreatePersonelComponent implements OnInit {
  activeModal = inject(NgbActiveModal);
  selectedPhoto$: File | null = null;
  personnelForm$: FormGroup;

  @Input('type') type: number | null = null;

  position$: SelectedPosition[] = [];

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

  ngOnInit(): void {
    //filter only the position based on the administrator Type
    // Should only return PNP positions when admin is PNP
    // Should only return BFP positions when admin is BFP
    this.position$ = POSTIONS.filter((e) => e.personelType === this.type);
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
