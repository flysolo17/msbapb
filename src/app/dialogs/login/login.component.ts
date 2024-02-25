import { Component, Input, inject } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
})
export class LoginComponent {
  activeModal = inject(NgbActiveModal);

  loginForm$: FormGroup;

  constructor(
    private fb: FormBuilder,
    private authService: AuthService,
    private toastr: ToastrService
  ) {
    this.loginForm$ = this.fb.group({
      email: [null, [Validators.required, Validators.email]],
      password: ['', Validators.required],
    });
  }
  onSubmit(): void {
    if (this.loginForm$.valid) {
      let email = this.loginForm$.get('email')?.value.toString();
      let password = this.loginForm$.get('password')?.value.toString();
      this.authService.login(email, password);
      this.activeModal.close();
    }
  }
}
