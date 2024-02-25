import { Component, inject } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { CreatePersonelComponent } from 'src/app/dialogs/create-personel/create-personel.component';
import { Administrator } from 'src/app/models/Administrator';
import { Personels } from 'src/app/models/Personels';
import { AuthService } from 'src/app/services/auth.service';
import { PersonelsService } from 'src/app/services/personels.service';

@Component({
  selector: 'app-personels',
  templateUrl: './personels.component.html',
  styleUrls: ['./personels.component.css'],
})
export class PersonelsComponent {
  administrator$: Administrator | null = null;
  personels$: Personels[] = [];
  private modalService$ = inject(NgbModal);
  constructor(
    private authService: AuthService,
    private personelService: PersonelsService,
    private toastr: ToastrService
  ) {
    authService.users$.subscribe((data) => {
      this.administrator$ = data;
    });
    personelService.personels$.subscribe((data) => {
      this.personels$ = data;
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

  createPersonel() {
    const modalRef = this.modalService$.open(CreatePersonelComponent);
    modalRef.componentInstance.type = this.administrator$?.type;
  }
  refresh() {
    this.personelService.getAllPersonels().subscribe((data) => {
      let userType = this.administrator$?.type === 2 ? 'PNP' : 'BFP';
      this.personelService.setPersonels(
        data.filter((e) => e.type === userType)
      );
    });
  }
}
