import { Component, OnInit } from '@angular/core';
import { AuthService } from './services/auth.service';
import { Router } from '@angular/router';
import { Administrator, AdministratorConverter } from './models/Administrator';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
})
export class AppComponent implements OnInit {
  title = 'msbapb-web';
  constructor(private authService: AuthService, private router: Router) {
    this.authService.users$.subscribe((data) => {
      if (data) {
        if (data.type === 2) {
          this.router.navigate(['/pnp']);
        } else if (data.type === 1) {
          this.router.navigate(['/bfp']);
        } else {
          this.router.navigate(['/auth']);
        }
      } else {
        this.router.navigate(['/auth']);
      }
    });
  }
  ngOnInit(): void {}
}
