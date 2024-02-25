import { Component, inject } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { LoginComponent } from 'src/app/dialogs/login/login.component';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-main',
  templateUrl: './main.component.html',
  styleUrls: ['./main.component.css'],
})
export class MainComponent {
  private modalService$ = inject(NgbModal);
  constructor(private authService: AuthService) {}

  login() {
    this.modalService$.open(LoginComponent);
  }
}
