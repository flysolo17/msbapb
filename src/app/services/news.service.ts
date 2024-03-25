import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { ResponseData } from '../models/ResponseData';
import { News, NewsConverter } from '../models/News';
import { Observable, catchError, map } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class NewsService {
  private readonly url = 'https://danica.msbapb.com/api/news/';
  constructor(private http: HttpClient) {}

  getAllNews() {
    return this.http
      .get<ResponseData<News[]>>(this.url + 'get_all_news.php')
      .pipe(
        map((data) => data.data.map((item) => NewsConverter.fromJson(item)))
      );
  }

  createNews(
    photo: File,
    title: string,
    description: string,
    link: string,
    type: number
  ) {
    let form = new FormData();
    form.append('photo', photo, photo.name);
    form.append('title', title);
    form.append('description', description);
    form.append('link', link);
    form.append('type', type.toString());
    return this.http
      .post<ResponseData<any>>(this.url + 'create.php', form)
      .pipe(
        catchError((error) => {
          console.error('Error creating news:', error);
          throw error;
        })
      );
  }

  deleteNews(id: number): Observable<ResponseData<any>> {
    return this.http
      .delete<ResponseData<any>>(`${this.url}delete.php?id=${id}`)
      .pipe(
        catchError((error) => {
          console.error('Error deleting news:', error);
          throw error;
        })
      );
  }
}
