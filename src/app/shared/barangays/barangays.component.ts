import { Component, inject } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { CreateBarangayComponent } from 'src/app/dialogs/create-barangay/create-barangay.component';
import { UpdateBarangayComponent } from 'src/app/dialogs/update-barangay/update-barangay.component';
import { Barangay } from 'src/app/models/Barangay';
import { BarangayService } from 'src/app/services/barangay.service';

@Component({
  selector: 'app-barangays',
  templateUrl: './barangays.component.html',
  styleUrls: ['./barangays.component.css'],
})
export class BarangaysComponent {
  private modalService$ = inject(NgbModal);
  searching: string = '';
  barangays$: Barangay[] = [];
  filteredBarangays$: Barangay[] = [];
  constructor(
    private barangayService: BarangayService,
    private toastr: ToastrService
  ) {
    this.refresh();
  }

  refresh() {
    this.barangayService.getAllBarangay().subscribe((data) => {
      this.barangays$ = data.data;
      this.filteredBarangays$ = this.barangays$;
    });
  }
  filterBarangays() {
    this.filteredBarangays$ = this.barangays$.filter((barangay) =>
      barangay.barangay.toLowerCase().includes(this.searching.toLowerCase())
    );
  }

  createBarangay() {
    const modalRef = this.modalService$.open(CreateBarangayComponent);
    modalRef.result.then((data) => {
      if (data === true) {
        this.refresh();
      } else {
        this.toastr.warning('add barangay cancelled');
      }
    });
  }

  updateBarangay(barangay: Barangay) {
    const modalRef = this.modalService$.open(UpdateBarangayComponent);
    modalRef.componentInstance.barangay = barangay;
    modalRef.result.then((data) => {
      if (data === true) {
        this.refresh();
      } else {
        this.toastr.warning('Update barangay cancelled');
      }
    });
  }
  deleteBarangay(id: number) {
    this.barangayService.deleteBarangay(id).subscribe({
      next: (data) => {
        if (data.status) {
          this.toastr.success(data.message);
          this.refresh();
        } else {
          this.toastr.error(data.message);
        }
      },
      error: (err) => {
        this.toastr.error(err.message);
      },
    });
  }

  copyToClipboard(text: string) {
    let selBox = document.createElement('textarea');
    selBox.style.position = 'fixed';
    selBox.style.left = '0';
    selBox.style.top = '0';
    selBox.style.opacity = '0';
    selBox.value = text;
    document.body.appendChild(selBox);
    selBox.focus();
    selBox.select();
    document.execCommand('copy');
    document.body.removeChild(selBox);

    this.toastr.success('Copy to clipboard!');
  }
}
