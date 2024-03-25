import {
  HttpClient,
  HttpErrorResponse,
  HttpHeaders,
} from '@angular/common/http';
import { Injectable } from '@angular/core';
import { ResponseData } from '../models/ResponseData';
import { Administrator, AdministratorConverter } from '../models/Administrator';
import {
  BehaviorSubject,
  Observable,
  catchError,
  map,
  tap,
  throwError,
} from 'rxjs';
import { ToastrService } from 'ngx-toastr';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  private readonly url$ = 'https://danica.msbapb.com/api/admin/';

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
    const body = new FormData();
    body.append('email', email);
    body.append('password', password);
    this.http
      .post<ResponseData<Administrator>>(this.url$ + 'login_as_admin.php', body)
      .subscribe({
        next: (value: any) => {
          console.log(value);
          if (value.status) {
            this.toastr.success(value.message);
            let admin: Administrator = value.data;
            localStorage.setItem('user', AdministratorConverter.toJson(admin));
            this.setAdmin(AdministratorConverter.fromJson(admin));
          } else {
            this.toastr.error(value.toString());
          }
        },
        error: (err) => {
          this.toastr.error(err.message.toString());
        },
      });
  }

  updateProfile(id: number, photo: File | null, name: string, office: string) {
    let form = new FormData();
    if (photo !== null) {
      form.append('photo', photo, photo.name);
    }
    form.append('id', id.toString());
    form.append('name', name);
    form.append('office', office);
    return this.http.post<ResponseData<Administrator>>(
      this.url$ + 'edit_profile.php',
      form
    );
  }

  logout() {
    localStorage.clear();
    this.usersSubject.next(null);
  }
}
