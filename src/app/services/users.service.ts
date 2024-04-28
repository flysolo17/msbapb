import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ResponseData } from '../models/ResponseData';
import { User } from '../models/Users';

@Injectable({
  providedIn: 'root',
})
export class UsersService {
  URL$ = 'https://danica.msbapb.com/api/auth/';
  constructor(private http: HttpClient) {}

  getAllUsers() {
    return this.http.get<ResponseData<User[]>>(this.URL$ + 'get_all_users.php');
  }
}
