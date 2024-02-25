import { HttpClient, HttpErrorResponse } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { ResponseData } from '../models/ResponseData';
import { Administrator, AdministratorConverter } from '../models/Administrator';
import { BehaviorSubject, Observable, catchError, map, throwError } from 'rxjs';
import { ToastrService } from 'ngx-toastr';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  private readonly url$ = 'http://localhost/msbapb/api/admin/';
  private usersSubject: BehaviorSubject<Administrator | null> =
    new BehaviorSubject<Administrator | null>(null);
  public users$: Observable<Administrator | null> =
    this.usersSubject.asObservable();
  constructor(private http: HttpClient, private toastr: ToastrService) {
    let data = localStorage.getItem('user');
    if (data !== null) {
      let admin: Administrator = AdministratorConverter.fromJson(
        JSON.parse(data)
      );
      console.log('fetch');
      this.setAdmin(admin);
    }
  }

  setAdmin(admin: Administrator) {
    this.usersSubject.next(admin);
  }
  login(email: string, password: string) {
    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);
    this.http
      .post<ResponseData<Administrator>>(
        this.url$ + 'login_as_admin.php',
        formData
      )
      .pipe(
        catchError((error: HttpErrorResponse) => {
          this.toastr.error(error.error.message.toString());
          return throwError(error);
        })
      )
      .subscribe((data) => {
        if (data.status) {
          this.toastr.success(data.message);
          let admin: Administrator = data.data;
          localStorage.setItem('user', AdministratorConverter.toJson(admin));
          this.setAdmin(admin);
        } else {
          this.toastr.error(data.message.toString());
        }
        (error: any) => {
          this.toastr.error(error.toString());
        };
      });
  }
  logout() {
    localStorage.clear();
    this.usersSubject.next(null);
  }
}
