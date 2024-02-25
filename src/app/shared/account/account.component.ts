import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { Administrator } from 'src/app/models/Administrator';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-account',
  templateUrl: './account.component.html',
  styleUrls: ['./account.component.css'],
})
export class AccountComponent {
  administrator$: Administrator | null = null;

  constructor(private authService: AuthService, private router: Router) {
    authService.users$.subscribe((data) => {
      this.administrator$ = data;
    });
  }

  logout() {
    this.authService.logout();
    this.router.navigate(['/auth']);
  }
}
