import { Component, Input, OnInit, inject } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { Barangay } from 'src/app/models/Barangay';
import { BarangayService } from 'src/app/services/barangay.service';

@Component({
  selector: 'app-update-barangay',
  templateUrl: './update-barangay.component.html',
  styleUrls: ['./update-barangay.component.css'],
})
export class UpdateBarangayComponent implements OnInit {
  @Input('barangay') barangay!: Barangay;
  activeModal = inject(NgbActiveModal);
  barangayForm$!: FormGroup;
  constructor(
    private fb: FormBuilder,
    private barangayService: BarangayService,
    private toastr: ToastrService
  ) {}
  ngOnInit(): void {
    this.barangayForm$ = this.fb.group({
      barangay: [this.barangay.barangay, Validators.required],
      hotline: [this.barangay.hotline, Validators.required],
    });
  }

  onSubmit() {
    let barangay: string = this.barangayForm$.get('barangay')?.value ?? '';
    let hotline: string = this.barangayForm$.get('hotline')?.value ?? '';
    this.updateBarangay(this.barangay.id, barangay, hotline);
  }

  updateBarangay(id: number, barangay: string, hotline: string) {
    this.barangayService.updateBarangay(id, barangay, hotline).subscribe({
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
