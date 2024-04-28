import { HttpErrorResponse } from '@angular/common/http';
import { Component, Input, OnInit, inject } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { User } from 'src/app/models/Users';
import { MessagingService } from 'src/app/services/messaging.service';

@Component({
  selector: 'app-messaging',
  templateUrl: './messaging.component.html',
  styleUrls: ['./messaging.component.css'],
})
export class MessagingComponent implements OnInit {
  activeModal = inject(NgbActiveModal);
  @Input() users: User[] = [];
  showPassword: boolean = false;
  userWithPhone$: {
    name: string;
    phone: string;
  }[] = [];

  allNames$: string[] = [];
  messageForm$: FormGroup;

  constructor(
    private fb: FormBuilder,
    private toastr: ToastrService,
    private messagingService: MessagingService
  ) {
    this.messageForm$ = fb.group({
      apiKey: ['', Validators.required],
      message: ['', Validators.required],
    });
  }
  ngOnInit(): void {
    this.allNames$ = this.users.map((user) => user.fullname);

    this.userWithPhone$ = this.users.map((user) => ({
      name: user.fullname,
      phone: user.phone,
    }));
  }

  submit() {
    if (this.messageForm$.valid) {
      let message = this.messageForm$.get('message')?.value ?? '';
      let apiKey = this.messageForm$.get('apiKey')?.value ?? '';
      this.messagingService
        .sendMessage(
          apiKey,
          this.users.map((e) => e.phone),
          message
        )
        .subscribe({
          next: (response) => {
            console.log('Message sent successfully:', response);
          },
          error: (error: HttpErrorResponse) => {
            // Handle the error and extract the error message
            if (error.error && Array.isArray(error.error)) {
              console.error('Error:', error.error);
            } else {
              console.error('An unexpected error occurred:', error);
            }
          },
        });
    }
  }
  togglePasswordVisibility(): void {
    this.showPassword = !this.showPassword;
  }
}
