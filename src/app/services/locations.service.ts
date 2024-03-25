import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

import { Locations } from '../models/Locatiions';
import { ResponseData } from '../models/ResponseData';
import { Observable, Observer } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class LocationsService {
  readonly url$ = 'https://danica.msbapb.com/api/admin/';

  constructor(private http: HttpClient) {}

  getAllLocations() {
    return this.http.get<ResponseData<Locations[]>>(
      this.url$ + 'get_all_locations.php'
    );
  }

  addLocations(
    name: string,
    contact: string,
    latitude: number,
    longitude: number,
    type: number
  ) {
    let form = new FormData();
    form.append('name', name);
    form.append('contact', contact);
    form.append('lat', latitude.toString());
    form.append('lang', longitude.toString());
    form.append('type', type.toString());
    return this.http.post<ResponseData<any>>(
      this.url$ + 'add_locations.php',
      form
    );
  }
  deleteLocation(id: number): Observable<ResponseData<any>> {
    return this.http.delete<ResponseData<any>>(
      `${this.url$}delete_location.php?id=${id}`
    );
  }
}
