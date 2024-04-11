import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { ResponseData } from '../models/ResponseData';
import { Barangay } from '../models/Barangay';

@Injectable({
  providedIn: 'root',
})
export class BarangayService {
  private readonly url = 'https://danica.msbapb.com/api/barangay/';

  constructor(private http: HttpClient) {}

  createBarangay(
    barangay: string,
    hotline: string
  ): Observable<ResponseData<any>> {
    const formData: FormData = new FormData();
    formData.append('barangay', barangay);
    formData.append('hotline', hotline);
    console.log('Request Body:', formData);

    return this.http
      .post<ResponseData<any>>(this.url + 'create.php', formData)
      .pipe(
        catchError((error) => {
          // Handle error
          console.error('Error creating barangay:', error);
          throw error;
        })
      );
  }
  
  deleteBarangay(id: number): Observable<ResponseData<any>> {
    return this.http
      .delete<ResponseData<any>>(`${this.url}delete.php?id=${id}`)
      .pipe(
        catchError((error) => {
          console.error('Error deleting barangay:', error);
          throw error;
        })
      );
  }

  getAllBarangay(): Observable<ResponseData<Barangay[]>> {
    return this.http.get<ResponseData<Barangay[]>>(this.url + 'all.php').pipe(
      catchError((error) => {
        // Handle error
        console.error('Error getting all barangays:', error);
        throw error;
      })
    );
  }

  updateBarangay(
    id: number,
    barangay: string,
    hotline: string
  ): Observable<ResponseData<any>> {
    const formData: FormData = new FormData();
    formData.append('id', id.toString());
    formData.append('barangay', barangay);
    formData.append('hotline', hotline);
    return this.http
      .post<ResponseData<any>>(this.url + 'update.php', formData)
      .pipe(
        catchError((error) => {
          // Handle error
          console.error('Error updating barangay:', error);
          throw error;
        })
      );
  }
}
