import { Injectable } from '@angular/core';
import { Personels, PersonelsConverter } from '../models/Personels';
import { BehaviorSubject, Observable, map } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { ResponseData } from '../models/ResponseData';

@Injectable({
  providedIn: 'root',
})
export class PersonelsService {
  private readonly url$ = 'http://localhost/msbapb/api/auth/personels/';
  private personelSubject: BehaviorSubject<Personels[]> = new BehaviorSubject<
    Personels[]
  >([]);
  public personels$: Observable<Personels[]> =
    this.personelSubject.asObservable();
  constructor(private http: HttpClient) {}

  getAllPersonels() {
    return this.http
      .get<any[]>(this.url$ + 'get_all_personels.php')
      .pipe(
        map((data) => data.map((item) => PersonelsConverter.fromJson(item)))
      );
  }
  setPersonels(personels: Personels[]) {
    this.personelSubject.next(personels);
  }

  createPersonel(
    photo: File,
    name: string,
    position: string,
    type: number,
    contact: string
  ) {
    let form = new FormData();
    form.append('photo', photo, photo.name);
    form.append('name', name);
    form.append('position', position);
    form.append('type', type.toString());
    form.append('contact', contact);

    return this.http.post<ResponseData<null>>(
      this.url$ + 'create_personel.php',
      form
    );
  }
}
