import { Component, inject } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { BarangayService } from 'src/app/services/barangay.service';

@Component({
  selector: 'app-create-barangay',
  templateUrl: './create-barangay.component.html',
  styleUrls: ['./create-barangay.component.css'],
})
export class CreateBarangayComponent {
  activeModal = inject(NgbActiveModal);
  barangayForm$: FormGroup;
  constructor(
    private fb: FormBuilder,
    private barangayService: BarangayService,
    private toastr: ToastrService
  ) {
    this.barangayForm$ = this.fb.group({
      barangay: ['', Validators.required],
      hotline: ['', Validators.required],
    });
  }

  onSubmit() {
    let barangay: string = this.barangayForm$.get('barangay')?.value ?? '';
    let hotline: string = this.barangayForm$.get('hotline')?.value ?? '';
    this.saveBarangay(barangay, hotline);
  }

  saveBarangay(barangay: string, hotline: string) {
    this.barangayService.createBarangay(barangay, hotline).subscribe({
      next: (value) => {
        if (value.status) {
          this.toastr.success(value.message);
        } else {
          this.toastr.error(value.message);
        }
        this.activeModal.close(value.status);
      },
      error: (err) => {
        this.toastr.error(err['message']);
      },
    });
  }
}
